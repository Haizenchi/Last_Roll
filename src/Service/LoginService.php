<?php

namespace App\Service;

use App\Repository\UserRepository;
use Lemmon\Validator\Validator;

class LoginService
{
    public function authenticate(array $data): string
    {
        $schema = Validator::isAssociative([
            'nickname' => Validator::isString()->pipe('trim')->between(4, 20)->required(),
            'password' => Validator::isString()->between(6, 24)->required(),
        ]);

        [$valid, $validatedData] = $schema->tryValidate($data);

        if (!$valid) {
            return 'invalid';
        }

        $nickname = $validatedData['nickname'];
        $password = $validatedData['password'];

        $repository = new UserRepository();

        $user = $repository->findByNickname($nickname);

        if ($user === false) {
            return 'invalid_credentials';
        }

        $passwordValid = password_verify($password, $user['password']);

        if ($passwordValid === false) {
            return 'invalid_credentials';
        }

        session_regenerate_id(true);

        $_SESSION['id_user'] = $user['id_user'];

        return 'success';
    }
}