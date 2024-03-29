<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/users/(:any)'] = 'api/ApiUserController/index/$1';
$route['api/login'] = 'api/ApiUserController/login';
$route['api/register'] = 'api/ApiUserController/register';
$route['api/users/update/(:any)'] = 'api/ApiUserController/index/$1';
$route['api/users/delete/(:any)'] = 'api/ApiUserController/index/$1';
$route['api/questions'] = 'api/ApiQuestionController/index';
$route['api/quesion/create/(:any)'] = 'api/ApiQuestionController/index/$1';
$route['api/quesion/update/(:any)'] = 'api/ApiQuestionController/update/$1';
$route['api/quesion/delete/(:any)'] = 'api/ApiQuestionController/index/$1';
$route['api/answers/(:any)'] = 'api/ApiAnswerController/index/$1';
$route['api/answers/create/(:any)'] = 'api/ApiAnswerController/index/$1';
$route['api/upvote/update/(:any)'] = 'api/ApiQuestionController/upvote/$1';
$route['api/upvote/get'] = 'api/ApiQuestionController/upvote';
$route['api/upvote/ans/(:any)'] = 'api/ApiAnswerController/ansUpVote/$1';
$route['api/search'] = 'api/ApiSearchController/search';
$route['api/bookmarks/find/(:num)'] = 'api/ApiBookmarkController/find/$1';
$route['api/bookmarks/add/(:num)/(:num)'] = 'api/ApiBookmarkController/add/$1/$1';
$route['api/bookmarks/delete/(:num)/(:num)'] = 'api/ApiBookmarkController/remove/$1/$1';
$route['api/profile/question/(:num)'] = 'api/ApiQuestionController/findUserQuestion/$1';