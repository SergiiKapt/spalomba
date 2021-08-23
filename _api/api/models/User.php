<?php

namespace api\models;

use api\controllers\Auth;
use api\core\RestApi;
use api\core\components\Db;
use PDO;

class User extends RestApi
{

    private $tableName = "users";

    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $role;
    public $info;
    public $created_at;

    public function __construct()
    {
        $db = new Db();
        $this->connect = $db->getConnection();
    }

    public function auth()
    {

    }

    function index()
    {
//        Auth::AccessAdmin();
        if(!Auth::isAdmin()){
            $this->show(Auth::getAuthData()->id);
        }
        $query = "SELECT" .
//                "email, first_name, last_name, role, info, create_at " .
            " * " .
            "FROM
                " . $this->tableName . "
            ORDER BY
                created_at DESC";

        $stmt = $this->connect->prepare($query);

        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {

            $users_arr = [
                'status' => 'success',
                'data' => [
                    'list' => []
                ]
            ];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $user_item = [
                    "id" => $id,
                    "email" => $email,
                    "password" => $password,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "role" => $role,
                    "info" => html_entity_decode($info),
                    "date" => $date,
                ];


                array_push($users_arr["data"]['list'], $user_item);
            }

            http_response_code(200);

            echo json_encode($users_arr, JSON_UNESCAPED_UNICODE);

            exit;

        } else {

            http_response_code(200);

            echo json_encode([
                'status' => 'error',
                'message' => 'Users not found'
            ]);

            exit;
        }
    }

    function show($id= false)
    {

        $this->getUser($id);
        $user_arr = [
            "id" => $this->id,
            "email" => $this->email,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "role" => $this->role,
            "info" => $this->info,
            "created_at" => $this->created_at,
        ];

            http_response_code(200);

        echo json_encode([
            'status' => 'success',
            'data' => $user_arr
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    public function getUser($authUserId = false)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE id=" . ( $authUserId ?$authUserId: $this->requestUri[2] ) . " LIMIT 0,1";

        $stmt = $this->connect->prepare($query);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            extract($row);
            $this->id = $row['id'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->role = $row['role'];
            $this->info = $row['info'];
            $this->created_at = $row['created_at'];

        } else {
            http_response_code(200);

            echo json_encode([
                    'status' => 'error',
                    'message' => 'User does not exist.'
                ]);

            exit;
        }
    }

    function create()
    {
        Auth::AccessAdmin();

        $this->email = $this->requestParams['email'] ?? '';
        $this->password = $this->requestParams['password'];
        $confirm_pass = $this->requestParams['confirm_pass'];
        $this->first_name = $this->requestParams['first_name'] ?? '';
        $this->last_name = $this->requestParams['last_name'] ?? '';
        $this->info = $this->requestParams['info'] ?? '';
        if (!$this->password || !$confirm_pass || $this->requestParams['password'] != $this->requestParams['confirm_pass']) {
            http_response_code(503);

            echo json_encode([
                'status' => 'error',
                'message' => 'Password or confirm password error'
            ]);

            exit;

        }
        if ($this->email && $this->first_name) {
            $query = "INSERT INTO {$this->tableName} SET
                email=:email, 
                password=:password, 
                first_name=:first_name, 
                last_name=:last_name, 
                role=:role,
                info=:info, 
                created_at=:created_at";

            $stmt = $this->connect->prepare($query);

            $this->email = htmlspecialchars(strip_tags($this->email));
//            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->role = 0;
            $this->info = htmlspecialchars(strip_tags($this->info));
            $this->created_at = htmlspecialchars(strip_tags(date('Y-m-d H:i:s')));

            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", md5($this->password));
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":role", $this->role);
            $stmt->bindParam(":info", $this->info);
            $stmt->bindParam(":created_at", $this->created_at);

            if ($stmt->execute()) {
                http_response_code(201);

                echo json_encode([
                    'status' => 'success',
                    'message' => 'User was created.'
                ]);

                exit;

            } else {
                http_response_code(503);

                echo json_encode([
                    'status' => 'error',
                    'message' => $stmt->errorInfo()
                ]);

                exit;
            }
        }

        http_response_code(503);

        echo json_encode([
            'status' => 'error',
            'message' => 'Unable to create user.'
        ]);

        exit;
    }

    function update()
    {
        Auth::AccessAdmin();

        $this->requestUri[2] = 8;
        $this->getUser();

        $this->email = $this->requestParams['email'];
        $this->password = $this->requestParams['password'] != '' ? $this->requestParams['password'] : $this->password;
        $confirm_pass = $this->requestParams['confirm_pass'];
        $this->first_name = $this->requestParams['first_name'];
        $this->last_name = $this->requestParams['last_name'];
        $this->info = $this->requestParams['info'];

        if ($this->requestParams['password'] != '' && $confirm_pass != $this->requestParams['password']) {
            http_response_code(200);

            echo json_encode([
                'status' => 'error',
                'message' => 'Password is уьзен or does not match.'
            ]);

            exit;

            return $this->response("Password or confirm password error", 400);
        }

        if (!$this->email) {
            http_response_code(200);

            echo json_encode([
                'status' => 'error',
                'message' => 'Email is empty.'
            ]);

            exit;

        }
        if (!$this->first_name) {
            http_response_code(200);

            echo json_encode([
                'status' => 'error',
                'message' => 'First name is empty.'
            ]);

            exit;

        }
        $query = "UPDATE
                " . $this->tableName . "
            SET
                email=:email, 
                password=:password, 
                first_name=:first_name, 
                last_name=:last_name, 
                info=:info, 
                created_at=:created_at
            WHERE
                id = {$this->requestUri[2]}";

        $stmt = $this->connect->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->info = htmlspecialchars(strip_tags($this->info));
        $this->created_at = htmlspecialchars(strip_tags(date('Y-m-d H:i:s')));

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':info', $this->info);
        $stmt->bindParam(':created_at', date('Y-m-d H:i:s'));

        if ($stmt->execute()) {
            $user_arr = array(
                "id" => $this->id,
                "email" => $this->email,
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "info" => $this->info,
                "create_at" => $this->create_at,
            );

            http_response_code(200);

            echo json_encode([
                'status' => 'success',
                'message' => 'User was updated.',
                'record' => $user_arr
            ], JSON_UNESCAPED_UNICODE);

            exit;

        } else {
            http_response_code(503);
            echo json_encode([
                'status' => 'error',
                'message' => $stmt->errorInfo()[2]
            ]);

            exit;

        }
        http_response_code(503);

        echo json_encode([
            'status' => 'error',
            'message' => 'Unable to update user.'
        ]);

        exit;

    }

    function delete()
    {
        Auth::AccessAdmin();

        $this->requestUri[2] = 2;

        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";

        $stmt = $this->connect->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->requestUri[2]));

        $stmt->bindParam(1, $this->requestUri[2]);

        if ($stmt->execute()) {
            http_response_code(200);

            echo json_encode([
                'status' => 'success',
                'message' => 'User was deleted.'
            ]);

            exit;
        }

        http_response_code(503);

        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to delete user.'
        ]);

        exit;
    }

    public function login($data)
    {
        $query = "SELECT id, first_name, role
            FROM {$this->tableName}
            WHERE email = '{$data['email']}' AND password = '" . md5($data['password']) . "' LIMIT 0,1";
        $stmt = $this->connect->prepare($query);
        $stmt = $this->connect->prepare($query);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        }
        return false;
    }
}