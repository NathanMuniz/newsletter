<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  private AuthRepository $userRepo;

  public function __construct(AuthRepository $userRepo)
  {
    $this->$userRepo = $userRepo;
  }

  public function getAuthenticate(Request $request)
  {

    try {

      $this->userRepo->authenticate($request['code']);
      return route('dashboard');
    } catch (\Exception $e) {
      dd($e->getMessage());
      return back();
    }
  }

  public function logout()
  {
    Auth::logout();
  }
}
