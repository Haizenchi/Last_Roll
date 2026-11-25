<?php
namespace App\Controller;

use App\Service\LoginService;

class LoginController
{
    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=login');
            exit;
        }

        try {
            $service = new LoginService();
            $status = $service->authenticate($_POST);
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
            $status = 'error';
        }

        if ($status === 'success') {
            header('Location: index.php?page=home');
            exit;
        }
            
        header('Location: index.php?page=login&status=' . $status);
        exit;
    }
}