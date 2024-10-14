<?php
// app/models/User.php

class User extends Model {
    public function getUserByName($name) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data) {
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (name, password_hash) VALUES (?, ?)");
        return $stmt->execute([$data['name'], $passwordHash]);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT id, name FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
