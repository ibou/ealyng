<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Query
{
  private $client;

  public function __construct(HttpClientInterface $client)
  {
    $this->client = $client;
  }
  public function fetchBooks(): array
  {
    $credentials = [
      'email' => 'ibou@gmail.com',
      'password' => 'password',
    ];
    $token = $this->getToken($credentials);
    $response = $this->client->request('GET', 'http://localhost:8000/api/books', [
      'headers' => [
        'Authorization' => sprintf("Bearer %s", $token['token']),
      ],
    ]);
    return $response->toArray();
  }

  public function getToken(array $credentials = []): array
  {
    $response = $this->client->request('POST', 'http://localhost:8000/authentication_token', [
      'headers' => [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
      ],
      'json' => [
        "email" => $credentials["email"],
        "password" => $credentials["password"],
      ],
    ]);
    return $response->toArray();
  }
}
