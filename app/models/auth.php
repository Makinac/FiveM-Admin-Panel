<?php

class Auth
{
    private $usersFile;

    public function __construct($filePath = 'app/config/users.json')
    {
        $this->usersFile = $filePath;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function getAllUsers()
    {
        if (!file_exists($this->usersFile)) {
            throw new Exception('User file not found.');
        }

        return json_decode(file_get_contents($this->usersFile), true) ?: [];
    }

    public function login($username, $password)
    {
        $users = $this->getAllUsers();

        foreach ($users as $user) {
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'] ?? 'user',
                    'permissions' => $user['permissions'] ?? []
                ];

                return true;
            }
        }

        return false;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function hasPermission($permission)
    {
        if (!$this->isLoggedIn()) {
            return false;
        }

        if (in_array('*', $_SESSION['user']['permissions'])) {
            return true;
        }

        return in_array($permission, $_SESSION['user']['permissions']);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }

    public function changePassword($id, $password, $newPassword)
    {
        $users = $this->getAllUsers();

        foreach ($users as &$user) {
            if ($user['id'] === $id && password_verify($password, $user['password'])) {
                $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                file_put_contents($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));
                return true;
            }
        }

        return false;
    }
}

?>
