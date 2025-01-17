<?php
class changePasswordController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');

            $input = json_decode(file_get_contents('php://input'), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
                exit();
            }

            $oldPassword = $input['oldPassword'] ?? '';
            $newPassword = $input['newPassword'] ?? '';
            $confirmPassword = $input['confirmPassword'] ?? '';

            if ($newPassword !== $confirmPassword) {
                echo json_encode(['status' => 'error', 'message' => 'New passwords do not match']);
                exit();
            }

            $auth = new Auth();
            $userId = $_SESSION['user']['id'];

            if ($auth->changePassword($userId, $oldPassword, $newPassword)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        }
    }
}
?>