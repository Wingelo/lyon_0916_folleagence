<?php

namespace LaFolleAgenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * @var \DateTime
     */
    private $publicationDate;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $openComment;

    /**
     * @var bool
     */
    private $statut;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Post
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return Post
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
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
    public function getContent($length = null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->content, 0, $length);
        else
            return $this->content;
    }

    /**
     * Set openComment
     *
     * @param boolean $openComment
     * @return Post
     */
    public function setOpenComment($openComment)
    {
        $this->openComment = $openComment;

        return $this;
    }

    /**
     * Get openComment
     *
     * @return boolean 
     */
    public function getOpenComment()
    {
        return $this->openComment;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     * @return Post
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean 
     */
    public function getStatut()
    {
        return $this->statut;
    }
    /**
     * @var string
     */
    private $oneToMany;

    /**
     * @var string
     */
    private $manyToMany;


    /**
     * Set oneToMany
     *
     * @param string $oneToMany
     * @return Post
     */
    public function setOneToMany($oneToMany)
    {
        $this->oneToMany = $oneToMany;

        return $this;
    }

    /**
     * Get oneToMany
     *
     * @return string 
     */
    public function getOneToMany()
    {
        return $this->oneToMany;
    }

    /**
     * Set manyToMany
     *
     * @param string $manyToMany
     * @return Post
     */
    public function setManyToMany($manyToMany)
    {
        $this->manyToMany = $manyToMany;

        return $this;
    }

    /**
     * Get manyToMany
     *
     * @return string 
     */
    public function getManyToMany()
    {
        return $this->manyToMany;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categorys;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publicationDate = new \DateTime();
    }

    /**
     * Add comments
     *
     * @param \LaFolleAgenceBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\LaFolleAgenceBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \LaFolleAgenceBundle\Entity\Comment $comments
     */
    public function removeComment(\LaFolleAgenceBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add categorys
     *
     * @param \LaFolleAgenceBundle\Entity\Category $categorys
     * @return Post
     */
    public function addCategory(\LaFolleAgenceBundle\Entity\Category $category)
    {
    	$this->categorys[] = $category;
        return $this;
    }

    /**
     * Remove categorys
     *
     * @param \LaFolleAgenceBundle\Entity\Category $categorys
     */
    public function removeCategory(\LaFolleAgenceBundle\Entity\Category $category)
    {
        $this->categorys->removeElement($category);
    }

    /**
     * Get categorys
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorys()
    {
        return $this->categorys;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
