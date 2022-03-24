<?php

namespace App\Controller;

use App\Entity\Client;

use App\Form\ClientType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client/list", name="client_list")
     */
    public function list()
    {
        $comptes = $this->getDoctrine()
            ->getRepository(Client::class)
            ->findAll();

        return $this->render('client/list_client.html.twig', ['clients' => $comptes]);
    }

    /**
     * @Route("/client/new", name="client_new")
     */
    public function new(Request $request)
    {
        $client = new Client();

        //podem personalitzar el text del botó passant una opció 'submit' al builder de la classe CompteType
        $form = $this->createForm(ClientType::class, $client );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // recollim els camps del formulari en l'objecte compte
            $client= $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nou client:'.$client->getNom().' creat!'
            );

            return $this->redirectToRoute('client_list');
        }

        return $this->render('client/client.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nou Client',
        ));
    }

    /**
     * @Route("/client/delete/{id}", name="client_delete", requirements={"id"="\d+"})
     */
    public function delete($id, Request $request)
    {
        $client = $this->getDoctrine()
            ->getRepository(Client::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($client);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Compte '.$client->getNom().' eliminat!'
        );

        return $this->redirectToRoute('client_list');
    }
}
