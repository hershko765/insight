<?php
namespace App\ManagerBundle\Entities\Handler\Addon\Resource\WowAce;

use App\ManagerBundle\Entities\Repository\Addon\Resource;
use App\SourceBundle\Base\Repository\Repository;
use App\SourceBundle\Helpers\Dir;
use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Base\HandlerGateway;
/**
 * Class Import
 *
 * Import addons from WowAce, delete all old addons from this resource
 * and re import them
 *
 * @package App\ManagerBundle\Entities\Handler\Addon\Resource\WowAce
 */
class GetLink extends HandlerManager {

	protected $link;

	public function initialize()
	{
		// HTML Dom parser
		include_once Dir::Src().'App/ManagerBundle/Entities/Handler/Addon/Resource/DomParser.php';
	}

	public function setLink($link)
	{
		$this->link = $link;
		return $this;
	}

	public function execute()
	{
		$file = file_get_html(Resource::BASE_URL.$this->link);
		return $file->find('.user-action-download span a', 0)->href;

	}
}