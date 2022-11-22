<?php

namespace App\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_home")
     */
    public function home() {
        $series = [[
            'name' => 'Infinite',
            'sortie' => date('2022-09-10'),
            'type' => 'ScieFy',
            'duree' => 154
        ],[
            'name' => 'Interstellar',
            'sortie' => date('2017-06-18'),
            'type' => 'ScieFy',
            'duree' => 210
        ],[
            'name' => 'Le jour J',
            'sortie' => date('2025-12-25'),
            'type' => 'Docu.',
            'duree' => 65
        ]];
        /*return $this->render('main/home.html.twig', [
            'series' => $series
        ]);*/
        return $this->redirectToRoute('serie_list');
    }

    #[Route("/test", name: "main_test")]
    public function test() {
        return $this->render('main/test.html.twig');
    }

}