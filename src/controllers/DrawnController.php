<?php
session_start();

class DrawnController extends AppController
{
    private $loceveRepository;
    private $ratingRepository;
    public function __construct()
    {
        parent::__construct();
        $this->loceveRepository = new LoceveRepository();
        $this->ratingRepository = new RatingRepository();

    }
    public function randomDrawn() {
        $loceves = $this->loceveRepository->getLoceves();
        if($loceves == null){
            return $this->render('main_menu');
        }

        $number = array_rand($loceves,1);
        $loceve = $loceves[$number];
        $user_rating = $this->ratingRepository->getRating($loceve->getName());

        $this->render('drawn', ['loceve' => $loceve, 'user_rating' => $user_rating]);
    }

    public function drawn() {
        $loceve = $this->loceveRepository->getLoceveByName( $_GET['loceve'] );
        $user_rating = $this->ratingRepository->getRating($loceve->getName());
        $this->render('drawn', ['loceve' => $loceve, 'user_rating' => $user_rating]);
    }
}