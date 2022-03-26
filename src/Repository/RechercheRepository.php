<?php

namespace App\Repository;

use App\Entity\Recherche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recherche|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recherche|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recherche[]    findAll()
 * @method Recherche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recherche::class);
    }

    // /**
    //  * @return Recherche[] Returns an array of Recherche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recherche
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findRecherchesEtMediasContactEtEtatsEtEntreprisesEtAdressesEtEmployesByEtudiant($etudiant)
    {
        return $this->createQueryBuilder('rec')
                    ->select('rec,mec,eta,ent,adr,emp,etu')
                    ->join('rec.mediaContact', 'mec')
                    ->join('rec.etatsRecherche', 'eta')
                    ->join('rec.entreprise', 'ent')
                    ->join('ent.adresse', 'adr')
                    ->leftjoin('rec.employe', 'emp')
                    ->join('rec.etudiant', 'etu')
                    ->andWhere('etu = :etudiant')
                    ->setParameter('etudiant', $etudiant)
                    ->getQuery()
                    ->getResult()
        ;
    }

    public function findAllRecherchesEtEtudiantsEtMediasContactEtEtatsEtEntreprisesEtAdressesEtEmployes()
    {
        return $this->createQueryBuilder('rec')
                    ->select('rec,mec,eta,ent,adr,emp,etu')
                    ->join('rec.etudiant', 'etu')
                    ->join('rec.mediaContact', 'mec')
                    ->join('rec.etatsRecherche', 'eta')
                    ->join('rec.entreprise', 'ent')
                    ->join('ent.adresse', 'adr')
                    ->leftjoin('rec.employe', 'emp')
                    ->getQuery()
                    ->getResult()
        ;
    }
}
