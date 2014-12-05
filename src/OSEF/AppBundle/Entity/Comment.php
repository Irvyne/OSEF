<?php

namespace OSEF\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use OSEF\CommonBundle\Traits\DoctrineBehaviors as OSEFDB;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="OSEF\AppBundle\Entity\CommentRepository")
 */
class Comment
{
    use OSEFDB\Id,
        ORMBehaviors\Timestampable\Timestampable
    ;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="OSEF\AppBundle\Entity\Article")
     */
    private $article;


    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set article
     *
     * @param Article $article
     * @return Comment
     */
    public function setArticle(Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \OSEF\AppBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
