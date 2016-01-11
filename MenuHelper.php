<?php
/**
 * @project     Yii2 AdminLTE Menu Widget
 * @filename    MenuHelper.php
 * @author      Mirdani Handoko <mirdani.handoko@gmail.com>
 * @copyright   copyright (c) 2015, Mirdani Handoko
 * @license     BSD-3-Clause
 */

namespace mzdani;

use Yii;
use yii\helpers\Html;

/**
 * Class MenuHelper extend Yii2 Admin by Misbahul Munir
 * @package mzdani
 */
class MenuHelper extends \mdm\admin\components\MenuHelper {
	public static function normalizeMenu(&$assigned, &$menus, $callback, $parent = null) {
		$result = [];
		$order  = [];
		foreach ($assigned as $id) {
			$menu = $menus[$id];
			if ($menu['parent'] == $parent) {
				$menu['children'] = static::normalizeMenu($assigned, $menus, $callback, $id);
				if ($callback !== null) {
					$item = call_user_func($callback, $menu);
				} else {
					$item = [
						'label' => $menu['name'],
						'url'   => static::parseRoute($menu['route']),
					];

					if($menu['icon'] != null){
						$item['icon'] = $menu['icon'];
					}

					if($menu['options'] != null){
						$item['options'] = eval($menu['options']);
					}

					if($menu['linkOptions'] != null){
						$item['linkOptions'] = eval($menu['linkOptions']);
					}

					if ($menu['children'] != []) {
						$item['items'] = $menu['children'];
					}
				}
				$result[] = $item;
				$order[]  = $menu['order'];
			}
		}
		if ($result != []) {
			array_multisort($order, $result);
		}

		return $result;
	}
}
