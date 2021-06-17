<?php

namespace App\Traits;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

/**
 * Trait ConsumesExternalService
 * @package App\Traits
 */
trait ConsumesExternalService
{

    /**
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = []){

        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers]);

        return $response->getBody()->getContents();
    }

}
