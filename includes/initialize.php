<?php
defined('DS') ? null : define('DS','/');
defined('SITE_ROOT') ? null : define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT'].DS.'PowerMass'.DS);
defined('LIB_PATH') ? null : define('LIB_PATH',SITE_ROOT.'includes'.DS);
defined('CLASS_PATH') ? null : define('CLASS_PATH',LIB_PATH.DS.'Models'.DS);

require_once(LIB_PATH.'config.php');
require_once(CLASS_PATH.'user.php');
require_once(LIB_PATH.'functions.php');
require_once(CLASS_PATH.'session.php');
require_once(CLASS_PATH.'item.php');
require_once(CLASS_PATH.'cart.php');
require_once(CLASS_PATH.'cart_items.php');
require_once(CLASS_PATH.'order.php');
require_once(CLASS_PATH.'category.php');
require_once(CLASS_PATH.'brand.php');
require_once(CLASS_PATH.'contact.php');










?>