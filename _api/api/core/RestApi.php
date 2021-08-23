<?php

namespace api\core;

use Exception;
use RuntimeException;

abstract class RestApi extends Api
{
    protected function getAction()
    {
        $method = $this->method;
        $this->requestId = $this->requestUri[2];
        switch ($method) {
            case 'GET':
                if ($this->requestId) {
                    return 'show';
                } else if ($this->requestUri[2]) {
                    return null;
                } else {
                    return 'index';
                }
                break;
            case 'POST':
                return 'create';
                break;
            case 'PUT':
                if ($this->requestId) {
                    return 'update';
                }
                return null;
                break;
            case 'DELETE':
                if ($this->requestId) {
                    return 'delete';
                }
                return null;
                break;
            default:
                return null;
        }
    }

    abstract protected function index();

    abstract protected function show();

    abstract protected function create();

    abstract protected function update();

    abstract protected function delete();
}