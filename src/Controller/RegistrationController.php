<?php
namespace App\Controller;

use App\Service\RegistrationService;

class RegistrationController
{
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=signup');
            exit;
        }

        try {
            $service = new RegistrationService();
            $status = $service->register($_POST);
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
            $status = 'error';
        }

        header('Location: index.php?page=signup&status=' . $status);
        exit;
    }
}
