<?php
/**
 * Referee URL Lister with Site Thumbnails Engines
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   	The XOOPS Project http://fonts2web.org.uk
 * @license     	General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      	Simon Roberts (wishcraft) <wishcraft@users.sourceforge.net>
 * @subpackage  	referee
 * @description 	Referee URL Lister with Site Thumbnails Engines
 * @version		    1.0.1
 * @link			http://internetfounder.wordpress.com
 */


if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

if (!defined(_MD_REFEREE_MODULE_DIRNAME))
	define('_MD_REFEREE_MODULE_DIRNAME', basename(__DIR__));

global $refereeModule, $refereeConfigsList, $refereeConfigs, $refereeConfigsOptions;

if (empty($refereeModule))
{
	if (is_a($refereeModule = xoops_gethandler('module')->getByDirname(_MD_REFEREE_MODULE_DIRNAME), "XoopsModule"))
	{
		if (empty($refereeConfigsList))
		{
			$refereeConfigsList = xoops_gethandler('config')->getConfigList($refereeModule->getVar('mid'));
		}
		if (empty($refereeConfigs))
		{
			$refereeConfigs = xoops_gethandler('config')->getConfigs(new Criteria('conf_modid', $refereeModule->getVar('mid')));
		}
		if (empty($refereeConfigsOptions) && !empty($refereeConfigs))
		{
			foreach($refereeConfigs as $key => $config)
				$refereeConfigsOptions[$config->getVar('conf_name')] = $config->getConfOptions();
		}
	}
}

$modversion['dirname'] 					= _MD_REFEREE_MODULE_DIRNAME;
$modversion['name'] 					= _MD_REFEREE_MODULE_NAME;
$modversion['version']     				= _MD_REFEREE_MODULE_VERSION;
$modversion['releasedate'] 				= _MD_REFEREE_MODULE_RELEASEDATE;
$modversion['status']      				= _MD_REFEREE_MODULE_STATUS;
$modversion['description'] 				= _MD_REFEREE_MODULE_DESCRIPTION;
$modversion['credits']     				= _MD_REFEREE_MODULE_CREDITS;
$modversion['author']      				= _MD_REFEREE_MODULE_AUTHORALIAS;
$modversion['help']        				= _MD_REFEREE_MODULE_HELP;
$modversion['license']     				= _MD_REFEREE_MODULE_LICENCE;
$modversion['official']    				= _MD_REFEREE_MODULE_OFFICAL;
$modversion['image']       				= _MD_REFEREE_MODULE_ICON;
$modversion['module_status'] 			= _MD_REFEREE_MODULE_STATUS;
$modversion['website'] 					= _MD_REFEREE_MODULE_WEBSITE;
$modversion['dirmoduleadmin'] 			= _MD_REFEREE_MODULE_ADMINMODDIR;
$modversion['icons16'] 					= _MD_REFEREE_MODULE_ADMINICON16;
$modversion['icons32'] 					= _MD_REFEREE_MODULE_ADMINICON32;
$modversion['release_info'] 			= _MD_REFEREE_MODULE_RELEASEINFO;
$modversion['release_file'] 			= _MD_REFEREE_MODULE_RELEASEFILE;
$modversion['release_date'] 			= _MD_REFEREE_MODULE_RELEASEDATE;
$modversion['author_realname'] 			= _MD_REFEREE_MODULE_AUTHORREALNAME;
$modversion['author_website_url'] 		= _MD_REFEREE_MODULE_AUTHORWEBSITE;
$modversion['author_website_name'] 		= _MD_REFEREE_MODULE_AUTHORSITENAME;
$modversion['author_email'] 			= _MD_REFEREE_MODULE_AUTHOREMAIL;
$modversion['author_word'] 				= _MD_REFEREE_MODULE_AUTHORWORD;
$modversion['status_version'] 			= _MD_REFEREE_MODULE_VERSION;
$modversion['warning'] 					= _MD_REFEREE_MODULE_WARNINGS;
$modversion['demo_site_url'] 			= _MD_REFEREE_MODULE_DEMO_SITEURL;
$modversion['demo_site_name'] 			= _MD_REFEREE_MODULE_DEMO_SITENAME;
$modversion['support_site_url'] 		= _MD_REFEREE_MODULE_SUPPORT_SITEURL;
$modversion['support_site_name'] 		= _MD_REFEREE_MODULE_SUPPORT_SITENAME;
$modversion['submit_feature'] 			= _MD_REFEREE_MODULE_SUPPORT_FEATUREREQUEST;
$modversion['submit_bug'] 				= _MD_REFEREE_MODULE_SUPPORT_BUGREPORTING;
$modversion['people']['developers'] 	= explode("|", _MD_REFEREE_MODULE_DEVELOPERS);
$modversion['people']['testers']		= explode("|", _MD_REFEREE_MODULE_TESTERS);
$modversion['people']['translaters']	= explode("|", _MD_REFEREE_MODULE_TRANSLATERS);
$modversion['people']['documenters']	= explode("|", _MD_REFEREE_MODULE_DOCUMENTERS);

