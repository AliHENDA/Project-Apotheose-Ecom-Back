<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\ProductRepository;
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
     * @Route("/api/categories/{id}/products", name="api_categories_get_products", methods={"GET"})
     */
    public function getItemAndProducts(ProductRepository $productRepository, Category $category = null): Response
    {

        if ($category === null) {
            return $this->json(
                ['error' => 'Catagory non trouvé !'],
                Response::HTTP_NOT_FOUND
            );
        }
        $products = $category->getProducts();

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


}
