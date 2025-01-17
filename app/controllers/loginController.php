<?php
class loginController
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

            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 0;
                $_SESSION['last_attempt_time'] = time();
            }

            $_SESSION['login_attempts'] = 0;

            if ($_SESSION['login_attempts'] >= 3) {
                $time_since_last_attempt = time() - $_SESSION['last_attempt_time'];
                if ($time_since_last_attempt < 900) {
                    echo json_encode(['status' => 'error', 'message' => 'Too many login attempts. Please try again later.']);
                    exit();
                } else {
                    $_SESSION['login_attempts'] = 0;
                }
            }

            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();

            $auth = new Auth();

            $username = $input['username'] ?? '';
            $password = $input['password'] ?? '';

            if ($auth->login($username, $password)) {
                usleep(500000);
                $_SESSION['login_attempts'] = 0;
                echo json_encode(['status' => 'success']);
                exit();
            } else {
                usleep(500000);
                echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
                exit();
            }
        } else {
            if (!file_exists('app/config/config.json')) {
                header("Location: /dashboard");
                exit();
            }

            require 'app/views/login.php';
        }
    }
}
?>