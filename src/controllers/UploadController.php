<?php

use models\Lockeve;
require_once __DIR__.'/../models/Lockeve.php';

class UploadController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = "/../public/uploads/";
    private $messages = [];

    public function upload(){

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $this->messages[] = 'Loceve added successfully';

            $project = new Lockeve($_POST['name'], $_POST['description'], $_FILES['file']['name'], $_POST['website'], 3, 3.5);

            // $this->render('upload', ["messages" => $this->messages, 'project' => $project]);
            return $this->render('drawn', ['project' => $project]);
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

}