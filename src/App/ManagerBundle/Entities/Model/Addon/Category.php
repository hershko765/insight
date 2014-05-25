<?php
namespace App\ManagerBundle\Entities\Model\Addon;

use App\SourceBundle\Base\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * App\ManagerBundle\Entities\Model\Addon\Category
 *
 * @ORM\Table("addon_categories")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\ManagerBundle\Entities\Repository\Addon\Category")
 */
class Category extends Model
{

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Id
	 */
	protected $id;

	/**
	 * @var integer
	 * @ORM\Column(name="category_id", type="integer")
	 * @ManyToOne(targetEntity="App\ManagerBundle\Entities\Model\Category")
	 * @JoinColumn(name="category_id", referencedColumnName="id")
	 */
	protected $category_id;

	/**
	 * @var integer
	 * @ORM\Column(name="addon_id", type="integer")
	 * @ManyToOne(targetEntity="App\ManagerBundle\Entities\Model\Addon")
	 * @JoinColumn(name="addon_id", referencedColumnName="id")
	 */
	protected $addon_id;
}
