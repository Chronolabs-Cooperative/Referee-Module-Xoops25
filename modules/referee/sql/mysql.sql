## 
##  Referee URL Lister with Site Thumbnails Engines
## 
## You may not change or alter any portion of this comment or credits
## of supporting developers from this source code or any supporting source code
## which is considered copyrighted (c) material of the original comment or credit authors.
## This program is distributed in the hope that it will be useful,
## but WITHOUT ANY WARRANTY; without even the implied warranty of
## MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
## 
## @copyright   	The XOOPS Project http://fonts2web.org.uk
## @license     	General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
## @author      	Simon Roberts (wishcraft) <wishcraft@users.sourceforge.net>
## @subpackage  	referee
## @description 	Referee URL Lister with Site Thumbnails Engines
## @version		    1.0.1
## @link			http://internetfounder.wordpress.com
## 

CREATE TABLE `referee_cronjobs` (
  `id` mediumint(96) NOT NULL AUTO_INCREMENT,
  `mode` enum('hostnames','urls','others') NOT NULL DEFAULT 'others',
  `type` enum('meta','icon','thumbnail','removing-junk','') NOT NULL DEFAULT '',
  `ident` mediumint(32) NOT NULL DEFAULT '0',
  `execute` int(13) NOT NULL DEFAULT '0',
  `executed` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`mode`,`type`,`ident`,`execute`,`executed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_hostnames` (
  `id` mediumint(16) NOT NULL AUTO_INCREMENT,
  `thumb_image_id` mediumint(128) NOT NULL DEFAULT '0',
  `icon_image_id` mediumint(128) NOT NULL DEFAULT '0',
  `pagetitle` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `keyword_ids` mediumtext,
  `key` varchar(44) NOT NULL DEFAULT '',
  `hostname` varchar(255) NOT NULL DEFAULT '',
  `resolved` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(128) NOT NULL DEFAULT '',
  `port` int(6) NOT NULL DEFAULT '0',
  `http` enum('Yes','No') NOT NULL DEFAULT 'No',
  `https` enum('Yes','No') NOT NULL DEFAULT 'No',
  `hash` varchar(12) NOT NULL DEFAULT '',
  `clicks` int(24) NOT NULL DEFAULT '0',
  `urls` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `robots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `browsers` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `agents` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `created` int(24) NOT NULL DEFAULT '0',
  `last` int(24) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`hostname`,`resolved`,`ip`,`port`,`id`,`http`,`https`,`hash`,`created`,`last`,`key`) USING BTREE KEY_BLOCK_SIZE=16
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_hostnames_useragents` (
  `id` mediumint(128) NOT NULL,
  `hostname_id` mediumint(16) NOT NULL DEFAULT '0',
  `useragent_id` mediumint(16) NOT NULL DEFAULT '0',
  `type` enum('Robot','Unknown') NOT NULL DEFAULT 'Unknown',
  `when` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`hostname_id`,`useragent_id`,`type`,`when`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_images` (
  `id` mediumint(128) NOT NULL AUTO_INCREMENT,
  `type` enum('Thumbnail','Icon','Unknown') NOT NULL DEFAULT 'Unknown',
  `mime` enum('image/vnd.microsoft.icon', 'image/png', 'image/jpg', 'image/gif', 'Unknown') NOT NULL DEFAULT 'Unknown',
  `key` varchar(44) NOT NULL DEFAULT '',
  `hash` varchar(12) NOT NULL DEFAULT '',
  `hits` int(24) NOT NULL DEFAULT '0',
  `clicks` int(24) NOT NULL DEFAULT '0',
  `bytes` int(24) NOT NULL DEFAULT '0',
  `image` blob,
  `created` int(24) NOT NULL DEFAULT '0',
  `last` int(24) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_keywords` (
  `id` mediumint(160) NOT NULL AUTO_INCREMENT,
  `key` varchar(44) NOT NULL DEFAULT '',
  `keyword` varchar(128) NOT NULL DEFAULT '',
  `hash` varchar(12) NOT NULL DEFAULT '',
  `urls` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `browsers` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `robots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`key`,`keyword`,`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_keywords_hostnames` (
  `id` mediumint(192) NOT NULL AUTO_INCREMENT,
  `hostname_id` mediumint(16) NOT NULL DEFAULT '0',
  `keyword_id` mediumint(160) NOT NULL DEFAULT '0',
  `occurences` int(24) NOT NULL DEFAULT '0',
  `created` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_keywords_urls` (
  `id` mediumint(192) NOT NULL AUTO_INCREMENT,
  `url_id` mediumint(32) NOT NULL DEFAULT '0',
  `keyword_id` mediumint(160) NOT NULL DEFAULT '0',
  `occurences` int(24) NOT NULL DEFAULT '0',
  `created` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_referees` (
  `id` mediumint(64) NOT NULL AUTO_INCREMENT,
  `key` varchar(44) NOT NULL DEFAULT '',
  `hostname_id` mediumint(16) NOT NULL DEFAULT '0',
  `url_id` mediumint(32) NOT NULL DEFAULT '0',
  `referee_hostname_id` mediumint(16) NOT NULL DEFAULT '0',
  `referee_url_id` mediumint(32) NOT NULL DEFAULT '0',
  `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `robots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `browsers` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `agents` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hash` varchar(12) NOT NULL DEFAULT '',
  `clicks` int(24) NOT NULL DEFAULT '0',
  `created` int(24) NOT NULL DEFAULT '0',
  `last` int(24) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`key`,`hostname_id`,`referee_hostname_id`,`url_id`,`referee_url_id`,`hash`,`created`,`last`) USING BTREE KEY_BLOCK_SIZE=8
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_referees_useragents` (
  `id` mediumint(128) NOT NULL,
  `referee_id` mediumint(64) NOT NULL DEFAULT '0',
  `useragent_id` mediumint(16) NOT NULL DEFAULT '0',
  `type` enum('Robot','Unknown') NOT NULL DEFAULT 'Unknown',
  `when` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`referee_id`,`useragent_id`,`type`,`when`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_thumbnails_configs` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `engine_id` int(8) NOT NULL DEFAULT '0',
  `weight` int(4) NOT NULL DEFAULT '0',
  `define` varchar(128) NOT NULL DEFAULT '',
  `title` varchar(196) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `options` mediumtext,
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_thumbnails_engines` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `active` enum('Yes','No') NOT NULL DEFAULT 'No',
  `weight` int(4) NOT NULL DEFAULT '0',
  `configs` int(8) NOT NULL DEFAULT '0',
  `folder` varchar(64) NOT NULL DEFAULT '',
  `title` varchar(64) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(196) NOT NULL DEFAULT '',
  `perhour` int(6) NOT NULL DEFAULT '20',
  `usages` int(24) NOT NULL DEFAULT '0',
  `usage` int(13) NOT NULL DEFAULT '0',
  `installed` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_urls` (
  `id` mediumint(32) NOT NULL AUTO_INCREMENT,
  `thumb_image_id` mediumint(128) NOT NULL DEFAULT '0',
  `icon_image_id` mediumint(128) NOT NULL DEFAULT '0',
  `hostname_id` mediumint(16) NOT NULL DEFAULT '0',
  `uri` tinytext NOT NULL,
  `key` varchar(44) NOT NULL DEFAULT '',
  `pagetitle` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `keyword_ids` mediumtext,
  `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `bots` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hash` varchar(12) NOT NULL DEFAULT '',
  `clicks` int(24) NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL DEFAULT '',
  `created` int(13) NOT NULL DEFAULT '0',
  `lasthits` int(13) NOT NULL DEFAULT '0',
  `fetching` int(13) NOT NULL DEFAULT '0',
  `fetched` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`key`,`key_uri`,`id`,`created`,`lasthits`,`hash`,`bots`,`referees`,`hitswith`,`hitswithout`,`hitsasbot`) USING BTREE,
  KEY `TIMING` (`hash`,`created`,`lasthits`,`fetching`,`fetched`,`key_uri`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_urls_useragents` (
  `id` mediumint(128) NOT NULL,
  `url_id` mediumint(32) NOT NULL DEFAULT '0',
  `useragent_id` mediumint(16) NOT NULL DEFAULT '0',
  `type` enum('Robot','Unknown') NOT NULL DEFAULT 'Unknown',
  `when` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`url_id`,`useragent_id`,`type`,`when`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `referee_useragents` (
  `id` mediumint(16) NOT NULL AUTO_INCREMENT,
  `type` enum('Robot','Unknown') NOT NULL DEFAULT 'Unknown',
  `key` varchar(44) NOT NULL DEFAULT '',
  `useragent` varchar(255) NOT NULL DEFAULT '',
  `http` enum('Yes','No') NOT NULL DEFAULT 'No',
  `https` enum('Yes','No') NOT NULL DEFAULT 'No',
  `hash` varchar(12) NOT NULL DEFAULT '',
  `clicks` int(24) NOT NULL DEFAULT '0',
  `urls` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `referees` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hostnames` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswith` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitswithout` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `hitsasbot` int(24) unsigned zerofill NOT NULL DEFAULT '000000000000000000000000',
  `created` int(24) NOT NULL DEFAULT '0',
  `last` int(24) NOT NULL DEFAULT '0',
  `last_hostname_id` mediumint(16) NOT NULL DEFAULT '0',
  `last_url_id` mediumint(32) NOT NULL DEFAULT '0',
  `last_referee_id` mediumint(64) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `SEARCH` (`type`,`key`,`useragent`,`http`,`https`,`hash`,`urls`,`referees`,`hostnames`,`created`,`last`,`last_url_id`,`last_referee_id`,`last_hostname_id`) USING BTREE KEY_BLOCK_SIZE=13
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
