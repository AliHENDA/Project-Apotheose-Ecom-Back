<?php

namespace App\Controller\Api;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiSearchController extends AbstractController

{
    /**
     * Requete pour chercher un Item
     *
     * @Route("/api/search", name="api_search_item", methods={"POST"})
     */
    public function searchItem(Request $request, ProductRepository $productRepository) {

        $jsonContent = $request->getContent();
        // on la transforme en objet
        $content = json_decode($jsonContent, true);

        $name = $content["name"];

        $searchItem = $productRepository->search($name);

        return $this->json(
            // Search
            $searchItem,
            // Le status code 200 : Ok
            200,
            [],
            ['groups' => 'get_products_item']
        );

    }
}