// Requirements
$modversion['min_php']        			= '7.0';
$modversion['min_xoops']      			= '2.5.8';
$modversion['min_db']         			= array('mysql' => '5.0.7', 'mysqli' => '5.0.7');
$modversion['min_admin']      			= '1.1';

// Database SQL File and Tables
$modversion['sqlfile']['mysql'] 		= "sql/mysql.sql";
$modversion['tables']	 				= explode("\n", file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'tables.diz'));

//Search
$modversion['hasSearch'] 				= _MD_REFEREE_MODULE_HASSEARCH;
//$modversion['search']['file'] 		= "include/search.inc.php";
//$modversion['search']['func'] 		= "publisher_search";

// Main
$modversion['hasMain'] 					= _MD_REFEREE_MODULE_HASMAIN;

// Admin
$modversion['hasAdmin'] 				= _MD_REFEREE_MODULE_HASADMIN;
$modversion['adminindex']  				= "admin/index.php";
$modversion['adminmenu']   				= "admin/menu.php";
$modversion['system_menu'] 				= 1;

// Comments
$modversion['hasComments'] 				= _MD_REFEREE_MODULE_HASCOMMENTS;
//$modversion['comments']['itemName'] = 'itemid';
//$modversion['comments']['pageName'] = 'item.php';
//$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
//$modversion['comments']['callback']['approve'] = 'publisher_com_approve';
//$modversion['comments']['callback']['update']  = 'publisher_com_update';

// Add extra menu items
//$modversion['sub'][3]['name'] = _MD_REFEREE_SUB_ARCHIVE;
//$modversion['sub'][3]['url']  = "archive.php";


// Create Block Constant Defines
$i = 0;
++$i;
//$modversion['blocks'][$i]['file']        = "items_new.php";
//$modversion['blocks'][$i]['name']        = _MD_REFEREE_ITEMSNEW;
//$modversion['blocks'][$i]['description'] = _MD_REFEREE_ITEMSNEW_DSC;
//$modversion['blocks'][$i]['show_func']   = "publisher_items_new_show";
//$modversion['blocks'][$i]['edit_func']   = "publisher_items_new_edit";
//$modversion['blocks'][$i]['options']     = "0|datesub|0|5|65|none";
//$modversion['blocks'][$i]['template']    = "publisher_items_new.tpl";


// Config categories
$modversion['configcat']['seo']['name']        = _MD_REFEREE_CONFCAT_SEO;
$modversion['configcat']['seo']['description'] = _MD_REFEREE_CONFCAT_SEO_DESC;

$modversion['configcat']['mod']['name']        = _MD_REFEREE_CONFCAT_MODULE;
$modversion['configcat']['mod']['description'] = _MD_REFEREE_CONFCAT_MODULE_DESC;

// Config categories
$i=0;

++$i;
$modversion['config'][$i]['name']        = 'htaccess';
$modversion['config'][$i]['title']       = '_MD_REFEREE_HTACCESS';
$modversion['config'][$i]['description'] = '_MD_REFEREE_HTACCESS_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = false;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'seo';
++$i;
$modversion['config'][$i]['name']        = 'base';
$modversion['config'][$i]['title']       = '_MD_REFEREE_BASE';
$modversion['config'][$i]['description'] = '_MD_REFEREE_BASE_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'referee';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'seo';
++$i;
$modversion['config'][$i]['name']        = 'html';
$modversion['config'][$i]['title']       = '_MD_REFEREE_HTML';
$modversion['config'][$i]['description'] = '_MD_REFEREE_HTML_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'html';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'seo';
++$i;
$modversion['config'][$i]['name']        = 'redirect';
$modversion['config'][$i]['title']       = '_MD_REFEREE_REDIRECT';
$modversion['config'][$i]['description'] = '_MD_REFEREE_REDIRECT_DESC';
$modversion['config'][$i]['formtype']    = 'text';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'goto';
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'seo';

$modversion['hasNotification']             = false;
//$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
//$modversion['notification']['lookup_func'] = 'publisher_notify_iteminfo';

//$modversion['notification']['category'][1]['name']           = 'global_item';
//$modversion['notification']['category'][1]['title']          = _MD_REFEREE_GLOBAL_ITEM_NOTIFY;
//$modversion['notification']['category'][1]['description']    = _MD_REFEREE_GLOBAL_ITEM_NOTIFY_DSC;
//$modversion['notification']['category'][1]['subscribe_from'] = array('index.php', 'category.php', 'item.php');

//$modversion['notification']['event'][1]['name']          = 'category_created';
//$modversion['notification']['event'][1]['category']      = 'global_item';
//$modversion['notification']['event'][1]['title']         = _MD_REFEREE_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY;
//$modversion['notification']['event'][1]['caption']       = _MD_REFEREE_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY_CAP;
//$modversion['notification']['event'][1]['description']   = _MD_REFEREE_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY_DSC;
//$modversion['notification']['event'][1]['mail_template'] = 'global_item_category_created';
//$modversion['notification']['event'][1]['mail_subject']  = _MD_REFEREE_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY_SBJ;

?>
