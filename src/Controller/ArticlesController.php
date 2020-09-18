<?php


namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Repository\CategoryRepository;
use App\Repository\ColorRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles/{id}", name="getArticle", methods={"GET"})
     */
    public function getArticle(ArticleRepository $articleRepository, $id)
    {
        $article = $articleRepository->find($id);
        
        return $this->render('articles/get_article.html.twig',
            ['article' => $article,
            ]
        );
    }

    /**
     * @Route("/articles", name="getArticles", methods={"GET"})
     */
    public function getArticles(ColorRepository $colorRepository, CategoryRepository $categoryRepository)
    {
        $colors = $colorRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('articles/get_articles.html.twig', 
            ['colors' => $colors, 'categories' => $categories
            ]
        );
    }

    /**
     * @Route("/articles", name="postArticles", methods={"POST"})
     */
    public function postArticles(Request $request, ColorRepository $colorRepository, CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        $size = $request->request->get('size');
        $price = $request->request->get('price');
        $user = $userRepository->find('ilarsen');

        $color1String = $request->request->get('color1');
        $color1 = $colorRepository->find($color1String);
        
        $color2String = $request->request->get('color2');
        if ($color2String == "") {
            $color2 = null;
        } else {
            $color2 = $colorRepository->find($color2String);
        }

        $picture = $request->request->get('picture');
        $categoryString = $request->request->get('category');
        $category = $categoryRepository->find($categoryString);
        
        $brand = $request->request->get('brand');

        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setName($name);
        $article->setDescription($description);
        $article->setSize($size);
        $article->setPrice($price);
        $article->setUser($user);
        $article->setColor1($color1);
        $article->setColor2($color2);
        $article->setPicture($picture);
        $article->setCategory($category);
        $article->setBrand($brand);

        $entityManager->persist($article);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}