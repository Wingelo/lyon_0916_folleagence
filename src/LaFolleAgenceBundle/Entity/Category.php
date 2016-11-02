<?php

namespace LaFolleAgenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $categoryName;


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
     * Set categoryName
     *
     * @param string $categoryName
     * @return Category
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
		$this->setCategorySlug($categoryName);
        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string 
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $posts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add posts
     *
     * @param \LaFolleAgenceBundle\Entity\Post $posts
     * @return Category
     */
    public function addPost(\LaFolleAgenceBundle\Entity\Post $post)
    {
		$this->posts[] = $post;
        return $this;
    }

    /**
     * Remove posts
     *
     * @param \LaFolleAgenceBundle\Entity\Post $posts
     */
    public function removePost(\LaFolleAgenceBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

	public function setPosts(\Doctrine\Common\Collections\Collection $posts)
	{

		foreach ($this->posts as $post){ // On parcours les anciens utilisateurs liés
			$post->getcategory()->removeElement($this);
		}

		$this->posts = $posts;
		foreach ($this->posts as $post){
			$post->addObjectif($this);
		}
	}

    /**
     * @param int $id
     */
	public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @var string
     */
    private $categorySlug;

	public function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('#[^\\pL\d]+#u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		if (function_exists('iconv'))
		{
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		}

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('#[^-\w]+#', '', $text);

		if (empty($text))
		{
			return 'n-a';
		}

		return $text;
	}

    /**
     * Set categorySlug
     *
     * @param string $categorySlug
     *
     * @return Category
     */
    public function setCategorySlug($categorySlug)
    {
        $this->categorySlug = $this->slugify($categorySlug);

        return $this;
    }

    /**
     * Get categorySlug
     *
     * @return string
     */
    public function getCategorySlug()
    {
        return $this->categorySlug;
    }
}
