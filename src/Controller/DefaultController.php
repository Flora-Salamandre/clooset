<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(ArticleRepository $articleRepository, Request $request)
    {
        $category = $request->query->get('category');
        $search = $request->query->get('search');
        $maxPrice = $request->query->get('max_price');
        $color = $request->query->get('color');

        $articles = $articleRepository->findByFilters($category, $maxPrice, $search, $color);

        return $this->render('default/home.html.twig',
            ['articles' => $articles,
            ]
        );
    }
}