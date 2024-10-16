<?php
    class Category extends Model {
        public function getAllCategories() {
            $stmt = $this->db->query("SELECT * FROM categories ORDER BY name ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCategoryById($id) {
            $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addCategory($data) {
            $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (:name)");
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

            return $stmt->execute();
        }

        public function updateCategory($id, $data) {
            $stmt = $this->db->prepare("UPDATE categories SET name = :name WHERE id = :id");

            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            return $stmt->execute();
        }

        public function deleteCategory($id) {
            $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>