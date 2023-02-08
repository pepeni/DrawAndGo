<?php

use models\Loceve;
require_once __DIR__ . '/../models/Loceve.php';
require_once __DIR__ . '/../repository/LoceveRepository.php';
require_once __DIR__ . '/../repository/RatingRepository.php';

class UploadController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = "/../public/uploads/";
    private $messages = [];
    private $loceveRepository;


    public function __construct()
    {
        parent::__construct();
        $this->loceveRepository = new LoceveRepository();
    }

    public function upload(){

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            $loceve = $this->loceveRepository->getLoceveByName($_POST['name']);
            if($loceve){
                $this->messages[] = 'Loceve with this name already exist!';
                return $this->render('upload', ["messages" => $this->messages]);
            }

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $this->messages[] = 'Loceve added successfully';

            $loceve = new Loceve($_POST['name'], $_POST['description'], $_FILES['file']['name'], $_POST['website'], $_POST['price'], 0, $_POST['choice']==="event", 0);
            $this->loceveRepository->addLoceve($loceve);
            return $this->render('upload', ["messages" => $this->messages, 'loceve' => $loceve]);
            //return $this->render('drawn', ['loceve' => $loceve]);
        }
        $this->render('upload', ["messages" => $this->messages]);
    }

    private function validate($file): bool
    {
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'File is to large for destination file system.';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES) ){
            $this->messages[] = 'File type is not supported.';
            return false;
        }

        return true;
    }

    public function browse() {
        $loceves = $this->loceveRepository->getLoceves();
        $this->render('browse', ['loceves' => $loceves]);
    }

    public function search(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): '';

        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->loceveRepository->getLocevesByName($decoded['search']));
        }
    }

    public function iWasThere(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): '';

        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            if($this->loceveRepository->checkIfIWasThere($decoded['loceve'])){
                $this->loceveRepository->deleteIWasThere($decoded['loceve']);
            } else{
                $this->loceveRepository->addIWasThere($decoded['loceve']);
            }


            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode('Changed');
        }
    }

    public function userRating(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]): '';


        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $ratingRepository = new RatingRepository();


            if($ratingRepository->checkRating($decoded['loceve'])){
                $ratingRepository->changeRating($decoded['loceve'], $decoded['rating']);
            } else{
                $ratingRepository->addRating($decoded['loceve'], $decoded['rating']);
            }


            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode('Changed');
        }
    }


}