<?php

namespace OC\PlatformBundle\AdvertPurger;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class OCAdvertPurger {
    protected $doctrine;

    public function __construct(Doctrine $doctrine) {
      $this->doctrine = $doctrine;
    }


    public function purge($days) {
      $em = $this->doctrine->getManager();

      $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->getAdvertWithNoApplications($days);

      foreach ($listAdverts as $advert) {
        $em->remove($advert);
      }
      $em->flush();
      return $listAdverts;
    }
}