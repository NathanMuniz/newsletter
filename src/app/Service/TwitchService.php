<?php 

namespace App\Services;

use Guzzle\Client;


class TwitchService
{

    private $client;

    public function __construct()
    {
        $client = new Client([
            "base_uri" => 'https://api.twitch.tv/helix/',
            "timeout" => 0.5
        ]);

    }

    public function auth(string $code) : array
    {
        $uri = 'https://id.twitch.tv/oauth2/toke';
        
        $response = $this->client->request('POST', $uri, [
            "form_param" => [
                "client_id" => config("connectors.twitch.client_Id"),
                "client_secret" => config("connectors.twitch.client_service"),
                "grant_type" => "authorization_code",
                "code" => $code,
                "redrict_uri" => config("connectos.twitchs.client_redirect")
                ]

            ]);
        
        return json_decode($response->getBody(), true);

    }

    public function getAuth


}



?>