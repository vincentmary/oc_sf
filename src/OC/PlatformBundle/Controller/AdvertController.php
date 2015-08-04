<?php
// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Form\AdvertEditType;
use OC\PlatformBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OC\PlatformBundle\Entity\Advert;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdvertController extends Controller {
    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException(
              "La page " . $page . " n'existe pas."
            );
        }

        // Ici je fixe le nombre d'annonces par page à 3
        // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
        $nbPerPage = 3;

        // On récupère notre objet Paginator
        $listAdverts = $this->getDoctrine()
          ->getManager()
          ->getRepository('OCPlatformBundle:Advert')
          ->getAdverts($page, $nbPerPage);

        // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
        $nbPages = ceil(count($listAdverts) / $nbPerPage);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException(
              "La page " . $page . " n'existe pas."
            );
        }

        // On donne toutes les informations nécessaires à la vue
        return $this->render(
          'OCPlatformBundle:Advert:index.html.twig',
          array(
            'listAdverts' => $listAdverts,
            'nbPages' => $nbPages,
            'page' => $page
          )
        );
    }

    public function viewAction($id)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Pour récupérer une annonce unique : on utilise find()
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        // On vérifie que l'annonce avec cet id existe bien
        if ($advert === null) {
            throw $this->createNotFoundException(
              "L'annonce d'id " . $id . " n'existe pas."
            );
        }

        // On récupère la liste des advertSkill pour l'annonce $advert
        $listAdvertSkills = $em->getRepository('OCPlatformBundle:AdvertSkill')
          ->findByAdvert($advert);

        // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
        return $this->render(
          'OCPlatformBundle:Advert:view.html.twig',
          array(
            'advert' => $advert,
            'listAdvertSkills' => $listAdvertSkills,
          )
        );
    }
    /**
    * @Security("has_role('ROLE_AUTEUR')")
    */
    public function addAction(Request $request)
    {

        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        $advert = new Advert();

        $form = $this->get('form.factory')->create(new AdvertType(), $advert);


        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($advert);

            $em->flush();

            $request->getSession()->getFlashBag()
              ->add('info', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cet article
            return $this->redirect(
              $this->generateUrl('oc_platform_view', array('id' => $advert->getId()))
            );
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
              'form' => $form->createView(),
          ));
    }

    public function editAction($id)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // On récupère l'entité correspondant à l'id $id
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($advert == null) {
            throw $this->createNotFoundException(
              "L'annonce d'id " . $id . " n'existe pas."
            );
        }

        $form = $this->get('form.factory')->create(new AdvertEditType(), $advert);

        return $this->render(
          'OCPlatformBundle:Advert:edit.html.twig',
          array(
            'advert' => $advert,
            'form' => $form->createView()
          )
        );
    }

    public function deleteAction($id, Request $request)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // On récupère l'entité correspondant à l'id $id
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($advert == null) {
            throw $this->createNotFoundException(
              "L'annonce d'id " . $id . " n'existe pas."
            );
        }

        $form = $this->createFormBuilder()
          ->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em->remove($advert);
            $em->flush();

            $request->getSession()->getFlashBag()
              ->add('info', 'Annonce bien supprimée.');

            // Puis on redirige vers l'accueil
            return $this->redirect($this->generateUrl('oc_platform_home'));
        }

        // Si la requête est en GET, on affiche une page de confirmation avant de delete
        return $this->render(
          'OCPlatformBundle:Advert:delete.html.twig',
          array(
            'advert' => $advert,
            'form' => $form->createView()
          )
        );
    }

    public function menuAction($limit = 3)
    {
        $listAdverts = $this->getDoctrine()
          ->getManager()
          ->getRepository('OCPlatformBundle:Advert')
          ->findBy(
            array(), // Pas de critère
            array('date' => 'desc'), // On trie par date décroissante
            $limit, // On sélectionne $limit annonces
            0 // À partir du premier
          );

        return $this->render(
          'OCPlatformBundle:Advert:menu.html.twig',
          array(
            'listAdverts' => $listAdverts
          )
        );
    }

    public function purgeAction($days)
    {
        $advert_purger = $this->get('oc_platform.advert_purger');

        $listAdverts = $advert_purger->purge($days);

        return $this->render(
          'OCPlatformBundle:Advert:purge.html.twig',
          array(
            'listAdverts' => $listAdverts
          )
        );
    }

    public function testAction() {
        $advert = new Advert;

        $advert->setDate(new \Datetime());  // Champ « date » OK
        $advert->setTitle('abc');           // Champ « title » incorrect : moins de 10 caractères
        //$advert->setContent('blabla');    // Champ « content » incorrect : on ne le définit pas
        $advert->setAuthor('A');            // Champ « author » incorrect : moins de 2 caractères

        // On récupère le service validator
        $validator = $this->get('validator');

        // On déclenche la validation sur notre object
        $listErrors = $validator->validate($advert);

        // Si le tableau n'est pas vide, on affiche les erreurs
        if(count($listErrors) > 0) {
            return new Response(print_r($listErrors, true));
        } else {
            return new Response("L'annonce est valide !");
        }
    }

}
