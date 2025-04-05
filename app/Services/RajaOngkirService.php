<?php

namespace App\Services;

use GuzzleHttp\Client;

class RajaOngkirService
{
    protected $client;
    protected $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('RAJAONGKIR_API_KEY');
    }

    public function getProvinces()
    {
        $response = $this->client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => $this->apiKey,
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function getCities($provinceId)
    {
        $response = $this->client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'query' => [
                'province' => $provinceId,
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function checkOngkir($origin, $destination, $weight, $courier)
    {
        $response = $this->client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'key' => $this->apiKey,
            ],
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }
}