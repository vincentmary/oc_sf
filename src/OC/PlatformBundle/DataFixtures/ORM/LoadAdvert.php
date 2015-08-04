<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;

class LoadAdvert implements FixtureInterface {
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager) {

        $purgeDate = new \DateTime("- 2 days");

        $listAdverts = array(
          array(
            "title" => "[TO BE PURGED]Recherche développeur python",
            "author" => "Simon",
            "content" => "Nous recherchons un développeur Python por favor"
          ),
          array(
            "title" => "Recherche chef de projet Drupal",
            "author" => "Adrien",
            "content" => "URGENT: Chef de projet drupal"
          ),
          array(
            "title" => "Recherche sysadmin",
            "author" => "Michael",
            "content" => "Sysadmin sociable recherché"
          ),
          array(
            "title" => "Recherche chef de projet",
            "author" => "Marc",
            "content" => "Nous recherchons un super chef de projet"
          ),
          array(
            "title" => "Recherche développeur js",
            "author" => "Thomas",
            "content" => "[OLDER THAN PURGE LIMIT BUT WITH APPLICATION] URGENT: Développeur js"
          ),
          array(
            "title" => "Recherche papa",
            "author" => "Stromae",
            "content" => "OUTAIPAPAOUTAI???"
          )
        );

        foreach ($listAdverts as $listAdvert) {
            // On crée la catégorie
            $advert = new Advert();
            if (in_array($listAdvert['author'], array('Simon', 'Thomas'))) {
                $advert->setDate($purgeDate);
            }
            $advert->setTitle($listAdvert['title']);
            $advert->setAuthor($listAdvert['author']);
            $advert->setContent($listAdvert['content']);

            // On la persiste
            $manager->persist($advert);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}