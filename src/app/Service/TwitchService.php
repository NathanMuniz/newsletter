<?php

namespace App\Service;

use GuzzleHttp\Client;



class TwitchService
{

  private Client $client;


  public function __construct()
  {
    $this->client = new Client([
      'base_uri' => "uribase",
      'timeout' => 1.5
    ]);
  }

  public function authenticate($code)
  {
    $uri = "twtich.tokens";

    $response = $this->client->request('POST', $uri, [
      'form_params' => [
        'client_id' => config('connetors.twtich.client_id'),
        'client_secret' => config('connetors.twitch.client_secret'),
        'grant-type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => config('connetors.twitch.redirect_uri')
      ]
    ]);

    return json_decode($response->getBody(), true);
  }

  public function getAuthenticatedUser($token)
  {
    $uri = "twitch.autneteic.with_token";

    $response = $this->client->request('GET', $uri, [
      'headers' => [
        'Client-ID' => config('connetors.twitch.client_secret'),
        'Authorization' => 'Bearer ' . $token,
      ]
    ]);

    $result = json_decode($response->getBody())['data'][0];

    return [
      'id' => $result['twich_id'],
      'email' => $result['email'],
      'username' => $result['login']
    ];
  }
}
