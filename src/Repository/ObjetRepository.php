<?php

namespace App\Repository;

use App\Entity\Objet;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Objet>
 */
class ObjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objet::class);
    }

//    /**
//     * @return Objet[] Returns an array of Objet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Objet
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

        public function index(ObjetRepository $repository, Request $request): Response
        {
           $filter = $request->get('filter','all');
           $objet = [];
           if($filter == 'all'){
                $objet = $repository->findAll();
           }elseif($filter == 'desc'){
                $objet = $repository->changeOrder();
           }


           return $this->render('home/index.html.twig', [
                'objet' => $objet,
           ]);

        }
}
