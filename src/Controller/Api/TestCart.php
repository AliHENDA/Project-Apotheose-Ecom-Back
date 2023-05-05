<?php

namespace App\Controller\Api;

use App\Entity\Inventory;
use App\Entity\Order;
use DateTimeImmutable;
use App\Entity\OrderDetails;
use App\Entity\TemporaryCart;
use App\Repository\InventoryRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\TemporaryCartRepository;
use App\Repository\UserRepository;
use App\Service\MailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TestCart extends AbstractController
{

    // Le code peut être factorisé. Je laisse le détail, pour comprendre ce qui est fait à chaque étape.
    // J'ai créé une méthode construct pour limiter le nombre de paramètre dans la methdod newOrder, pour la transimission uniquement du l'id de l'utilisateur.
    
    private $temporaryCartRepository;
    private $inventoryRepository;
    private $doctrine;
    private $userRepository;

    public function __construct(TemporaryCartRepository $temporaryCartRepository, InventoryRepository $inventoryRepository, ManagerRegistry $doctrine, UserRepository $userRepository) {

        $this->temporaryCartRepository = $temporaryCartRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->doctrine = $doctrine;
        $this->userRepository = $userRepository;

    }

    /**
     * @Route("/api/secure/user/cart", name="api_user_cart", methods={"GET"})
     */
    public function getCart() {

        // we fetch connected user
        $user = $this->getUser();

        // we fetch all temporary cart items
        $cart = $user->getTemporaryCarts();

            return $this->json(
                // Le cart crée
                $cart,
                // Le status code 200 : Ok
                200,
                [],
                ['groups' => 'get_cart_item']
            );
    }

    /**
     * @Route("/api/secure/user/orders", name="api_user_orders", methods={"GET"})
     */
    public function getOrders() {

        // we fetch connected user
        $user = $this->getUser();

        // we fetch all temporary cart items
        $orders = $user->getOrders();


           // $orderDetails = $orders->getOrderDetails();
            //dd($orderDetails);

            return $this->json(
                // Le cart crée
                $orders,
                // Le status code 200 : Ok
                200,
                [],
                ['groups' => 'get_cart_item']
            );         
    }



    /**
     * @Route("/api/secure/cart/add", name="api_cart_add", methods={"POST"})
     */
    public function add(ProductRepository $productRepository, TemporaryCartRepository $temporaryCartRepository, Request $request, ManagerRegistry $doctrine)
    {
        // le JSON reçu
        $jsonContent = $request->getContent();

        // Transformation du json en php(array)
        $content = json_decode($jsonContent, true);

        // On récupère l'ID du product
        $productId = $content["product"];

        //On récupère la taille du produit
        $size = $content["size"];
        
        //Avec l'Id du produit, on va chercher l'objet associé
        $product = $productRepository->find($productId);

        // on récupère l'utilisateur connecté.
    
        $user = $this->getUser();

        // Manière de récupérer l'objet Cart, associé à cet utilisateur/produit/size
        $existingCart = $temporaryCartRepository->findOneBy(["product" => $product, "user"=> $user, "size" => $size]);

        if($existingCart) {

            // s'il existe, alors on réupère la quantité actuelle, et on l'incrémente d'un
            $quantityProduct = $existingCart->getQuantity();
            $newQuantity = $quantityProduct +1;

           // on définit la nouvelle quantité grâce au setter, et on met à jour la propriété updatedAt

            $existingCart->setQuantity($newQuantity);
            $existingCart->setUpdatedAt(new DateTimeImmutable());

            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            return $this->json(
                // Le cart modifié
                $existingCart,
                // Le status code 200 : 0K
                200,
                [],
                ['groups' => 'get_cart_item']
            );
        } else {

            // s'il n'y a pas d'utilisateur/produit/size associé, alors on créé un nouvel objet Cart
            // On définit le nouveau produit/quantity/taille/utilisateur grâce aux setters
            $cart = New TemporaryCart();
            $cart->setProduct($product);
            $cart->setQuantity(1);
            $cart->setSize($size);
            $cart->setUser($user);

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
    public function deleteCartItem(ProductRepository $productRepository, TemporaryCartRepository $temporaryCartRepository, Request $request, ManagerRegistry $doctrine) {

        // On récupère le contenu de la requête
        $jsonContent = $request->getContent();

        // on la transforme en objet
        $content = json_decode($jsonContent, true);

        // on récupère l'ID du product
        $productId = $content["product"];
        // on récupère la size
        $size = $content["size"];

        $product = $productRepository->find($productId);
        $user = $this->getUser();

        $entityManager = $doctrine->getManager();
        

        // on récupère l'objet cart associé à l'utilisateur/product/size transmis
        $existingCart = $temporaryCartRepository->findOneBy(["product" => $product, "user"=> $user, "size" => $size]);

        // on récupère la quantité du cart existant
        $quantityProduct = $existingCart->getQuantity();

        if($quantityProduct > 1) {
            // si la quantité est supérieure à un, on la décremente d'un
            $newQuantity = $quantityProduct -1;
            // on associe la nouvelle quantité à l'objet.
            $existingCart->setQuantity($newQuantity);
        } else {
            // sinon on supprime l'objet
            $entityManager->remove($existingCart);
        }

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
    public function empty(TemporaryCartRepository $temporaryCartRepository, Request $request, ManagerRegistry $doctrine) {
        
        // on récupère l'utilisateur connecté
        $user = $this->getUser();
        
        // on récupère tous les objets cart fonction de l'utilisateur
        $existingCarts = $temporaryCartRepository->findBy(["user"=> $user]);
        
        foreach ($existingCarts as $existingCart) {

            // pour chaque objet cart, on indique qu'on veut le supprimer, et on le flush
            $entityManager = $doctrine->getManager();
            $entityManager->remove($existingCart);
            $entityManager->flush();
        }

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
    public function newOrder($userId) {

        $entityManager = $this->doctrine->getManager();
        
        $user = $this->userRepository->find($userId);

        // On récupère le tableau d'objet cart associé à l'utilisateur
        $cartToOrderDetails = $this->temporaryCartRepository->findBy(["user"=> $user]);
        

        // on créé un objet Order et on lui associe l'utilisateur
        $order = New Order();
        $order->setUser($user);

        foreach($cartToOrderDetails as $cartToOrderDetail) {

            // pour chaque objet du tableau d'objet $cartToOrderDetails, on créé un objet OrderToDeteils
            $orderDetails = New OrderDetails();
            
            // on lie la propriété myOrder à l'objet Order créé ligne 214
            $orderDetails->setMyOrder($order);

            // je détaille les étapes, mais on peut stocker la valeur de la variable directement dans le setter. Ici, on récupère l'objet Product de $cartToOrderDetails
            $product = $cartToOrderDetail->getProduct();   
            

            // on définit la propriété product de l'objet orderDetails, en y associant le product récupéré ligne 226
            $orderDetails->setProduct($product);
             

            // On récupère la quantité, de cartToOrderDetails, et on la définit comme valeur de la propriété quantity d'orderDetails
            $quantity = $cartToOrderDetail->getQuantity();
            $orderDetails->setQuantity($quantity);
          
            // On récupère la size, de cartToOrderDetails, et on la définit comme valeur de la propriété size d'orderDetails
            $size = $cartToOrderDetail->getSize();
            $orderDetails->setSize($size);

            $entityManager->persist($orderDetails);

            // une fois l'objet persité, on supprime l'objet $cartToDetail
            $entityManager->remove($cartToOrderDetail);

            // on récupère dans la table inventory, le produit, avec la taille récupéré plus haut
            $inventoryItem = $this->inventoryRepository->findOneBy(["product" => $product, "size" => $size]);

            // un fois trouvé, on récpère son stock
            $actualStock = $inventoryItem->getStock();

            // On enlève du stock, la quantité du produit acheté
            $newQuantity = $actualStock - $quantity;

            // on définit la nouvelle quantité dans l'objet
            $inventoryItem->setStock($newQuantity);

            $entityManager->flush();
        }

    
        return $this->json(
            // La nouvelle commande
            $order,
            // Le status code 200 : OK
            200,
            [],
            ['groups' => 'get_cart_item']
        );
    }
}