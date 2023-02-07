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
    }

    public function changeRating(String $loceveName, int $rating) {
        $stmt = $this->database->connect()->prepare('
            UPDATE schema.ratings SET rating = :value1 WHERE id_user = :id_user AND id_loceve = :id_loceve
        ');


        $userRepository = new UserRepository();
        $loceveRepository = new LoceveRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);
        $loceveId = $loceveRepository->getLoceveIdByName($loceveName);

        $stmt->bindParam(':value1', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':id_loceve', $loceveId, PDO::PARAM_INT);

        $stmt->execute();
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

    public function deleteUserRating() {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM schema.ratings WHERE id_user = :id_user
        ');


        $userRepository = new UserRepository();
        $userId = $userRepository->getUserId($_SESSION['nick']);


        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);

        $stmt->execute();

    }
}