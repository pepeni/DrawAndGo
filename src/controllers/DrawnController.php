<?php
session_start();

class DrawnController extends AppController
{
    private $loceveRepository;
    public function __construct()
    {
        parent::__construct();
        $this->loceveRepository = new LoceveRepository();
    }
    public function randomDrawn() {
        $loceves = $this->loceveRepository->getLoceves();
        if($loceves == null){
            return $this->render('main_menu');
        }

        $number = array_rand($loceves,1);
        $loceve = $loceves[$number];

        $this->render('drawn', ['loceve' => $loceve]);
    }

    public function drawn() {
        $loceve = $this->loceveRepository->getLoceveByName( $_GET['loceve'] );
        $this->render('drawn', ['loceve' => $loceve]);
    }
}