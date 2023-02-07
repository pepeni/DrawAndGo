<?php

require_once 'Repository.php';
require_once 'UserRepository.php';
require_once 'LoceveRepository.php';

class RatingRepository extends Repository
{
    public function addRating(String $loceveName, int $rating) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO schema.ratings (id_user, id_loceve, rating)
            VALUES (?, ?, ?)
        ');

        $userRepository = new UserRepository();
        $loceveRepository = new LoceveRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);
        $loceveId = $loceveRepository->getLoceveIdByName($loceveName);

        $stmt->execute([
            $userId,
            $loceveId,
            $rating
        ]);

        $loceveRepository->communityRating($loceveName);
    }

    public function changeRating(String $loceveName, int $rating) {
        $stmt = $this->database->connect()->prepare('
            UPDATE schema.ratings SET rating = :value1 WHERE id_user = :id_user AND id_loceve = :id_loceve
        ');


        $userRepository = new UserRepository();
        $loceveRepository = new LoceveRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);
        $loceveId = $loceveRepository->getLoceveIDByName($loceveName);


        $stmt->bindParam(':value1', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);

        $stmt->execute();

        $loceveRepository->communityRating($loceveName);

    }

    public function checkRating(String $loceveName) : bool {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM schema.ratings WHERE id_user = :id_user AND id_loceve = :id_loceve
        ');


        $userRepository = new UserRepository();
        $loceveRepository = new LoceveRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);
        $loceveId = $loceveRepository->getLoceveIdByName($loceveName);

        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);

        $stmt->execute();

        $rating = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rating == false) {
            return false;
        } else {
            return true;
        }
    }

    public function getRating(String $loceveName) : int {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM schema.ratings WHERE id_user = :id_user AND id_loceve = :id_loceve
        ');


        $userRepository = new UserRepository();
        $loceveRepository = new LoceveRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);
        $loceveId = $loceveRepository->getLoceveIdByName($loceveName);

        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);

        $stmt->execute();

        $rating = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rating == false) {
            return 0;
        } else {
            return $rating['rating'];
        }
    }

    public function deleteUserRating() {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM schema.ratings WHERE id_user = :id_user
        ');


        $userRepository = new UserRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);


        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);

        $stmt->execute();

    }

    public function getAllRatings(String $loceveName): array {
        $loceveRepository = new LoceveRepository();
        $loceveId = $loceveRepository->getLoceveIDByName($loceveName);
        $result = [];


        $stmt = $this->database->connect()->prepare('
            SELECT rating FROM schema.ratings WHERE id_loceve = :id_loceve
        ');

        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);
        $stmt->execute();

        $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ratings as $rating){
            $result[] = $rating['rating'];
        }

        return $result;
    }
}