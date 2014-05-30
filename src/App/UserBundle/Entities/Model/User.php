<?php
namespace App\UserBundle\Entities\Model;

use App\SourceBundle\Base\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Serializable;
use App\SourceBundle\Base\Collection;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * App\UserBundle\Entities\Model\User
 *
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\UserBundle\Entities\Repository\User")
 */
class User extends Model implements UserInterface, Serializable
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(name="full_name", type="string", length=80)
	 */
	protected $full_name;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="username", type="string", length=20, unique=true)
	 */
	protected $username;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="password", type="string", length=60)
	 */
	protected $password;

	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @ORM\Column(name="email", type="string", length=60)
	 */
	protected $email;

	/**
	 * @var string
	 * @ORM\Column(name="phone", type="string", length=25)
	 */
	protected $phone;

	/**
	 * @var string
	 * @ORM\Column(name="birthday", type="datetime", nullable=TRUE)
	 */
	protected $birthday;

	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @ORM\Column(name="subscribe", type="integer")
	 */
	protected $subscribe;

	/**
	 * @var string
	 * @ORM\Column(name="updated", type="datetime")
	 */
	protected $updated;

	/**
	 * @var string
	 * @ORM\Column(name="created", type="datetime")
	 */
	protected $created;

	/**
	 * @var bool
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	protected  $isActive;

	/**
	 * @inheritDoc
	 */
	public function eraseCredentials() {}

	/**
	 * @inheritDoc
	 */
	public function getRoles()
	{
		return array('ROLE_USER');
	}

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
	 * @inheritDoc
	 */
	public function getSalt()
	{
		return null;
	}

	/**
	 * @see \Serializable::serialize()
	 */
	public function serialize()
	{
		return serialize(array(
				$this->id,
				$this->username,
				$this->password,
				// see section on salt below
				// $this->salt,
			));
	}

	/**
	 * @see \Serializable::unserialize()
	 */
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			// see section on salt below
			// $this->salt
			) = unserialize($serialized);
	}

    /**
     * Set full_name
     *
     * @param string $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->full_name = $fullName;

        return $this;
    }

    /**
     * Get full_name
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
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
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set subscribe
     *
     * @param integer $subscribe
     * @return User
     */
    public function setSubscribe($subscribe)
    {
        $this->subscribe = $subscribe;

        return $this;
    }

    /**
     * Get subscribe
     *
     * @return integer 
     */
    public function getSubscribe()
    {
        return $this->subscribe;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return User
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
}
