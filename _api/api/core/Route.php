<?php

namespace api\core;

use Exception;
use api\controllers\Auth;
use api\models\User;
class Route
{
    protected static $requestUri;
    protected static $requestParams;

    public static function dispatch()
    {
        self::$requestUri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

        if (self::matchRoute(self::$requestUri)) {
            switch (self::$requestUri[1]) {
                case 'login' :
                    self::getObject('controllers\\', 'Auth', 'login' );
                    break;

                case 'logout' :
                    self::getObject('controllers\\', 'Auth', 'logout' );
                    break;

                case 'validate':
                    Auth::auth(self::$requestParams);
                    break;
                default :
                    self::getObject();
            }
        }
    }

    public static function matchRoute($url)
    {
        if(array_shift($url) !== 'api'){
            throw new Exception('API Not Found', 404);
        }

        return true;
    }

    public static function getObject($path = 'models\\', $classObject = false, $action = false)
    {
        $objectApi = '\api\\' . $path .  ucwords($classObject ? $classObject : self::$requestUri[1]);

        if(class_exists($objectApi)){
            $object = new $objectApi();
            $object->run(self::$requestUri, $action);
        } else {
            throw new Exception('Invalid Method Path', 405);
        }

    }
}