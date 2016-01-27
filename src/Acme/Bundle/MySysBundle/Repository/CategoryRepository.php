<?php

namespace Acme\Bundle\MySysBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
  public function findAllOrderedByPid()
  {
    return $this->getEntityManager()
            ->createQuery(
                'SELECT cat.id, cat.pid, cat.name FROM AcmeMySysBundle:Category cat'
            )
            ->getResult();
  }
}
