Yii2 AdminLTE Menu
=============
Yii2 AdminLTE Menu Widget

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mdscomp/yii2-admin-lte-menu "*"
```

or add

```
"mdscomp/yii2-admin-lte-menu": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php
 use \mdscomp\NavLte;
 
$menuItems = [
	 [
		'label' => 'Parent Menu',
		'url' => '#',
		'icon' => 'fa-folder',
	],
	[
		'label' => 'Top Menu 1',
		'url' => '#',
		'icon' => 'fa-folder',
		'items' => [
			[
				'label' => 'Children Menu',
		        'url' => '#',
		        'icon' => 'fa-folder',
		        'items' => [
					[
				        'label' => 'Children Menu -> Children Menu',
				        'url' => '#',
				        'icon' => 'fa-folder',
				    ],
		        ],
		    ],
    ],
            ]
];
$mnu     = NavLte::begin([
	'items' => $menuItems,
]);

echo $mnu->renderItems();

?>```

Or, if you use [yii2-admin by Misbahul Munir](https://github.com/mdmsoft/yii2-admin) :

```php
<?php
$menuLst = MenuHelper::getAssignedMenu(Yii::$app->user->id);

$mnu     = \mdscomp\NavLte::begin([
	'items' => $menuLst,
]);

echo $mnu->renderItems();

?>```

[yii2-admin by Misbahul Munir](https://github.com/mdmsoft/yii2-admin) use cache, so if you want to force the cache, use "true" on "fourth" variable.

```php
<?php
$menuLst = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, null, true);

$mnu     = \mdscomp\NavLte::begin([
	'items' => $menuLst,
]);

echo $mnu->renderItems();

?>```

Because of default Yii2 Nav detect url route to set menu items to "active", you can do some trick to make this menu "active". For example :

```php
<?php
$routeCrud = ['view', 'create', 'update', 'delete'];
if(Yii::$app->request->pathInfo === ''){
	$routeSet = 'index';
} else {
	$routeSet = str_replace(Yii::$app->urlManager->suffix, '', Yii::$app->request->pathInfo);
	$routeSet = str_replace($routeCrud, 'index', $routeSet);
}

$menuLst = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, null, true);
$mnu     = \mdscomp\NavLte::begin([
	'items' => $menuLst,
	'route' => $routeSet,
]);
echo $mnu->renderItems();

?>```

this example will remove suffix from url and then convert url with action view, create, update, or 
delete, to "index". So, if your url http://local/some/view.php, it will be use to "some/index" to 
match the menu. Of course this is "stupid", but this is the best what I get till now. Maybe you can 
give me some advice. :)