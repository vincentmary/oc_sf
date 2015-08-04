<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class AdvertRepository extends EntityRepository {
    public function getAdverts($page, $nbPerPage) {
        $query = $this->createQueryBuilder('a')
          ->leftJoin('a.image', 'i')
          ->addSelect('i')
          ->leftJoin('a.categories', 'c')
          ->addSelect('c')
          ->orderBy('a.date', 'DESC')
          ->getQuery();

        $query
          // On définit l'annonce à partir de laquelle commencer la liste
          ->setFirstResult(($page - 1) * $nbPerPage)
          // Ainsi que le nombre d'annonce à afficher sur une page
          ->setMaxResults($nbPerPage);

        // Enfin, on retourne l'objet Paginator correspondant à la requête construite
        // (n'oubliez pas le use correspondant en début de fichier)
        return new Paginator($query, TRUE);
    }

    public function myFindAll() {
        // Méthode 1 : en passant par l'EntityManager
        $queryBuilder = $this->_em->createQueryBuilder()
          ->select('a')
          ->from($this->_entityName, 'a');
        // Dans un repository, $this->_entityName est le namespace de l'entité gérée
        // Ici, il vaut donc OC\PlatformBundle\Entity\Advert

        // Méthode 2 : en passant par le raccourci (je recommande)
        $queryBuilder = $this->createQueryBuilder('a');

        // On n'ajoute pas de critère ou tri particulier, la construction
        // de note requête est finie

        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();

        // On récupère les résultats à partir de la Query
        $results = $query->getResult();

        // On retourne ces résultats
        return $results;
    }

    public function myFindOne($id) {
        $qb = $queryBuilder = $this->createQueryBuilder('a');

        $qb
          ->where('a.id = :id')
          ->setParameter('id', $id);

        return $qb
          ->getQuery()
          ->getResult();
    }

    public function findByAuthorAndDate($author, $year) {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.author = :author')
          ->setParameter('author', $author)
          ->andWhere('a.date < :year')
          ->setParameter('year', $year)
          ->orderBy('a.date', 'DESC');

        return $qb
          ->getQuery()
          ->getResult();
    }

    public function whereCurrentYear(QueryBuilder $qb) {
        $qb
          ->andWhere('a.date BETWEEN :debut AND :fin')
          ->setParameter('debut', new \Datetime(date('Y') . '-01-01')) // Date entre le 1er janvier de cette année
          ->setParameter('fin', new \Datetime(date('Y') . '-12-31')) // Et le 31 décembre de cette année
        ;

        return $qb;
    }

    public function myFind() {
        $qb = $this->createQueryBuilder('a');

        // On peut ajouter ce qu'on veut avant
        $qb
          ->where('a.author = :author')
          ->setParameter('author', 'Marine');

        // On applique notre condition
        $qb = $this->whereCurrentYear($qb);

        // On peut ajouter ce qu'on veut après
        $qb->orderBy('a.date', 'DESC');

        return $qb
          ->getQuery()
          ->getResult();
    }

    public function getAdvertWithCategories(array $categoryNames) {
        $qb = $this->createQueryBuilder('a');

        // On fait une jointure avec l'entité Category avec pour alias « c »
        $qb->join('a.categories', 'c');

        // Puis on filtre sur le nom des catégories à l'aide d'un IN
        $qb->where($qb->expr()->in('c.name', $categoryNames));
        // La syntaxe du IN et d'autres expressions se trouve dans la documentation Doctrine

        // Enfin, on retourne le résultat
        return $qb
          ->getQuery()
          ->getResult();
    }

    public function getPublishedQueryBuilder() {
        return $this
          ->createQueryBuilder('a')
          ->where('a.published = :published')
          ->setParameter('published', TRUE);
    }

    public function getAdvertWithNoApplications($days) {        ;
        $dateLimit = new \DateTime("- $days days");
        $qb = $this->createQueryBuilder('a');

        $qb
          ->where($qb->expr()->eq('a.nbApplications', '0'))
          ->andWhere('a.date < :dateLimit')
          ->setParameter('dateLimit', $dateLimit);

        return $qb
          ->getQuery()
          ->getResult();
    }


}
