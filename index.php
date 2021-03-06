<?php
$dabr_start = microtime(1);

header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

require 'config.php';
require 'common/browser.php';
require 'common/menu.php';
require 'common/user.php';
require 'common/theme.php';
require 'common/twitter.php';
require 'common/lists.php';
require 'common/settings.php';

menu_register(array (
	//[+]online user
	'online' => array (
        'security' => true,
        'callback' => 'online_page',
    ),
	//[+]end
	'about' => array (
		'callback' => 'about_page',
	),
	'logout' => array (
		'security' => true,
		'callback' => 'logout_page',
	),
));

//[+]online user
function online_page() {
    require_once("online.php");
    theme('page', 'Online Users', $content);
}
//[+]end
function logout_page() {
	user_logout();
	header("Location: " . BASE_URL); /* Redirect browser */
	exit;
}

function about_page() {
	$content = file_get_contents('about.html');
	theme('page', 'About', $content);
}

browser_detect();
menu_execute_active_handler();
?>
