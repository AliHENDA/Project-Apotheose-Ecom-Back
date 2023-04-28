<?php

namespace App\Controller\Api;

use App\Entity\Cart2;
use App\Entity\Order;
use DateTimeImmutable;
use App\Repository\Cart2Repository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;


class ApiCartController extends AbstractController
{
    /**
     * @Route("api/secure/user/cart", name="api_get_user_cart", methods={"GET"})
     */
    public function getCart(Cart2Repository $cart2Repository)
    {

        $user = $this->getUser();
        $userId = $user->getId();
        $cart = $cart2Repository->getCart($userId);


        if($cart === true) {

            $cartContent = $cart2Repository->find($cart['id']);
            return $this->json(
            // Le cart non payé
            $cartContent,
            // Le status code 200 : OK
            200,
            [],
            ['groups' => 'get_cart_item']
            );
        } else {
                return $this->json(
                    // Le cart non payé
                    "Pas de panier",
                    // Le status code 200 : OK
                    204,
                    [],
                    []
                    );

        }
    
    }

    /**
     * @Route("api/secure/user/orders", name="api_get_user_orders", methods={"GET"})
     */
    public function getOrders(Cart2Repository $cart2Repository)
    {

        $user = $this->getUser();
        $userId = $user->getId();
        $orders = $cart2Repository->getOrders($userId);

        // dd($orders);

    foreach ($orders as $order) {
        $orderContent = $cart2Repository->find($order['id']);
            
    }

    return $this->json(
        // Les commandes
        $orderContent,
        // Le status code 200 : OK
        200,
        [],
        ['groups' => 'get_cart_item']
        );
    }


    /**
     * @Route("/api/secure/cart/add", name="api_cart_add", methods={"POST"})
     */
    public function add(ProductRepository $productRepository, Cart2Repository $cart2Repository, Request $request, ManagerRegistry $doctrine)
    {
        // le JSON reçu
        $jsonContent = $request->getContent();

        // Transformation du json en php(array)
        $content = json_decode($jsonContent, true);

        // On récupère l'ID du product
        $productId = $content["product"];
        // On récupère le total du cart updated (propriété pas nécessaire, Le front nous transmet directement le montant total de la commande à jour)
        // de notre côté, on pourra à partir de la BDD, récupérer le price/total/quantity pour affichage dans un template order-index

        $total = $content["total"];

        $product = $productRepository->find($productId);

        // dd($product);

        $user = $this->getUser();
        
        $existingCart = $cart2Repository->findOneBy(["status" => false, "user"=> $user]);

        if($existingCart) {
            $existingCart->addProduct($product);
            $existingCart->setTotal($total);
            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            return $this->json(
                // Le cart modifié
                $existingCart,
                // Le status code 200
                200,
                [],
                ['groups' => 'get_cart_item']
            );
        } else {
            $cart = New Cart2();
            $cart->setUser($user);
            $cart->addProduct($product);
            $cart->setTotal($total);
            $cart->setStatus(false);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($cart);
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

    /**
     * @Route("/api/secure/cart/delete", name="api_cart_delete_item", methods={"POST"})
     */
    public function deleteCartItem(ProductRepository $productRepository, Cart2Repository $cart2Repository, Request $request, ManagerRegistry $doctrine) {

        $jsonContent = $request->getContent();

        $content = json_decode($jsonContent, true);

        $productId = $content["product"];
        $total = $content["total"];

        $product = $productRepository->find($productId);

        // dd($product);

        $user = $this->getUser();

        $existingCart = $cart2Repository->findOneBy(["status" => false, "user"=> $user]);

        $existingCart->removeProduct($product);
        $existingCart->setTotal($total);

        $entityManager = $doctrine->getManager();
        $entityManager->flush();

        return $this->json(
            // Le cart modifié
            $existingCart,
            // Le status code 200 : OK
            200,
            [],
            ['groups' => 'get_cart_item']
        );

     }

    /**
    * @Route("/api/secure/cart/empty", name="api_cart_empty", methods={"POST"})
    */
    public function empty(Cart2Repository $cart2Repository, Request $request, ManagerRegistry $doctrine) {
    
        $user = $this->getUser();
        
        $existingCart = $cart2Repository->findOneBy(["status" => false, "user"=> $user]);
        
        $entityManager = $doctrine->getManager();
        $entityManager->remove($existingCart);
        $entityManager->flush();
        
        return $this->json(
            // Le cart supprimé
            "Le panier a été supprimé",
            // Le status code 204 : NO CONTENT
            204,
            [],
            []
        );
    }    
    
    /**
     * @Route("/api/secure/order/new", name="api_order_new", methods={"POST"})
     */
    public function newOrder(ProductRepository $productRepository, Cart2Repository $cart2Repository, Request $request, ManagerRegistry $doctrine) {

        // On va d'abord récupérer l'utilisateur
        $user = $this->getUser();

        // On va chercher le panier existant avec un statut false (true équivaudra à "commande pas encore payée")
        $cartToOrder = $cart2Repository->findOneBy(["status" => false, "user"=> $user]);

        // on change le statut de la commande, en true (true équivaudra à "commande payée")
        $cartToOrder->setStatus(true);

        // $products = $cartToOrder->getProducts();
// 
        // foreach ($products as $product) {
        //     $productId = $product->getId();
        //     $productDB = $productRepository->find($productId);
        //    // dd($quantity);
        //     $quantity = $productDB->getStock();
        //     $newQuantity = $quantity--;
        //     $productDB->setStock($newQuantity);
// 
        // }

        $entityManager = $doctrine->getManager();
        $entityManager->flush();

        return $this->json(
            // La nouvelle commande
            $cartToOrder,
            // Le status code 200 : OK
            200,
            [],
            ['groups' => 'get_cart_item']
        );
    }
}