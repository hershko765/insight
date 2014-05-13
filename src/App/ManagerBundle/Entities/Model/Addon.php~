<?php

namespace App\ManagerBundle\Entities\Model;

use App\SourceBundle\Base\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App\ManagerBundle\Entities\Model\Addon
 *
 * @ORM\Table(name="addons")
 * @ORM\Entity(repositoryClass="App\ManagerBundle\Entities\Repository\Addon")
 */
class Addon extends Model
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=255)
	 */
	private $addon;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text")
	 */
	private $description;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=200)
	 */
	private $download_link;

	/**
	 * @var string
	 * @ORM\Column(type="datetime")
	 */
	private $last_updated;

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
     * Set addon
     *
     * @param string $addon
     * @return Addon
     */
    public function setAddon($addon)
    {
        $this->addon = $addon;

        return $this;
    }

    /**
     * Get addon
     *
     * @return string 
     */
    public function getAddon()
    {
        return $this->addon;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Addon
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set download_link
     *
     * @param string $downloadLink
     * @return Addon
     */
    public function setDownloadLink($downloadLink)
    {
        $this->download_link = $downloadLink;

        return $this;
    }

    /**
     * Get download_link
     *
     * @return string 
     */
    public function getDownloadLink()
    {
        return $this->download_link;
    }

    /**
     * Set last_updated
     *
     * @param \DateTime $lastUpdated
     * @return Addon
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->last_updated = $lastUpdated;

        return $this;
    }

    /**
     * Get last_updated
     *
     * @return \DateTime 
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }
}
