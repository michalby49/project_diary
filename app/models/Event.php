<?php
    class Event extends Model {
        public function getAllEvents() {
            $stmt = $this->db->query("
                SELECT events.*, categories.name AS category_name, users.name as user_name
                FROM events 
                LEFT JOIN categories ON events.category_id = categories.id 
                LEFT JOIN users ON events.user_id = users.id 
                ORDER BY start_date ASC");
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getEventsByUserId($user_id) {
            $stmt = $this->db->prepare("
                SELECT events.*, categories.name as category_name 
                FROM events 
                LEFT JOIN categories ON events.category_id = categories.id
                WHERE events.user_id = :user_id
                ORDER BY events.start_date ASC
            ");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addEvent($data) {
            $stmt = $this->db->prepare("
                INSERT INTO events (name, start_date, end_date, description, category_id, user_id)
                VALUES (:name, :start_date, :end_date, :description, :category_id, :user_id)
            ");

            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':start_date', $data['start_date'], PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $data['end_date'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);

            return $stmt->execute();
        }

        public function getEventById($id) {
            $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateEvent($data) {
            $stmt = $this->db->prepare("
                UPDATE events 
                SET name = :name, start_date = :start_date, end_date = :end_date, description = :description, category_id = :category_id, user_id = :user_id
                WHERE id = :id
            ");

            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':start_date', $data['start_date'], PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $data['end_date'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);

            return $stmt->execute();
        }

        public function deleteEvent($id) {
            $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
            $stmt->execute([$id]);
        }
    }
?>
