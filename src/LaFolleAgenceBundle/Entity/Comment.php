<?php

namespace LaFolleAgenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 */
class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $authorEmail;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $approved;


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
     * Set author
     *
     * @param string $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set authorEmail
     *
     * @param string $authorEmail
     * @return Comment
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }

    /**
     * Get authorEmail
     *
     * @return string 
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

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
     * Set approved
     *
     * @param boolean $approved
     * @return Comment
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }
    /**
     * @var string
     */
    private $manyToOne;


    /**
     * Set manyToOne
     *
     * @param string $manyToOne
     * @return Comment
     */
    public function setManyToOne($manyToOne)
    {
        $this->manyToOne = $manyToOne;

        return $this;
    }

    /**
     * Get manyToOne
     *
     * @return string 
     */
    public function getManyToOne()
    {
        return $this->manyToOne;
    }
    /**
     * @var \LaFolleAgenceBundle\Entity\Post
     */
    private $post;


    /**
     * Set post
     *
     * @param \LaFolleAgenceBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\LaFolleAgenceBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \LaFolleAgenceBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}
