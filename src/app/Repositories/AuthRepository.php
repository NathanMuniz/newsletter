<?php

namespace App\Repositories;

use App\Models\User;
use App\Service\TwictchService; 
 
class AuthRepository
{

  public function authenticate($code)
    {
 
    $service = new TwictchService();
    $tokens = $service->authenticate($code);
    $user = $service->getAuthenticatedUser($tokens['access_token']);
    
    $user = $this->findOrCreate($user);

    Auth::login($user);

  }

  public function findOrCreate($provider_data)
  {

    $auth = User::where('email', $provider_data['email'])->first();

    if (!$auth){
      $provider_data['twich_id'] = $provider_data['id'];
      return User::create($provider_data);
    }

    if ($auth['twich_id'] == $provider_data['id']){
      return $auth;
    }

    throw \Exception('deu ruim');

}













?>
