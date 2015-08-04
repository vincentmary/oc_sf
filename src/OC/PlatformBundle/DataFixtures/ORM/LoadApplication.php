<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Application;

class LoadApplication implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {

        $to = 1;
        $listApplications = array(
          array(
            "author" => "Farid",
            "content" => "Je suis un super chef de projet"
          ),
          array(
            "author" => "Romain",
            "content" => "Je suis un super développeur"
          ),
          array(
            "author" => "Pascal",
            "content" => "Je suis un super papa!"
          )
        );

        $em = $manager->getRepository('OCPlatformBundle:Advert');


        foreach ($listApplications as $listApplication) {
            // On crée la catégorie
            $application = new Application();
            $application->setAuthor($listApplication['author']);
            $application->setContent($listApplication['content']);
            switch ($listApplication['author']) {
                case 'Farid':
                    $advert = $em->findOneBy(array('title' => 'Recherche chef de projet'));
                    $application->setAdvert($advert);
                    break;
                case 'Romain':
                    $advert = $em->findOneBy(array('title' => 'Recherche développeur js'));
                    $application->setAdvert($advert);
                    break;
                case 'Pascal':
                    $advert = $em->findOneBy(array('title' => 'Recherche papa'));
                    $application->setAdvert($advert);
                    break;
            }

            // On la persiste
            $manager->persist($application);
        }

        // On déclenche l'enregistrement de toutes les applications
        $manager->flush();
    }
}