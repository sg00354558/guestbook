<?php

namespace App\Repository;

use App\Entity\Guestbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guestbook>
 *
 * @method Guestbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guestbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guestbook[]    findAll()
 * @method Guestbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuestbookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guestbook::class);
    }

        
    /**
     * add guestbook entry
     *
     * @param  mixed $entity
     * @param  mixed $flush
     * @return void
     */
    public function add(Guestbook $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

        
    /**
     * remove guestbook entry
     *
     * @return void
     */
    public function remove(Guestbook $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * findAll orderby id desc
     *
     * @return void
     */
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
}
