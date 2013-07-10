<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-12-28 12:44:58 --- EMERGENCY: View_Exception [ 0 ]: The requested view login could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2012-12-28 12:44:58 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(137): Kohana_View->set_filename('login')
#1 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/View.php(12): Kohana_View->__construct('login', NULL)
#2 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Controller/Public/Auth.php(19): View::factory('login')
#3 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(84): Controller_Public_Auth->action_login()
#4 [internal function]: Kohana_Controller->execute()
#5 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Auth))
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#9 {main} in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2012-12-28 12:45:14 --- EMERGENCY: View_Exception [ 0 ]: The requested view login could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2012-12-28 12:45:14 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(137): Kohana_View->set_filename('login')
#1 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/View.php(12): Kohana_View->__construct('login', NULL)
#2 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Controller/Public/Auth.php(19): View::factory('login')
#3 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(84): Controller_Public_Auth->action_login()
#4 [internal function]: Kohana_Controller->execute()
#5 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Auth))
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#9 {main} in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2012-12-28 12:45:32 --- EMERGENCY: View_Exception [ 0 ]: The requested view login could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2012-12-28 12:45:32 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(137): Kohana_View->set_filename('login')
#1 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/View.php(12): Kohana_View->__construct('login', NULL)
#2 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Controller/Public/Auth.php(19): View::factory('login')
#3 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(84): Controller_Public_Auth->action_login()
#4 [internal function]: Kohana_Controller->execute()
#5 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Auth))
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#9 {main} in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2012-12-28 14:27:39 --- EMERGENCY: ErrorException [ 1 ]: Call to a member function render() on a non-object ~ SYSPATH/classes/Kohana/Controller/Template.php [ 44 ] in :
2012-12-28 14:27:39 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2012-12-28 14:27:53 --- EMERGENCY: ErrorException [ 1 ]: Call to a member function render() on a non-object ~ SYSPATH/classes/Kohana/Controller/Template.php [ 44 ] in :
2012-12-28 14:27:53 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2012-12-28 14:38:09 --- EMERGENCY: Exception [ 0 ]: Failed to find mapper (Employee)! ~ MODPATH/kacela/vendor/Gacela/library/Gacela.php [ 287 ] in /Volumes/Files/Sites/pixeltenchi2.0/modules/kacela/classes/Kohana/Kacela.php:80
2012-12-28 14:38:09 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/modules/kacela/classes/Kohana/Kacela.php(80): Gacela->loadMapper('Employee')
#1 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/mapper/user.php(45): Kohana_Kacela::load('employee')
#2 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/mapper/user.php(18): Tenchi\Mapper\User->_load(Object(stdClass))
#3 /Volumes/Files/Sites/pixeltenchi2.0/modules/kacela/classes/Kohana/Kacela.php(46): Tenchi\Mapper\User->find('jneslen@yahoo.c...')
#4 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/model/user.php(23): Kohana_Kacela::find('user', 'jneslen@yahoo.c...')
#5 [internal function]: Tenchi\Model\User->authenticate(Array)
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Validation.php(377): call_user_func_array(Array, Array)
#7 /Volumes/Files/Sites/pixeltenchi2.0/modules/formo/classes/Formo/Core/Validator.php(180): Kohana_Validation->check()
#8 /Volumes/Files/Sites/pixeltenchi2.0/modules/formo/classes/Formo/Core/Validator.php(140): Formo_Core_Validator->_determine_errors()
#9 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Controller/Public/Auth.php(26): Formo_Core_Validator->validate()
#10 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(84): Controller_Public_Auth->action_login()
#11 [internal function]: Kohana_Controller->execute()
#12 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Auth))
#13 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#14 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#15 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#16 {main} in /Volumes/Files/Sites/pixeltenchi2.0/modules/kacela/classes/Kohana/Kacela.php:80
2012-12-28 14:40:18 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::redirect() ~ MODPATH/site/classes/Controller/Site.php [ 154 ] in :
2012-12-28 14:40:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2012-12-28 15:12:36 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::redirect() ~ MODPATH/site/classes/Controller/Site.php [ 151 ] in :
2012-12-28 15:12:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2012-12-28 15:18:29 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Admin' not found ~ APPPATH/classes/Controller/Admin/Index.php [ 3 ] in :
2012-12-28 15:18:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2012-12-28 15:20:20 --- EMERGENCY: ErrorException [ 8 ]: Undefined index:  view ~ APPPATH/classes/Kohana/Menu.php [ 21 ] in /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Kohana/Menu.php:21
2012-12-28 15:20:20 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Kohana/Menu.php(21): Kohana_Core::error_handler(8, 'Undefined index...', '/Volumes/Files/...', 21, Array)
#1 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Kohana/Menu.php(41): Kohana_Menu->__construct('menu/admin')
#2 /Volumes/Files/Sites/pixeltenchi2.0/modules/site/classes/Controller/Site.php(134): Kohana_Menu::factory('admin')
#3 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(87): Controller_Site->after()
#4 [internal function]: Kohana_Controller->execute()
#5 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Index))
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#9 {main} in /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Kohana/Menu.php:21
2012-12-28 15:20:45 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::redirect() ~ APPPATH/classes/Controller/Public/Auth.php [ 43 ] in :
2012-12-28 15:20:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :