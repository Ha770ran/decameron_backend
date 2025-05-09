<?php
require_once __DIR__ . '/../models/HotelModel.php';

class HotelController {
    private $hotelModel;

    public function __construct($pdo) {
        $this->hotelModel = new HotelModel($pdo);
    }

    public function handleRequest($method) {
        header('Content-Type: application/json');
    
        switch ($method) {
            case 'GET':
                $this->getAllHotels();
                break;
            case 'POST':
                $this->createHotel();
                break;
            case 'PUT':
                $this->updateHotel();
                break;
            case 'DELETE':
                $this->deleteHotel();
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Método no permitido']);
        }
    }
     
    private function getHotels() {
        $hotels = $this->hotelModel->getAllHotels();
        echo json_encode($hotels);
    }

    private function createHotel() {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $this->hotelModel->createHotel($data);
        echo json_encode(['message' => $result ? 'Hotel creado' : 'Error al crear']);
    }

    private function updateHotel() {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $this->hotelModel->updateHotel($data);
        echo json_encode(['message' => $result ? 'Hotel actualizado' : 'Error al actualizar']);
    }

    private function deleteHotel() {
        // Obtener ID desde la URL
        if (!isset($_GET['id'])) {
            echo json_encode(['error' => 'ID no proporcionado']);
            return;
        }
        $id = $_GET['id'];
        $result = $this->hotelModel->deleteHotel($id);
        echo json_encode(['message' => $result ? 'Hotel eliminado' : 'Error al eliminar']);
    }

    private function updateHotel() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->model->updateHotel($data);
    }
    
    private function deleteHotel() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID del hotel no proporcionado.']);
            return;
        }
    
        $hotel_id = intval($_GET['id']);
        $this->model->deleteHotel($hotel_id);
    }    
}
?>
