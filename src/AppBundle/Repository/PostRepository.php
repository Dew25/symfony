<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findOneByName($author)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM AppBundle:Post p WHERE p.lastname=$author')
            ->getResult();
    }
}