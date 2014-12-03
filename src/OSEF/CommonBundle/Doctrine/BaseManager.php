<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

namespace OSEF\CommonBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class BaseManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Constructor
     *
     * @param EntityManager $em
     * @param               $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em         = $em;
        $this->class      = $class;
        $this->repository = $em->getRepository($class);
    }

    public function refresh($entity)
    {
        $this->em->refresh($entity);
    }

    public function create($entity, $flush = true)
    {
        $this->em->persist($entity);

        if (true === $flush)
            $this->em->flush($entity);
    }

    public function update($entity)
    {
        $this->em->flush($entity);
    }

    public function delete($entity, $flush = true)
    {
        $this->em->remove($entity);

        if (true === $flush)
            $this->em->flush($entity);
    }

    public function flush($entity = null)
    {
        $this->em->flush($entity);
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }
}
