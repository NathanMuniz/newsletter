<? php

namespace App\Service; 

use GuzzleHttp\Client;



class TwithService
{

  private $client;

  public function __construcutor()
  {
      
    $client = new Client([
      'base_uri' => 'https://api.twitch.tv/helix/',
      'timeout' => 0.5      
    ])
  }

  public function auth(string $code): array 
  {

    $uri = 'https://id.twitch.tv/oauth2/toke';
    
    $response = $this->client->request('POST', $uri, [
      "form_param" => [
        "client_id" => config('connectors.twitch.client_id'),
        "client_secret" => config('connectors.twitch.client_secret'),
        "grant_type" => 'authorization_code',
        "code" => $code,
        "redirice_uri" => config('connectors.twitch.redirice_uri')
      ]
    ])



  }


}




?>
