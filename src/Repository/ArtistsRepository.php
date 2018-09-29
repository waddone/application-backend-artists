<?php

namespace App\Repository;

use App\Entity\Artists;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artists::class);
    }

//    /**
//     * @return Artist[] Returns an array of Artist objects
//     */
    
    public function findArtists($token)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.token = :val')
            ->setParameter('val', $token)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }    
}
