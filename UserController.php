<?php
require_once 'BaseController.php';

class UserController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel($this->pdo);
    }

    public function handleRequest($method, $params) {
        if ($method == 'GET' && count($params) == 0) {
            $this->sendJson($this->userModel->getAllUsers());
        } elseif ($method == 'GET' && isset($params[0])) {
            $this->sendJson($this->userModel->getUserById($params[0]));
        } elseif ($method == 'POST') {
            $input = json_decode(file_get_contents("php://input"), true);
            $success = $this->userModel->createUser($input);
            $this->sendJson(['success' => $success]);
        } else {
            $this->sendJson(['error' => 'Ruta o método inválido'], 405);
        }
    }
}
