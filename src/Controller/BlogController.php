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
use Doctrine\ORM\Mapping\OrderBy;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $articles)
    {
        // je récupère tous les article que j'envoie dans la vue "index"
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
     *
     */
    // je créee un nouvel article via un fourmulaire et je récupère les données
   public function create(Article $article = null, Request $request, EntityManagerInterface $entityManager)
   {
      $form = $this->createForm(ArticleType::class, $article);

      $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        //$file = $form->get('image')->getData(); si erreur STRING
        $file = $article->getImage();
        $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

        try {
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        $article->setImage($fileName);
    
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('blog_show', [
            'id' => $article->getId()            
            ]);
        }
        

       return $this->render('blog/create.html.twig', [
        'form' => $form->createView()
       ]);
       

    }
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
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
