<?php

namespace App\Controller\Api;

use App\Entity\Cart;
use App\Entity\Cart2;
use App\Entity\Order;
use DateTimeImmutable;
use App\Entity\OrderDetails;
use App\Repository\Cart2Repository;
use App\Repository\CartRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;


class ApiCartController extends AbstractController
{
    /**
     * @Route("api/secure/user/cart", name="api_get_user_cart", methods={"GET"})
     */
    public function getCart(Cart2Repository $cart2Repository)
    {

        $user = $this->getUser();
        $carts = $user->getCart2s();

        return $this->json(
            // Le cart crée
            $carts,
            // Le status code 201 : CREATED
            200,
            [],
            ['groups' => 'get_cart_item']
        );
    }


    /**
     * @Route("/api/secure/cart/add", name="api_cart_add", methods={"POST"})
     */
    public function add(Cart2Repository $cart2Repository, Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator)
    {

        $jsonContent = $request->getContent();

        try {
            // On deserialize (convertir) le json en entité orderDetails
            $cart = $serializer->deserialize($jsonContent, Cart2::class, 'json');
        } catch (NotEncodableValueException $e) {
            return $this->json(
                ["error" => 'JSON INVALIDE'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $errors = $validator->validate($cart);

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager = $doctrine->getManager();

        $products = $cart->getProducts();
        $user = $this->getUser();

        foreach($products as $product) {
            $existingCart = $cart2Repository->findOneBy(["status" => false]);

            if($existingCart) {
                $existingCart->addProduct($product);
            } else {
                $cart->setUser($user);
                $entityManager->persist($cart);
            }
        }

        //  $entityManager->persist($cart);
        $entityManager->flush();

        return $this->json(
            // Le cart crée
            $cart,
            // Le status code 201 : CREATED
            Response::HTTP_CREATED,
            [],
            ['groups' => 'get_cart_item']
        );
    }
}