<?php

namespace App\Repository;

use App\Entity\Songs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Song|null find($id, $lockMode = null, $lockVersion = null)
 * @method Song|null findOneBy(array $criteria, array $orderBy = null)
 * @method Song[]    findAll()
 * @method Song[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SongsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Songs::class);
    }

//    /**
//     * @return Song[] Returns an array of Song objects
//     */
    public function findSongs($token)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.album_token = :val')
            ->setParameter('val', $token)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
