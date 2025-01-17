<?php

class creatorController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');

            if (file_exists('app/config/config.json')) {
                echo json_encode(['status' => 'error', 'message' => 'Config already exists']);
                exit();
            }

            $input = file_get_contents('php://input');
            $data = json_decode($input, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
                exit();
            }

            $framework = $data['framework'] ?? '';
            $dbFramework = $data['dbFramework'] ?? '';
            $account = $data['account'] ?? '';

            if (empty($framework)) {
                echo json_encode(['status' => 'error', 'message' => 'Framework not selected']);
                exit();
            }

            if (empty($dbFramework) || empty($dbFramework['host']) || empty($dbFramework['user']) || empty($dbFramework['database'])) {
                echo json_encode(['status' => 'error', 'message' => 'Database not selected']);
                exit();
            }

            if (empty($dbFramework['port'])) {
                $dbFramework['port'] = 3306;
            }

            if (empty($dbFramework['password'])) {
                $dbFramework['password'] = '';
            }

            try {
                $dsn = "mysql:host={$dbFramework['host']};port={$dbFramework['port']};dbname={$dbFramework['database']}";
                $pdo = new PDO($dsn, $dbFramework['user'], $dbFramework['password']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()]);
                exit();
            }

            if (empty($account) || empty($account['username']) || empty($account['password']) || empty($account['confirm-password'])) {
                echo json_encode(['status' => 'error', 'message' => 'Master account not selected']);
                exit();
            }

            if ($account['password'] !== $account['confirm-password']) {
                echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
                exit();
            }

            if (strlen($account['password']) < 6) {
                echo json_encode(['status' => 'error', 'message' => 'Password is too short']);
                exit();
            }

            if (strlen($account['username']) < 2) {
                echo json_encode(['status' => 'error', 'message' => 'Username is too short']);
                exit();
            }

            $config = [
                'framework' => $framework,
                'dbFramework' => $dbFramework,
                'modules' => []
            ];
            file_put_contents('app/config/config.json', json_encode($config, JSON_PRETTY_PRINT));

            $users = [
                [
                    'id' => 1,
                    'username' => $account['username'],
                    'password' => password_hash($account['password'], PASSWORD_DEFAULT),
                    'master' => true,
                    'permissions' => ['*']
                ]
            ];
            file_put_contents('app/config/users.json', json_encode($users, JSON_PRETTY_PRINT));
            
            echo json_encode(['status' => 'success', 'message' => 'OK']);
        } else {
            if (file_exists('app/config/config.json')) {
                header("Location: /dashboard");
                exit();
            }

            require 'app/views/creator.php';
        }
    }
}
?>