<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="Home", methods={"GET"})
     */
    public function home(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();

        return $this->render('default/home.html.twig', [
            'articles' => $articles,
        ]);
    }

}