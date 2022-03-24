<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Compte;
use App\Entity\Usuari;
use App\Form\ClientType;
use App\Form\UsuariType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuariController extends AbstractController
{
    /**
     * @Route("/usuari", name="usuari")
     */
    public function index(): Response
    {
        return $this->render('usuari/index.html.twig', [
            'controller_name' => 'UsuariController',
        ]);
    }

    /**
     * @Route("/usuari/list", name="usuari_list")
     */
    public function list()
    {
        $usuaris = $this->getDoctrine()
            ->getRepository(Usuari::class)
            ->findAll();

        return $this->render('usuari/list_usuari.html.twig', ['usuaris' => $usuaris]);
    }

    /**
     * @Route("/usuari/new", name="usuari_new")
     */
    public function new(Request $request)
    {
        $usuari = new Usuari();
        //podem personalitzar el text del botó passant una opció 'submit' al builder de la classe CompteType
        $form = $this->createForm(UsuariType::class, $usuari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // recollim els camps del formulari en l'objecte compte
            $usuari= $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuari);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nou usuari'.$usuari->getUsername().' creat!'
            );

            return $this->redirectToRoute('usuari_list');
        }

        return $this->render('usuari/usuari.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nou usuari.',
        ));
    }


}
