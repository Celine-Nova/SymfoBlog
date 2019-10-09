<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $generator = \Faker\Factory::create('fr_FR');
        $populator = new \Faker\ORM\Doctrine\Populator($generator, $manager);

        $populator->addEntity(Category::class, 5, [
            'title' => function() use($generator) {
                return $generator->unique()->sentence($nbWords = 6, $variableNbWords = true); 
            },
            'description' => function() use ($generator) {
                return $generator->unique()->paragraph($nbSentences = 5, $variableNbSentences = true); 
            },

        ]);

        $populator->addEntity('App\Entity\Article', 3, [
            'title' => function() use ($generator) { 
                return $generator->unique()->sentence($nbWords = 6, $variableNbWords = true); 
            },
            'content' => function() use ($generator) { 
                return $generator->unique()->paragraph($nbSentences = 53, $variableNbSentences = true); 
            },
            'image' => function() use ($generator) { 
                return $generator->unique()->imageUrl($width = 640, $height = 480);
            }

        ]);

        $populator->addEntity(Comment::class, 7, [
            'author' => function() use($generator) {
                return $generator->unique()->name(); 
            },
            'content' => function() use ($generator) {
                return $generator->unique()->paragraph($nbSentences = 25, $variableNbSentences = true); 
            },
            'createdAt' => function() use($generator) {
                return $generator->dateTimeBetween($startDate = '-3 months', $endDate = 'now');
            }

        ]);
        // for ($i = 0; $i < 10; $i++) {
        //     $article = new Article();
        //     $article->setTitle('titre de larticle'.$i);
        //     $article->setContent('le contenu de larticle qui a une plus grande longueur que le titre');
        //     $article->setImage("http://via.placeholder.com/350x150");
        //     $article->setCreatedAt(new \DateTime());
        //     $manager->persist($article);
        // }
        // $product = new Product();
        // $manager->persist($product);
    $inserted = $populator->execute();

        $manager->flush();
    }
}
