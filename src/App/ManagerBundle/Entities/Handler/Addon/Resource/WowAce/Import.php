<?php
namespace App\ManagerBundle\Entities\Handler\Addon\Resource\WowAce;

use App\SourceBundle\Components\SilentLog;
use App\SourceBundle\Helpers\Arr;
use App\SourceBundle\Helpers\Dir;
use App\SourceBundle\Base\HandlerManager;
use App\SourceBundle\Base\HandlerGateway;
use DateTime;

/**
 * Class Import
 *
 * Import addons from WowAce, delete all old addons from this resource
 * and re import them
 *
 * @package App\ManagerBundle\Entities\Handler\Addon\Resource\WowAce
 */
class Import extends HandlerManager {

	public function initialize()
	{
		// HTML Dom parser
		include_once Dir::Src().'App/ManagerBundle/Entities/Handler/Addon/Resource/DomParser.php';
	}

	public function execute()
	{
		$categoriesArr = $this->getHandler('Category', 'Collect', 'Manager')
			->setSettings(['selectBox' => ['name', 'id']])
			->execute();

		for($i = 2; $i <= 78; $i++)
		{
			$pageHtml = file_get_contents('http://www.wowace.com/addons/?page='.$i);
			preg_match_all('/<h2><a href="\/addons\/(.*)\/">(.*)<\/a><\/h2>/', $pageHtml, $match);
			$merged = array_combine($match[1], $match[2]);
			
			$addon = [];
			$created = [];
			foreach($merged as $url => $title)
			{
				try {
					$addon = [];
					$addon['resource_id'] = 3;
					// Get Overview page HTML and extract description box
					$pageHtml = file_get_html('http://www.wowace.com/addons/'.$url);

					if ( ! $pageHtml) continue;

					$categories = $pageHtml->find('ul.category-list li a');
					$addonCategories = [];
					foreach($categories as $category)
					{
						preg_match('/category=(?<category>.*)/', $category->href, $match);
						if( Arr::get($match, 'category'))
						{
							$cat = Arr::get($categoriesArr, $match['category']);
							if($cat) $addonCategories[] = $cat;
						}
					}
					$addon['categories'] = $addonCategories;

					$desc = $pageHtml->find('div.content-box-inner', 0)->innertext;

					// Strip all ileagel tags and re create html object
					$desc = strip_tags($desc, '<p><h1><h2><ul><li>' );
					$desc = str_get_html($desc);

					// Assign title, Remove title from the object and assign the rest as description
					$addon['title'] =  strip_tags($title);
					// If page has own title use it
					if ($desc->find('h1', 0)) {
						$addon['title'] = strip_tags($desc->find('h1', 0)->outertext);
						$desc->find('h1', 0)->outertext = '';
					}
					$addon['name'] = strtolower(str_replace(' ', '_',$addon['title']));
					$img = $pageHtml->find('a.project-default-image img', 0);
					if ($img)
					{
						$imgSrc = preg_replace('/\w+x\w+/', '170x140', $img->src);
						copy(
							$imgSrc,
							'./web/media/img/addons/'.$addon['name'].'.jpg'
						);
					}
					else {
						copy('./web/media/img/noimage.jpg', './web/media/img/addons/'.$addon['name'].'.jpg');
					}
					if(Arr::get($created, $addon['title'])) continue;

					$addon['short_desc'] = substr(trim(strip_tags($desc->innertext), ' '), 0, 300);
					$addon['description'] = $desc->innertext;
					unset($pageHtml, $desc);

					// Get files page HTML and extract more data
					$pageHtml = file_get_html('http://www.wowace.com/addons/'.$url.'/files');

					if ( ! $pageHtml) continue;

					$pageHtml = str_get_html($pageHtml->find('table tbody tr', 2)->innertext);

					if ( ! $pageHtml) continue;

					// Add Last Release Datetime object
					$last_release = date("Y-m-d H:i:s",strtotime($pageHtml->find('td.col-date span', 0)->innertext));
					$addon['last_release'] = new DateTime($last_release);
					$addon['version'] = strip_tags($pageHtml->find('td.col-game-version', 0)->innertext);

					// Extract download link
					$preLink = $pageHtml->find('td.col-file a', 0)->href;
					$getLink = $this->getHandler('Addon:Resource:WowAce', 'GetLink', 'manager');
					$addon['download_link'] = $getLink->setLink($preLink)->execute();

					// Logging if the download link couldn't be extracted
					if ( ! $addon['download_link'])
						SilentLog::getInstance()->silentLog('Download Link Failed to extract '.$addon['title']);

					// Finally creating the addon
					$this->getHandler('Addon', 'Create', 'Manager')->setData($addon)->execute();
					echo "Addon Created ".$addon['title']."\n";
					$created[$addon['title']] = 1;

				}
				catch(\ErrorException $e)
				{
					echo "Failed to load addon".Arr::get($addon, 'title', '-Name Not Found-')."\n";
					continue;
				}
			}
		}
	}
}