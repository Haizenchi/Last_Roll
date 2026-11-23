<?php
namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Lemmon\Validator\Validator;

class RegistrationService
{
    public function register(array $data): string
    {
        foreach (['nickname', 'email', 'password', 'confirm_password'] as $field) {
            if (!isset($data[$field]) || !is_string($data[$field])) {
                return 'invalid';
            }
        }

        $nickname = trim($data['nickname']);
        $email = trim($data['email']);
        $password = $data['password'];
        $confirmation = $data['confirm_password'];

        $nicknameValidator = Validator::isString()->between(4, 20);

        [$valid] = $nicknameValidator->tryValidate($nickname);

        if (!$valid) {
            return 'invalid';
        }

        $emailValidator = Validator::isString()->maxLength(255)->email();

        [$valid] = $emailValidator->tryValidate($email);

        if (!$valid) {
            return 'invalid';
        }

        $passwordValidator = Validator::isString()->between(6, 24);

        [$valid] = $passwordValidator->tryValidate($password);

        if (!$valid) {
            return 'invalid';
        }

        if ($password !== $confirmation) {
            return 'password_mismatch';
        }

        $repository = new UserRepository();

        if ($repository->exists($nickname, $email)) {
            return 'duplicate';
        }

        $user = new User();
        $user->setNickname($nickname);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $repository->create($user);

        return 'success';
    }
}
