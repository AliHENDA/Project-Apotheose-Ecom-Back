<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiCategoryController extends AbstractController
{
    /**
     * @Route("/api/categories", name="app_api_category", methods={"GET"})
     */
    public function getCollection(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->json(
            // Les données à sérialiser (à convertir en JSON)
            $categories,
            // Le status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_categories_collection']
        );
    }

    /**
     * @Route("/api/women/categories/{slug}/products", name="api_categories_get_womenproducts", methods={"GET"})
     */
    public function getWomenProductByCategory($slug, Category $category = null): Response
    {

        $slug = $category->getSlug();

        if ($category === null) {
            return $this->json(
                ['error' => 'Catégorie non trouvée !'],
                Response::HTTP_NOT_FOUND
            );
        }
        $products = $category->getWomanProducts();

        $data = [
            "category" => $category,
            "products" => $products
        ];
        return $this->json(
            $data,
            Response::HTTP_OK,
            [],
            [
                'groups' => [
                    // les categories
                    'get_products_collection',
                    // le groupe des catégories
                    'get_categories_collection'
                ]
            ]);
    }

    /**
     * @Route("/api/men/categories/{slug}/products", name="api_categories_get_menproducts", methods={"GET"})
     */
    public function getMenProductByCategory($slug, Category $category = null): Response
    {

        $slug = $category->getSlug();
        if ($category === null) {
            return $this->json(
                ['error' => 'Catégorie non trouvée !'],
                Response::HTTP_NOT_FOUND
            );
        }
        $products = $category->getManProducts();

        $data = [
            "category" => $category,
            "products" => $products,
        ];
        return $this->json(
            $data,
            Response::HTTP_OK,
            [],
            [
                'groups' => [
                    // les categories
                    'get_products_collection',
                    // le groupe des catégories
                    'get_categories_collection'
                ]
            ]);
    }


}
