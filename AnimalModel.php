<?php
class AnimalModel extends BaseDeDatos {
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM animales");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM animales WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO animales (tipo, raza, edad, peso, estado_salud) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['tipo'], $data['raza'], $data['edad'], $data['peso'], $data['estado_salud']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE animales SET tipo = ?, raza = ?, edad = ?, peso = ?, estado_salud = ? WHERE id = ?");
        return $stmt->execute([
            $data['tipo'], $data['raza'], $data['edad'], $data['peso'], $data['estado_salud'], $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM animales WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
