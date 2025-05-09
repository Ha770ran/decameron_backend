<?php

class HotelModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllHotels() {
        $stmt = $this->pdo->prepare("SELECT * FROM hotels ORDER BY id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createHotel($data) {
        // Verifica que todos los campos obligatorios estén presentes
        if (!isset($data['name'], $data['address'], $data['city'], $data['nit'], $data['max_rooms'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            return false;
        }
    
        // Validar que max_rooms sea un número positivo
        if (!is_numeric($data['max_rooms']) || $data['max_rooms'] <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'El campo max_rooms debe ser un número mayor a cero.']);
            return false;
        }
    
        // Validar que el NIT no esté duplicado
        $checkNIT = $this->pdo->prepare("SELECT id FROM hotels WHERE nit = :nit");
        $checkNIT->execute([':nit' => $data['nit']]);
        if ($checkNIT->fetch()) {
            http_response_code(409);
            echo json_encode(['error' => 'El NIT ya está registrado.']);
            return false;
        }
    
        // Insertar el hotel
        $stmt = $this->pdo->prepare("
            INSERT INTO hotels (name, address, city, nit, max_rooms)
            VALUES (:name, :address, :city, :nit, :max_rooms)
        ");
    
        $success = $stmt->execute([
            ':name' => $data['name'],
            ':address' => $data['address'],
            ':city' => $data['city'],
            ':nit' => $data['nit'],
            ':max_rooms' => $data['max_rooms']
        ]);
    
        if ($success) {
            http_response_code(201);
            echo json_encode(['message' => 'Hotel creado exitosamente.']);
            return true;
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al insertar el hotel.']);
            return false;
        }
    }

    public function updateHotel($data) {
        if (!isset($data['id'], $data['name'], $data['address'], $data['city'], $data['nit'], $data['max_rooms'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            return false;
        }
    
        // Validar que max_rooms sea un número positivo
        if (!is_numeric($data['max_rooms']) || $data['max_rooms'] <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'max_rooms debe ser un número mayor a cero.']);
            return false;
        }
    
        // Verificar si el NIT ya existe para otro hotel
        $stmt = $this->pdo->prepare("SELECT id FROM hotels WHERE nit = :nit AND id != :id");
        $stmt->execute([':nit' => $data['nit'], ':id' => $data['id']]);
        if ($stmt->fetch()) {
            http_response_code(409);
            echo json_encode(['error' => 'El NIT ya está registrado en otro hotel.']);
            return false;
        }
    
        $stmt = $this->pdo->prepare("
            UPDATE hotels SET
                name = :name,
                address = :address,
                city = :city,
                nit = :nit,
                max_rooms = :max_rooms
            WHERE id = :id
        ");
    
        $success = $stmt->execute([
            ':name' => $data['name'],
            ':address' => $data['address'],
            ':city' => $data['city'],
            ':nit' => $data['nit'],
            ':max_rooms' => $data['max_rooms'],
            ':id' => $data['id']
        ]);
    
        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'Hotel actualizado correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar el hotel.']);
        }
    }
    
    public function deleteHotel($id) {
        // Verifica si tiene habitaciones asociadas
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM rooms WHERE hotel_id = :id");
        $check->execute([':id' => $id]);
        $count = $check->fetchColumn();
    
        if ($count > 0) {
            http_response_code(400);
            echo json_encode(['error' => 'No se puede eliminar un hotel con habitaciones asociadas.']);
            return false;
        }
    
        $stmt = $this->pdo->prepare("DELETE FROM hotels WHERE id = :id");
        $success = $stmt->execute([':id' => $id]);
    
        if ($success) {
            http_response_code(200);
            echo json_encode(['message' => 'Hotel eliminado correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar el hotel.']);
        }
    }    
}
