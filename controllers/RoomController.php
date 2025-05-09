<?php
require_once __DIR__ . '/../models/RoomModel.php';

class RoomController {
    private $model;

    public function __construct($pdo) {
        $this->model = new RoomModel($pdo);
    }

    public function handleRequest($method) {
        header('Content-Type: application/json');
    
        switch ($method) {
            case 'GET':
                $this->getRooms();
                break;
            case 'POST':
                $this->createRoom();
                break;
            case 'PUT':
                $this->updateRoom();
                break;
            case 'DELETE':
                $this->deleteRoom();
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Método no permitido']);
        }
    }
    
    private function getRooms() {
        if (!isset($_GET['hotel_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'hotel_id es requerido']);
            return;
        }

        $hotel_id = intval($_GET['hotel_id']);
        $rooms = $this->model->getRoomsByHotel($hotel_id);
        echo json_encode($rooms);
    }

    private function createRoom() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->model->createRoom($data);
    }

    private function updateRoom() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->model->updateRoom($data);
    }
    
    private function deleteRoom() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID de habitación no proporcionado.']);
            return;
        }
    
        $room_id = intval($_GET['id']);
        $this->model->deleteRoom($room_id);
    }    
}
