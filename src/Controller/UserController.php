<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/employees", name="app_user_index_employees", methods={"GET"})
     */
    public function employees(UserRepository $userRepository): Response
    {
        $users = $userRepository->getEmployees();

        //dd($users);
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/customers", name="app_user_index_customers", methods={"GET"})
     */
    public function customers(UserRepository $userRepository): Response
    {
        return $this->render('user/index-customers.html.twig', [
            'users' => $userRepository->getCustomers(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/employees/{id}", name="app_user_show_employee", methods={"GET"})
     */
    public function showEmployee(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/employees/{id}", name="app_user_show_customer", methods={"GET"})
     */
    public function showCustomer(User $user): Response
    {
        return $this->render('user/show-customer.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/employees/{id}/edit", name="app_user_edit_employee", methods={"GET", "POST"})
     */
    public function editEmployee(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if($form->get('password')->getData()){
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData());

                    $user->setPassword($hashedPassword);
            }



            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index_employee', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/customers/{id}/edit", name="app_user_edit_customer", methods={"GET", "POST"})
     */
    public function editCustomer(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if($form->get('password')->getData()){
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData());

                    $user->setPassword($hashedPassword);
            }



            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index_customers', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit-customer.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
