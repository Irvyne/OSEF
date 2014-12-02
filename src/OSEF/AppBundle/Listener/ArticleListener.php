<?php

namespace OSEF\AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use OSEF\AppBundle\Entity\Article;

class ArticleListener
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Article) {
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Article) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}
