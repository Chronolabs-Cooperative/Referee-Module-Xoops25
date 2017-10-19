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

	if (!defined(_MD_REFEREE_MODULE_DIRNAME))
		define('_MD_REFEREE_MODULE_DIRNAME', basename(__DIR__));
		
	include_once (dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'mainfile.php');

	ini_set('display_errors', true);
	error_reporting(E_ALL);
	
	set_time_limit(8444);
	
	xoops_loadLanguage('modinfo', _MD_REFEREE_MODULE_DIRNAME);
	xoops_loadLanguage('errors', _MD_REFEREE_MODULE_DIRNAME);
	
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

	include_once (__DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'functions.php');

?>