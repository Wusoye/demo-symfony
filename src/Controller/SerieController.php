<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series')]
class SerieController extends AbstractController
{
    #[Route('/', name: 'serie_list')]
    public function list(SerieRepository $serieRepository, Request $request): Response
    {
        //$listSerie = $serieRepository->findAll();
        /*$listSerie = $serieRepository->findBy(
            [],
            [
                'popularity' => 'DESC',
                'vote' => 'DESC'
            ]
        );*/
        $listSerie = $serieRepository->findBestSeries();
        return $this->render('serie/list.html.twig', [
            'listSerie' => $listSerie
        ]);
    }


    #[Route('/detail/{id}', name: 'serie_detail')]
    public function detail(SerieRepository $serieRepository, $id): Response
    {
        $uneSerie = $serieRepository->find($id);

        return $this->render('serie/datail.html.twig', [
            'uneSerie' => $uneSerie,
            'id' => $id
        ]);
    }

    #[Route('/create', name: 'serie_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $serie = new Serie();
        $serieForm = $this->createForm(SerieType::class, $serie);

        $serieForm->handleRequest($request);

        if ($serieForm->isSubmitted() && $serieForm->isValid()) {
            $serie->setDateCreated(new \DateTime());
            $entityManager->persist($serie);
            $entityManager->flush();

            $this->addFlash('succes', 'Serie added !');
            return $this->redirectToRoute('serie_list');
        }

        return $this->render('serie/create.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'serie_delete')]
    public function delete($id, SerieRepository $serieRepository, EntityManagerInterface $entityManager) {
        $serie = $serieRepository->find($id);

        if (!$serie) {
            throw $this->createNotFoundException('La série n\'existe pas.');
        }

        $entityManager->remove($serie);
        $entityManager->flush();

        return $this->redirectToRoute('serie_list');
    }

    #[Route('/demo', name: 'serie_demo')]
    public function demo(EntityManagerInterface $entityManager): Response
    {
        $newSerie = new Serie();
        $newSerie->setName('pif');
        $newSerie->setBackdrop('pif.png');
        $newSerie->setPoster('pif.png');
        $newSerie->setDateCreated(new \DateTime());
        $newSerie->setFirstAirDate(new \DateTime('-1 year'));
        $newSerie->setLastAirDate(new \DateTime('-6 months'));
        $newSerie->setGenre('SF');
        $newSerie->setOverview('Resssuuummmeee...');
        $newSerie->setPopularity(123.08);
        $newSerie->setVote(8.2);
        $newSerie->setStatus('Cancelled');
        $newSerie->setTmdbId(123456789);



        $entityManager->persist($newSerie);
        $entityManager->flush();

        dump($newSerie);

        $newSerie->setGenre('Comedy');

        $entityManager->persist($newSerie);
        $entityManager->flush();

        /*$entityManager->remove($newSerie);
        $entityManager->flush();*/

        return $this->render('serie/create.html.twig');
    }
}
