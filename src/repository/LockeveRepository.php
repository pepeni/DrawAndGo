<?php
session_start();
use models\Lockeve;

require_once 'Repository.php';
require_once 'UserRepository.php';
require_once __DIR__.'/../models/Lockeve.php';
class LockeveRepository extends Repository
{
    public function getLockeveById(int $id): ?Lockeve
    {
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.lockeves WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $lockeve = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($lockeve == false) {
            return null;
        }

        return new Lockeve(
            $lockeve['name'],
            $lockeve['description'],
            $lockeve['image'],
            $lockeve['website'],
            $lockeve['price'],
            $lockeve['rating'],
            $lockeve['event']
        );
    }

    public function getLockeveByName(string $name): ?Lockeve
    {
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.lockeves WHERE name = :name
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $lockeve = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($lockeve == false) {
            return null;
        }

        return new Lockeve(
            $lockeve['name'],
            $lockeve['description'],
            $lockeve['image'],
            $lockeve['website'],
            $lockeve['price'],
            $lockeve['rating'],
            $lockeve['event']
        );
    }

    public function getLockevesByName(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.lockeves WHERE LOWER(name) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addLockeve(Lockeve $lockeve) :void
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
                INSERT INTO schema.lockeves ( name, description, rating, website, price, image, number_of_votes, created_at, event, id_users)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?,  ?, ?)
        ');

        $userRepository = new UserRepository();
        $assignedByID = $userRepository->getUserId($_SESSION['nick']);
        $numberOfVotes = 0;


        $stmt->execute(
            [
                $lockeve->getName(),
                $lockeve->getDescription(),
                $lockeve->getRating(),
                $lockeve->getWebsite(),
                $lockeve->getPrice(),
                $lockeve->getImage(),
                $numberOfVotes,
                $date->format('Y-m-d'),
                $lockeve->getEvent()? 't':'f',
                $assignedByID
            ]
        );
    }

    public function getLockeves(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.lockeves
        ');
        $stmt->execute();

        $lockeves = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lockeves as $lockeve){
            $result[] = new Lockeve(
                $lockeve['name'],
                $lockeve['description'],
                $lockeve['image'],
                $lockeve['website'],
                $lockeve['price'],
                $lockeve['rating'],
                $lockeve['event']
            );
        }


        return $result;
    }

}