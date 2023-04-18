<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApiUserController extends AbstractController 

{

    /**
     * Requete pour chercher un Item
     *
     * @Route("/api/secure/users/{id<\d+>}", name="api_users_get_item", methods={"GET"})
     */
    public function getItem(User $user = null)
    {
        if ($user === null) {
            return $this->json(
                ['error' => 'Utilisateur non trouvé !'],
                Response::HTTP_NOT_FOUND,
                ['Authorization' => 'blablabla']
            );
        }
        return $this->json(
            $user,
            200,
            [],
            ['groups' => 'get_users_item']
        );
    }

    /**
     * @Route("/api/users", name="api_users_post_new", methods={"POST"})
     */
    public function createItem(Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher)
    {
        // On recuperer le json
        $jsonContent = $request->getContent();

        try {
            // On deserialize (convertir) le json en entité utilisateur
            $user = $serializer->deserialize($jsonContent, User::class, 'json');
        } catch (NotEncodableValueException $e) {
            return $this->json(
                ["error" => 'JSON INVALIDE'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Valider l'entité recu
        $errors = $validator->validate($user);

        // On check le nombre d'erreur
        if (count($errors) > 0)
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

        // On sauvegarde l'entité
        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // On retorune la reponse adapté

        return $this->json(
            // Le film crée
            $user,
            // Le status code 201 : CREATED
            Response::HTTP_CREATED,
            [],
            ['groups' => 'get_users_item']
        );
    }

    /**
     * @Route("/api/secure/users/edit", name="api_users_post_edit", methods={"POST"})
     */
    public function modifyItem( UserRepository $userRepository, Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher)
    {
        // On recuperer le json
        $jsonContent = $request->getContent();
        $json = json_decode($jsonContent, true);

        $id = $json['id'];

        $user = $userRepository->find($id);
        try {
            // On deserialize (convertir) le json en entité utilisateur
            $userUpdate = $serializer->deserialize($jsonContent, User::class, 'json', ['object_to_populate' => $user]);
        } catch (NotEncodableValueException $e) {
            return $this->json(
                ["error" => 'JSON INVALIDE'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Valider l'entité recu
        $errors = $validator->validate($user, null, ['groups' => 'user_update']);

        // On check le nombre d'erreur
        if (count($errors) > 0)
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $userUpdate->setPassword($hashedPassword);

        // On sauvegarde l'entité
        $entityManager = $doctrine->getManager();
        $entityManager->persist($userUpdate);
        $entityManager->flush();

        // On retorune la reponse adapté

        return $this->json(
            // Le film crée
            $user,
            // Le status code 200 : OK
            200,
            [],
            ['groups' => 'get_users_item']
        );
    }    

}