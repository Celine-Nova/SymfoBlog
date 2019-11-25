<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        // Création du formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, $user);
        
        //Récupération des données du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Encodage du mot de passe (security.yaml encoders bcrypt)
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }
    
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // fonction pour se connecter
    /**
     * @Route("/login", name="security_login")
     * 
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }

    // fonction pour se deconnecter
    /**
     * @Route("/deconnexion", name="security_logout")
     * 
     */
    public function logout()
    {
        // fonction qui ne fait rien car c'est le composant de securité qui s'en occupe. Cette fonction me sert a créer une route logout pour le transmettre dans le security.yaml
    }


}
