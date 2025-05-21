<?php
class UserModel extends BaseDeDatos {
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, nombre, email, rol FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, email, rol FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, clave, rol) VALUES (?, ?, ?, ?)");
        $claveHashed = hash('sha256', $data['clave']);
        return $stmt->execute([$data['nombre'], $data['email'], $claveHashed, $data['rol']]);
    }
}
