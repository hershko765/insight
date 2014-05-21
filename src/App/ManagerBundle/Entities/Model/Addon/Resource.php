<?php
namespace App\ManagerBundle\Entities\Model\Addon;

use App\SourceBundle\Base\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App\ManagerBundle\Entities\Model\Resource
 *
 * @ORM\Table(name="resources")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\ManagerBundle\Entities\Repository\Resource")
 */
class Resource extends Model
{
	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string", length=255)
	 */
	protected $name;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(type="datetime")
	 */
	protected $updated;

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
	 * Get resource name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get updated date
	 *
	 * @return integer
	 */
	public function getUpdated()
	{
		return $this->updated;
	}

	/**
	 * Set resource name
	 *
	 * @return string
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Resource
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }
}
