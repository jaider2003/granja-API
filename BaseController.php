<?php
require_once __DIR__ . '/../../inc/bootstrap.php';

class BaseController {
    protected $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    protected function sendJson($data, $code = 200) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
