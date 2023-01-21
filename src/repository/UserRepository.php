<?php

use models\User;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['nick'],
            $user['salt'],
            $user['admin']
        );
    }

    public function getUserId(string $nick): ?int
    {
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.users WHERE nick = :nick
        ');
        $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return $user['id'];
    }


    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO schema.users_details (created_at)
            VALUES (?)
        ');

        $stmt->execute([
            $user->getDateTime()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO schema.users (salt, nick, email, password, id_users_details)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getSalt(),
            $user->getNick(),
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM schema.users_details WHERE created_at = :date
        ');
        $dateTime = $user->getDateTime();
        $stmt->bindParam(':date', $dateTime, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }
}