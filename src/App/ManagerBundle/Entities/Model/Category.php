<?php

namespace App\ManagerBundle\Entities\Model;

use Doctrine\Common\Collections\ArrayCollection;
use App\SourceBundle\Base\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\ManagerBundle\Entities\Model\Addon;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * App\ManagerBundle\Entities\Model\Category
 *
 * @ORM\Table(name="categories")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\ManagerBundle\Entities\Repository\Category")
 */
class Category extends Model
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @ManyToMany(targetEntity="Addon")
	 */
	protected $addons;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="title", type="string", length=100)
	 */
	protected $title;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="name", type="string", length=100)
	 */
	protected $name;

	/**
	 * @ORM\Column(name="parent_id", type="integer", nullable=TRUE)
	 */
	protected $parent_id;

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
	 * Get Name
	 *
	 * @return integer
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set Name
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this->name;
	}

    /**
     * Set parent_id
     *
     * @param integer $parentId
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parent_id = $parentId;

        return $this;
    }

    /**
     * Get parent_id
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Category
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
}
