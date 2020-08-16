<?php


namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\ColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="CreateArticle", methods={"GET"})
     */
    public function createArticle(ColorRepository $colorRepository, CategoryRepository $categoryRepository)
    {
        $colors = $colorRepository->findAll();
        $categories = $categoryRepository->findAll();
        return $this->render('articles/createArticle.html.twig', [
            'colors' => $colors, 'categories' => $categories
        ]);
    }

    /**
     * @Route("/articles/{id}", name="UpdateArticle", methods={"GET"})
     */
    public function updateArticle($id, ArticleRepository $articleRepository, ColorRepository $colorRepository, CategoryRepository $categoryRepository)
    {
        $article = $articleRepository->find($id);

        $colors = $colorRepository->findAll();
        $categories = $categoryRepository->findAll();
        return $this->render('articles/updateArticle.html.twig',
            ['article' => $article, 'colors' => $colors, 'categories' => $categories]
        );

    }
}