<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use \Firebase\JWT\JWT;
 
class Auth extends BaseController
{
    /*model*/
    protected $UsersModel;
    /*db*/
    protected $db;
	use ResponseTrait;
    
    public function __construct()
    {
        $this->mdl = new \App\Models\UsersModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
          
        $user = $this->mdl->where('email', $email)->first();
  
        if(is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
  
        $pwd_verify = password_verify($password, $user['password']);
  
        if(!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
 
        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
 
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
        );
         
        $token = JWT::encode($payload, $key, 'HS256');

        
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Login Berhasil'
            ],
            'token' => $token
        ];
         
        return $this->respond($response, 200);
    }
 
}