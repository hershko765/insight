<?php
namespace App\ManagerBundle\Entities\Model\Addon;

use App\SourceBundle\Base\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * @ORM\Column(name="category_id", type="integer")
	 * @ORM\Id
	 */
	protected $category_id;

	/**
	 * @var integer
	 * @ORM\Column(name="addon_id", type="integer")
	 * @ORM\Id
	 */
	protected $addon_id;

}
