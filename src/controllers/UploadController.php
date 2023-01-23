<?php

use models\Lockeve;
require_once __DIR__.'/../models/Lockeve.php';
require_once __DIR__.'/../repository/LockeveRepository.php';

class UploadController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = "/../public/uploads/";
    private $messages = [];
    private $lockeveRepository;


    public function __construct()
    {
        parent::__construct();
        $this->lockeveRepository = new LockeveRepository();
    }

    public function upload(){

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            $lockeve = $this->lockeveRepository->getLockeveByName($_POST['name']);
            if($lockeve){
                $this->messages[] = 'Loceve with this name already exist!';
                return $this->render('upload', ["messages" => $this->messages]);
            }

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $this->messages[] = 'Loceve added successfully';

            $lockeve = new Lockeve($_POST['name'], $_POST['description'], $_FILES['file']['name'], $_POST['website'], $_POST['price'], 0, $_POST['choice']==="event");
            $this->lockeveRepository->addLockeve($lockeve);
            return $this->render('upload', ["messages" => $this->messages, 'loceve' => $lockeve]);
            //return $this->render('drawn', ['lockeve' => $lockeve]);
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
        $loceves = $this->lockeveRepository->getLockeves();
        $this->render('browse', ['loceves' => $loceves]);
    }

}