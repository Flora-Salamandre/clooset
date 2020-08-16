<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Color;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Fav;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Colors

        $colors_map = [
            ["label" => "Black", "code" => "#000000"],
            ["label" => "White","code" => "#ffffff"],
            ["label" => "Grey","code" => "#8b8b8b"],
            ["label" => "Brown","code" => "#844200"],
            ["label" => "Yellow","code" => "#ffff00"],
            ["label" => "Blue", "code" => "#0000ff"],
            ["label" => "Red", "code" => "#ff0000"],
            ["label" => "Green", "code" => "#00ff00"],
            ["label" => "Purple", "code" => "#55007f"],
            ["label" => "Orange", "code" => "#ff6600"],
            ["label" => "Pink", "code" => "#ffaaff"],
            ["label" => "Gold", "code" => "#f1ad03"],
            ["label" => "Silver", "code" => "#727377"],
        ];

        $colors = [];

        foreach ($colors_map as $c) {
            $color = new Color();
            $color->setLabel($c["label"]);
            $color->setCode($c["code"]);
            $manager->persist($color);
            array_push($colors, $color);
        }

        // Categories

        $categories_map = [
            ["label" => "Accessories", "icon" => "https://img.icons8.com/color/48/000000/red-purse.png"],
            ["label" => "Clothes", "icon" => "https://img.icons8.com/color/48/000000/t-shirt.png"],
            ["label" => "Cosmetics", "icon" => "https://img.icons8.com/color/48/000000/nail-polish.png"],
        ];

        $categories = [];

        foreach ($categories_map as $c) {
            $category = new Category();
            $category->setLabel($c["label"]);
            $category->setIcon($c["icon"]);
            $manager->persist($category);
            array_push($categories, $category);
        }

        // Users

        $users_map = [
            ["username" => "ilarsen" , "firstname" => "Ida", "lastname" => "Larsen", "picture" => "https://randomuser.me/api/portraits/women/63.jpg", "password" => "hover"],
            ["username" => "mlue" , "firstname" => "Mirko", "lastname" => "Laue", "picture" => "https://randomuser.me/api/portraits/men/28.jpg", "password" => "sandbox"],
            ["username" => "msanchez" , "firstname" => "Ida", "lastname" => "Sanchez", "picture" => "https://randomuser.me/api/portraits/women/52.jpg", "password" => "apple"],
        ];

        $users = [];

        foreach ($users_map as $u) {
            $user = new User();
            $user->setUsername($u["username"]);
            $user->setFirstname($u["firstname"]);
            $user->setLastname($u["lastname"]);
            $user->setPicture($u["picture"]);
            $user->setPassword($this->encoder->encodePassword($user, $u["picture"]));
            $manager->persist($user);
            array_push($users, $user);
        }

        // Articles

        $articles_map = [
            ["name" => "Robe poppeline stradivarius Doublée neuve étiquetée", "description" => "Une super robe que j'ai achetée d'occasion !", "user" => $users[0], "size" => 40, "price" => 15.00, "color1" => $colors[1], "color2" => null, "picture" => "https://images.vinted.net/thumbs/f800/00_07383_gwNHheu55JZaZYBnrYdU4r3q.jpeg?1591453147-87c319bb97b32d8e94c945ef566e6675dd173351", "category" => $categories[1], "brand" => "Stradivarius"],
            ["name" => "Robe longue zara jamais porté encore avec l'étiquette", "description" => "J'adore cette robe, je suis triste de m'en séparer :'(", "user" => $users[0], "size" => 42, "price" => 10.00, "color1" => $colors[9], "color2" => $colors[0], "picture" => "https://images.vinted.net/thumbs/f800/00_066cc_ZDjioBPtz6Ku3zstWKYS95gh.jpeg?1591453458-32716cc87fa62c623c64892447e9965fe7d9b359", "category" => $categories[1], "brand" => "Zara"],
            ["name" => "Robe style desigual hiver", "description" => "Dark et classe en même temps", "user" => $users[2], "size" => 36, "price" => 4.50, "color1" => $colors[0], "color2" => $colors[2], "picture" => "https://images.vinted.net/thumbs/f800/027f9_tGd3DaLevbdMtgXKt2g1muLH.jpeg?1571578452-c8d49f623578be8004fd9917880823e857c926e0", "category" => $categories[1], "brand" => "Frime Paris"],
            ["name" => "Magnifique porte-monnaie Louis Vuitton", "description" => null, "user" => $users[0], "size" => 0, "price" => 250.00, "color1" => $colors[8], "color2" => null, "picture" => "https://images.vinted.net/thumbs/f800/00_05fc4_hHMgF3Uyu5RS8jBbFD5nhsjj.jpeg?1591449138-cb83538cd125b63024d1b33fabbc9e3e8901c1ba", "category" => $categories[0], "brand" => "Louis Vuitton"],
            ["name" => "Bague en argent et turquoise cabochon t55 neuve", "description" => null, "user" => $users[1], "size" => 3, "price" => 20.00, "color1" => $colors[5], "color2" => $colors[12], "picture" => "https://images.vinted.net/thumbs/f800/00_06e12_p79u327gf4CeBQa6me7FvJ8s.jpeg?1591335513-0d179bc3347e232bf39f1eb7b0f1b86b2761f85b", "category" => $categories[0], "brand" => "Other"],
        ];

        $articles = [];

        foreach ($articles_map as $a) {
            $article = new Article();
            $article->setName($a["name"]);
            $article->setDescription($a["description"]);
            $article->setUser($a["user"]);
            $article->setSize($a["size"]);
            $article->setPrice($a["price"]);
            $article->setColor1($a["color1"]);
            $article->setColor2($a["color2"]);
            $article->setPicture($a["picture"]);
            $article->setCategory($a["category"]);
            $article->setBrand($a["brand"]);
            $manager->persist($article);
            array_push($articles, $article);
        }

        // Favs

        $favs_map = [
            ["user" => $users[0], "article" => $articles[4]],
        ];

        foreach ($favs_map as $f) {
            $fav = new Fav();
            $fav->setUser($f["user"]);
            $fav->setArticle($f["article"]);
            $manager->persist($fav);
        }

        $manager->flush();
    }
}
