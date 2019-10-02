<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Faker\Provider\DateTime;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $articles)
    {
        $articles = $articles->findAll();
        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => 'Bienvenue sur mon Blog',
        ]);
    }
    
    /**
    * @Route("/blog/new", name="blog_create")
    * @Route("/blog/{id}/edit", name="blog_edit")
    */
   public function create(Article $article = null, Request $request, EntityManagerInterface $manager)
   {
      // dump($request);
      if(!$article) {
          $article = new Article;
      }

      $form = $this->createForm(ArticleType::class, $article);

      $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('blog_show', [
            'id' => $article->getId()            
            ]);
        }
        dump($article);

       return $this->render('blog/create.html.twig', [
        'form' => $form->createView()
       ]);
   }

     /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
            'article' => $article,          
        ]);
    }
    
}
