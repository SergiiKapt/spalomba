<?php

namespace api\controllers;

use api\core\Api;
use api\core\Route;
use api\models\User;
use Firebase\JWT\JWT;

class Auth extends Api
{
    public static $request;
    protected static $userAuthData = false;

    protected function getAction()
    {
        $method = $this->method;

        switch ($method) {
            case 'GET':
                if ($this->requestUri[1] == 'logout') {
                    return 'logout';
                }
                break;
            case 'POST':
                if ($this->requestUri[1] == 'login') {
                    return 'login';
                }
                break;
            default:
                return null;
        }
    }

    public static function getAuthData() {
        return self::$userAuthData;
    }
    public function login()
    {
        $requestParams = (array) json_decode(file_get_contents('php://input'), TRUE);
        $user = new User();
        $logged = $user->login($requestParams);

        if ($logged) {
            $jwt = $this->setToken($logged);


            http_response_code(200);

            echo json_encode(array(
                'status' => 'success',
                'message' => 'User logged in',
                'token' => $jwt), JSON_UNESCAPED_UNICODE);
            exit;
        }

        http_response_code(200);

        echo json_encode([
            'status' => 'error',
            'message' => 'User not found'
        ]);

        exit;
    }

    public function logout()
    {
        echo 'logout';
        die;

    }

    private function setToken($logged)
    {
        $time = time();
        $key = "test_eurolombard";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => $time,
            "nbf" => $time,
            "exp" => $time + 60 * 200,
            "data" => $logged
        );

        return JWT::encode($payload, $key);

    }

    public static function getToken(){
        $headers = array ();
        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        if($headers['Authorization']){

            return $headers['Authorization'];
        }
        return false;
    }
    public static function validateToken()
    {
        $jwt = self::getToken();
        if ($jwt) {

            try {
                $key = "test_eurolombard";
                // декодирование jwt
                $decoded = JWT::decode($jwt, $key, array('HS256'));
                self::$userAuthData = $decoded->data;

                return $decoded->data;

                return array(
                    'status' => 'success',
                    'message' => 'Access is allowed.',
                    'data' => $decoded->data
                );

            } catch (Exception $e) {

                return false;
            }
        }

        return false;
    }

    public static function isAdmin()
    {

        $token = self::validateToken();
        if ($token->role) {
            return true;
        }

        return false;
    }

    public static function logged()
    {
        if(!self::validateToken()){
            http_response_code(401);

            echo json_encode(array(
                'success' => 'error',
                "message" => "Access closed.",
            ));

            exit;
        }
    }

    public static function AccessAdmin()
    {
        if(!self::isAdmin()){
            http_response_code(200);

            echo json_encode(array(
                'success' => 'error',
                "message" => "Access closed.",
            ));

            exit;
        }
    }

}