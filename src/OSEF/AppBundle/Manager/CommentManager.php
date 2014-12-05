<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

namespace OSEF\AppBundle\Manager;

use OSEF\CommonBundle\Doctrine\BaseManager;
use OSEF\AppBundle\Entity\CommentRepository;

class CommentManager extends BaseManager
{
    /**
     * @return CommentRepository
     */
    public function getRepository()
    {
        return parent::getRepository();
    }
}
