<?php

namespace App\Components\Common;

use GuzzleHttp\Client as GuzzleHttp;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private GuzzleHttp $client;
    private array $header = [
        "Accept"       => "application/json",
        "Content-Type" => "application/json",
    ];

    public function getClient(string $baseUri): self
    {
        $this->client = new GuzzleHttp([
            'base_uri' => $baseUri
        ]);
        return $this;
    }

    public function get(string $resource, array $params = []): array
    {
        $params   = $this->getParams($params);
        $response = $this->client->get($resource, $params);

        return $this->decodeResponse($response);
    }


    public function post(string $resource, array $params = []): array
    {
        $params   = $this->getParams($params);
        $response = $this->client->post($resource, $params);

        return $this->decodeResponse($response);
    }

    public function setHeader(array $header): void
    {
        $this->header = array_merge($this->header, $header);
    }

    private function decodeResponse(ResponseInterface $response): array
    {
        $bodyResponse = $response->getBody();
        $output       = json_decode($bodyResponse, true);
        return $output;
    }

    private function getParams(array $params): array
    {
        return array_merge($params, [
            'headers' => $this->header
        ]);
    }
}
