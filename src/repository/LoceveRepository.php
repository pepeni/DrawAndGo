<?php
session_start();
use models\Loceve;

require_once 'Repository.php';
require_once 'UserRepository.php';
require_once 'RatingRepository.php';
require_once __DIR__ . '/../models/Loceve.php';
class LoceveRepository extends Repository
{
    public function getLoceveById(int $id): ?Loceve
    {
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.loceves LEFT JOIN schema.were_there on id_loceve = loceves.id WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $loceve = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($loceve == false) {
            return null;
        }

        return new Loceve(
            $loceve['name'],
            $loceve['description'],
            $loceve['image'],
            $loceve['website'],
            $loceve['price'],
            $loceve['rating'],
            $loceve['event'],
            $loceve['number_of_votes'],
            (bool)$loceve['id_user']
        );
    }

    public function getLoceveByName(string $name): ?Loceve
    {
        $userRepository = new UserRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);

        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.loceves LEFT JOIN schema.were_there on id_loceve = loceves.id AND id_user = :id_user WHERE loceves.name = :name
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $loceve = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($loceve == false) {
            return null;
        }

        return new Loceve(
            $loceve['name'],
            $loceve['description'],
            $loceve['image'],
            $loceve['website'],
            $loceve['price'],
            $loceve['rating'],
            $loceve['event'],
            $loceve['number_of_votes'],
            (bool)$loceve['id_user']
        );
    }

    public function getLoceveIdByName(string $name): ?int
    {
        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.loceves WHERE loceves.name = :name
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $loceve = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($loceve == false) {
            return null;
        }

        return $loceve['id'];
    }

    public function getLocevesByName(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';

        $userRepository = new UserRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);

        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.loceves LEFT JOIN schema.were_there ON id_loceve = loceves.id AND id_user = :id_user WHERE LOWER(schema.loceves.name) LIKE :search
        ');
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addLoceve(Loceve $loceve) :void
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
                INSERT INTO schema.loceves ( name, description, rating, website, price, image, number_of_votes, created_at, event, id_users)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?,  ?, ?)
        ');

        $userRepository = new UserRepository();
        $assignedByID = $userRepository->getUserId($_SESSION['nick']);
        $numberOfVotes = 0;


        $stmt->execute(
            [
                $loceve->getName(),
                $loceve->getDescription(),
                $loceve->getRating(),
                $loceve->getWebsite(),
                $loceve->getPrice(),
                $loceve->getImage(),
                $numberOfVotes,
                $date->format('Y-m-d'),
                $loceve->getEvent()? 't':'f',
                $assignedByID
            ]
        );
    }

    public function getLoceves(): array
    {
        $result = [];
        $userRepository = new UserRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);

        $stmt = $this->database->connect()->prepare('
                SELECT * FROM schema.loceves LEFT JOIN schema.were_there on id_loceve = loceves.id AND id_user = :id_user
        ');
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $loceves = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($loceves as $loceve){
            $result[] = new Loceve(
                $loceve['name'],
                $loceve['description'],
                $loceve['image'],
                $loceve['website'],
                $loceve['price'],
                $loceve['rating'],
                $loceve['event'],
                $loceve['number_of_votes'],
                (bool)$loceve['id_user']
            );
        }


        return $result;
    }

    public function addIWasThere(String $loceveName) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO schema.were_there (id_user, id_loceve)
            VALUES (?, ?)
        ');

        $userRepository = new UserRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);
        $loceveId = $this->getLoceveIdByName($loceveName);

        $stmt->execute([
            $userId,
            $loceveId
            ]);
    }

    public function deleteIWasThere(String $loceveName) {

        $userRepository = new UserRepository();
        $loceveId = $this->getLoceveIdByName($loceveName);
        $userId = $userRepository->getUserId($_SESSION['nick']);

        $stmt = $this->database->connect()->prepare('
            DELETE FROM schema.were_there WHERE id_loceve = :id_loceve AND id_user = :id_user
        ');
        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);


        $stmt->execute();
    }

    public function checkIfIWasThere(String $loceveName): bool {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM schema.were_there WHERE id_user = :id_user AND id_loceve = :id_loceve
        ');
        $userRepository = new UserRepository();

        $userId = $userRepository->getUserId($_SESSION['nick']);
        $loceveId = $this->getLoceveIdByName($loceveName);

        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);

        $stmt->execute();

        $wasThere = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($wasThere == false) {
            return false;
        }
        else{
            return true;
        }
    }

    public function communityRating(String $loceveName) {

        $ratingRepository = new RatingRepository();
        $ratings = $ratingRepository->getAllRatings($loceveName);
        $loceveId = $this->getLoceveIDByName($loceveName);

        $finalRating = 0;
        $number_of_votes = 0;
        foreach ($ratings as $rating){
            $finalRating += $rating;
            $number_of_votes += 1;
        }
        if($number_of_votes > 0) {
            $finalRating = (int)round($finalRating / $number_of_votes);
        }



        $stmt = $this->database->connect()->prepare('
            UPDATE schema.loceves SET rating = :value1, number_of_votes = :value2 WHERE id = :id_loceve
        ');



        $stmt->bindParam(':value1', $finalRating, PDO::PARAM_INT);
        $stmt->bindParam(':value2', $number_of_votes, PDO::PARAM_INT);
        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);

        $stmt->execute();
    }

}