<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiProductController extends AbstractController
{
    /**
     * @Route("/api/products", name="api_products_get", methods={"GET"})
     */
    public function getCollection(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->json(
            // Les données à sérialiser (à convertir en JSON)
            $products,
            // Le status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_products_collection']
        );
    }

    /**
     * @Route("/api/men/products", name="api_women_products_get", methods={"GET"})
     */
    public function getMenProducts(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findMenProducts();

        return $this->json(
            // Les données à sérialiser (à convertir en JSON)
            $products,
            // Le status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_products_men']
        );
    }

    /**
     * @Route("/api/women/products", name="api_women_products_get", methods={"GET"})
     */
    public function getWoMenProducts(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findWomenProducts();

        return $this->json(
            // Les données à sérialiser (à convertir en JSON)
            $products,
            // Le status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_products_women']
        );
    }

    /**
     * @Route("/api/products/{id}", name="api_products_get_item", methods={"GET"})
     */
    public function getOneProduct(Product $product = null): Response
    {
        
        return $this->json(
            // Les données à sérialiser (à convertir en JSON)
            $product,
            // Le status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_products_item']
        );
    }
}
