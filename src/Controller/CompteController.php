<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Compte;
use App\Form\CompteType;

class CompteController extends AbstractController
{

    /**
     * @Route("/compte/list", name="compte_list")
     */
    public function list()
    {
        $comptes = $this->getDoctrine()
            ->getRepository(Compte::class)
            ->findAll();

        return $this->render('compte/list.html.twig', ['comptes' => $comptes]);
    }

    /**
     * @Route("/compte/new", name="compte_new")
     */
    public function new(Request $request)
    {
        $compte = new Compte();

        //podem personalitzar el text del botó passant una opció 'submit' al builder de la classe CompteType
        $form = $this->createForm(CompteType::class, $compte, array('submit'=>'Crear Compte'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // recollim els camps del formulari en l'objecte compte
            $compte = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nou compte '.$compte->getCodi().' creat!'
            );

            return $this->redirectToRoute('compte_list');
        }

        return $this->render('compte/compte.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nou Compte',
        ));
    }

    /**
     * @Route("/compte/delete/{id}", name="compte_delete", requirements={"id"="\d+"})
     */
    public function delete($id, Request $request)
    {
        $compte = $this->getDoctrine()
            ->getRepository(Compte::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($compte);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Compte '.$compte->getCodi().' eliminat!'
        );

        return $this->redirectToRoute('compte_list');
    }
}
