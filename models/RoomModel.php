<?php

class RoomModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getRoomsByHotel($hotel_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE hotel_id = :hotel_id");
        $stmt->execute([':hotel_id' => $hotel_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createRoom($data) {
        // Validar campos obligatorios
        if (!isset($data['hotel_id'], $data['room_type'], $data['accommodation'], $data['quantity'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            return false;
        }

        // Validar tipos permitidos
        $valid_types = ['ESTANDAR', 'JUNIOR', 'SUITE'];
        $valid_accommodations = ['SENCILLA', 'DOBLE', 'TRIPLE', 'CUÁDRUPLE'];

        if (!in_array($data['room_type'], $valid_types)) {
            http_response_code(400);
            echo json_encode(['error' => 'Tipo de habitación no válido.']);
            return false;
        }

        if (!in_array($data['accommodation'], $valid_accommodations)) {
            http_response_code(400);
            echo json_encode(['error' => 'Acomodación no válida.']);
            return false;
        }

        // Validar que la combinación no esté repetida
        $check = $this->pdo->prepare("
            SELECT id FROM rooms
            WHERE hotel_id = :hotel_id AND room_type = :room_type AND accommodation = :accommodation
        ");
        $check->execute([
            ':hotel_id' => $data['hotel_id'],
            ':room_type' => $data['room_type'],
            ':accommodation' => $data['accommodation']
        ]);
        if ($check->fetch()) {
            http_response_code(409);
            echo json_encode(['error' => 'Esta combinación ya existe para este hotel.']);
            return false;
        }

        // Validar límite de habitaciones
        $count = $this->pdo->prepare("
            SELECT COALESCE(SUM(quantity), 0) as total
            FROM rooms
            WHERE hotel_id = :hotel_id
        ");
        $count->execute([':hotel_id' => $data['hotel_id']]);
        $total_existing = $count->fetchColumn();

        $max = $this->pdo->prepare("SELECT max_rooms FROM hotels WHERE id = :id");
        $max->execute([':id' => $data['hotel_id']]);
        $max_rooms = $max->fetchColumn();

        if (($total_existing + $data['quantity']) > $max_rooms) {
            http_response_code(400);
            echo json_encode(['error' => 'Se excede el límite máximo de habitaciones permitidas.']);
            return false;
        }

        // Insertar habitación
        $stmt = $this->pdo->prepare("
            INSERT INTO rooms (hotel_id, room_type, accommodation, quantity)
            VALUES (:hotel_id, :room_type, :accommodation, :quantity)
        ");
        $success = $stmt->execute([
            ':hotel_id' => $data['hotel_id'],
            ':room_type' => $data['room_type'],
            ':accommodation' => $data['accommodation'],
            ':quantity' => $data['quantity']
        ]);

        if ($success) {
            http_response_code(201);
            echo json_encode(['message' => 'Habitación creada exitosamente.']);
            return true;
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al insertar habitación.']);
            return false;
        }
    }

    public function updateRoom($data) {
        if (!isset($data['id'], $data['quantity'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID y cantidad son obligatorios.']);
            return false;
        }
    
        if (!is_numeric($data['quantity']) || $data['quantity'] <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'La cantidad debe ser un número positivo.']);
            return false;
        }
    
        $stmt = $this->pdo->prepare("UPDATE rooms SET quantity = :quantity WHERE id = :id");
        $success = $stmt->execute([
            ':quantity' => $data['quantity'],
            ':id' => $data['id']
        ]);
    
        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'Habitación actualizada correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar la habitación.']);
        }
    }
    
    public function deleteRoom($id) {
        $stmt = $this->pdo->prepare("DELETE FROM rooms WHERE id = :id");
        $success = $stmt->execute([':id' => $id]);
    
        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'Habitación eliminada correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar la habitación.']);
        }
    }
    
}
