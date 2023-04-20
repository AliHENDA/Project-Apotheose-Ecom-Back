<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class FashionApi
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchNews(): array
    {
        $response = $this->httpClient->request(
            'GET',
            'https://fashion-industry-news-data-collection.p.rapidapi.com/', [
                'query' => [
                    'q' => '"fashion week"', // urlencode() sera appliqué dessus
                    // /!\ On pourrait tranmsettre la clé API directemnt via le constructeur comme fait précédemment
                    // Autre façon de faire et qui permet d'accéder à tous les paramètres du conteneur de services
                    'X-RapidAPI-Key' => '64fd2e2d18msh93e43f134de0332p1c075ajsn74f7ae338444',
                    'X-RapidAPI-Host' => 'fashion-industry-news-data-collection.p.rapidapi.com',
                ]
            ]
        );

        //$statusCode = $response->getStatusCode();
        //// $statusCode = 200
        //$contentType = $response->getHeaders()['content-type'][0];
        //// $contentType = 'application/json'
        //$content = $response->getContent();
        //// $content = '{"id":521583, "name":"symfony-docs", ...}'
        //$content = $response->toArray();
        //// $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
//
        return $response->toArray();
    }

}