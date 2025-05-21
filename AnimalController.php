<?php
require_once 'BaseController.php';

class AnimalController extends BaseController {
    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new AnimalModel($this->pdo);
    }

    public function handleRequest($method, $params) {
        switch ($method) {
            case 'GET':
                if (isset($params[0])) {
                    $this->sendJson($this->model->getById($params[0]));
                } else {
                    $this->sendJson($this->model->getAll());
                }
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                $this->sendJson(['success' => $this->model->create($data)]);
                break;
            case 'PUT':
                if (isset($params[0])) {
                    $data = json_decode(file_get_contents("php://input"), true);
                    $this->sendJson(['success' => $this->model->update($params[0], $data)]);
                } else {
                    $this->sendJson(['error' => 'ID requerido'], 400);
                }
                break;
            case 'DELETE':
                if (isset($params[0])) {
                    $this->sendJson(['success' => $this->model->delete($params[0])]);
                } else {
                    $this->sendJson(['error' => 'ID requerido'], 400);
                }
                break;
            default:
                $this->sendJson(['error' => 'Método no permitido'], 405);
        }
    }
}
