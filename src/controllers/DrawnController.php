<?php
session_start();

class DrawnController extends AppController
{
    private $lockeveRepository;
    public function __construct()
    {
        parent::__construct();
        $this->lockeveRepository = new LockeveRepository();
    }
    public function randomDrawn() {
        $loceves = $this->lockeveRepository->getLockeves();
        if($loceves == null){
            return $this->render('main_menu');
        }

        $number = array_rand($loceves,1);
        $lockeve = $loceves[$number];

        $this->render('drawn', ['lockeve' => $lockeve]);
    }

    public function drawn() {
        $lockeve = $this->lockeveRepository->getLockeveByName( $_GET['lockeve'] );
        $this->render('drawn', ['lockeve' => $lockeve]);
    }
}