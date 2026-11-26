<?php
namespace App\Repository;

use App\Database\Mysql;
use App\Entity\User;

class UserRepository
{
    private \PDO $connect;

    public function __construct()
    {
        $this->connect = (new Mysql())->connectBDD();
    }

    public function exists(string $nickname, string $email): bool
    {
        $sql = 'SELECT id_user FROM `user` WHERE nickname = :nickname OR email = :email LIMIT 1';
        $request = $this->connect->prepare($sql);
        $request->bindValue(':nickname', $nickname);
        $request->bindValue(':email', $email);
        $request->execute();

        return $request->fetch(\PDO::FETCH_ASSOC) !== false;
    }

    public function create(User $user): void
    {
        $sql = 'INSERT INTO `user` (nickname, email, password) VALUES (:nickname, :email, :password)';
        $request = $this->connect->prepare($sql);
        $request->bindValue(':nickname', $user->getNickname());
        $request->bindValue(':email', $user->getEmail());
        $request->bindValue(':password', $user->getPassword());
        $request->execute();
    }

    public function findByNickname(string $nickname): array|false
    {
        $sql = 'SELECT id_user, nickname, email, password FROM `user` WHERE nickname = :nickname LIMIT 1';
        $request = $this->connect->prepare($sql);
        $request->bindValue(':nickname', $nickname);
        $request->execute();

        return $request->fetch(\PDO::FETCH_ASSOC);
    }
}
