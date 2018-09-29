<?php

namespace App\Repository;

use App\Entity\Albums;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Album|null find($id, $lockMode = null, $lockVersion = null)
 * @method Album|null findOneBy(array $criteria, array $orderBy = null)
 * @method Album[]    findAll()
 * @method Album[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Albums::class);
    }

//    /**
//     * @return Album[] Returns an array of Album objects
//     */
    
    public function findAlbum($token)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.artist_token = :val')
            ->setParameter('val', $token)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }  

    public function findToken($token)
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
