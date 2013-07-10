<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-01-01 15:13:49 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: category ~ APPPATH/views/portfolio.php [ 12 ] in /Volumes/Files/Sites/pixeltenchi2.0/application/views/portfolio.php:12
2013-01-01 15:13:49 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/application/views/portfolio.php(12): Kohana_Core::error_handler(8, 'Undefined varia...', '/Volumes/Files/...', 12, Array)
#1 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(61): include('/Volumes/Files/...')
#2 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(348): Kohana_View::capture('/Volumes/Files/...', Array)
#3 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /Volumes/Files/Sites/pixeltenchi2.0/modules/site/views/public.php(40): Kohana_View->__toString()
#5 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(61): include('/Volumes/Files/...')
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(348): Kohana_View::capture('/Volumes/Files/...', Array)
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /Volumes/Files/Sites/pixeltenchi2.0/modules/site/classes/Controller/Site.php(144): Kohana_Controller_Template->after()
#9 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(87): Controller_Site->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Portfolio))
#12 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#14 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#15 {main} in /Volumes/Files/Sites/pixeltenchi2.0/application/views/portfolio.php:12
2013-01-01 15:22:55 --- EMERGENCY: ErrorException [ 1 ]: Call to a member function render() on a non-object ~ SYSPATH/classes/Kohana/Controller/Template.php [ 44 ] in :
2013-01-01 15:22:55 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-01-01 15:24:43 --- EMERGENCY: ErrorException [ 1 ]: Call to a member function render() on a non-object ~ SYSPATH/classes/Kohana/Controller/Template.php [ 44 ] in :
2013-01-01 15:24:43 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-01-01 15:43:58 --- EMERGENCY: View_Exception [ 0 ]: The requested view portfolio\detail could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2013-01-01 15:43:58 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(137): Kohana_View->set_filename('portfolio\detai...')
#1 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/View.php(12): Kohana_View->__construct('portfolio\detai...', NULL)
#2 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Controller/Public/Portfolio.php(43): View::factory('portfolio\detai...')
#3 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(84): Controller_Public_Portfolio->action_detail()
#4 [internal function]: Kohana_Controller->execute()
#5 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Portfolio))
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#9 {main} in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2013-01-01 16:15:19 --- EMERGENCY: ErrorException [ 1 ]: Call to a member function markdown() on a non-object ~ APPPATH/views/portfolio/detail.php [ 4 ] in :
2013-01-01 16:15:19 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-01-01 16:16:08 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/markdown/classes/Kohana/Markdown.php [ 198 ] in :
2013-01-01 16:16:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-01-01 16:34:00 --- EMERGENCY: Exception [ 0 ]: Specified key (created_date) does not exist! ~ MODPATH/kacela/classes/Kacela/Model/Model.php [ 106 ] in /Volumes/Files/Sites/pixeltenchi2.0/application/views/portfolio/detail.php:8
2013-01-01 16:34:00 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/application/views/portfolio/detail.php(8): Kacela\Model\Model->__get('created_date')
#1 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(61): include('/Volumes/Files/...')
#2 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(348): Kohana_View::capture('/Volumes/Files/...', Array)
#3 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /Volumes/Files/Sites/pixeltenchi2.0/modules/site/classes/Controller/Site.php(146): Kohana_Controller_Template->after()
#5 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(87): Controller_Site->after()
#6 [internal function]: Kohana_Controller->execute()
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Portfolio))
#8 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#10 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#11 {main} in /Volumes/Files/Sites/pixeltenchi2.0/application/views/portfolio/detail.php:8
2013-01-01 17:23:27 --- EMERGENCY: View_Exception [ 0 ]: The requested view lead_form could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137
2013-01-01 17:23:27 --- DEBUG: #0 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php(137): Kohana_View->set_filename('lead_form')
#1 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/View.php(12): Kohana_View->__construct('lead_form', Array)
#2 /Volumes/Files/Sites/pixeltenchi2.0/modules/site/classes/Controller/Public.php(36): View::factory('lead_form', Array)
#3 /Volumes/Files/Sites/pixeltenchi2.0/application/classes/Controller/Public/Index.php(17): Controller_Public->lead_form()
#4 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Controller.php(84): Controller_Public_Index->action_inquire()
#5 [internal function]: Kohana_Controller->execute()
#6 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Public_Index))
#7 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#9 /Volumes/Files/Sites/pixeltenchi2.0/index.php(118): Kohana_Request->execute()
#10 {main} in /Volumes/Files/Sites/pixeltenchi2.0/system/classes/Kohana/View.php:137