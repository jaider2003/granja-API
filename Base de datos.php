<?php
class BaseDeDatos {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
}
