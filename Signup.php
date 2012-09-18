<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @version $Id$
 *
 * @category Piwik_Plugins
 * @package Piwik_Signup
 */

class Piwik_Signup extends Piwik_Plugin
{
	public static $enableCaptcha = null;

	public function getInformation()
	{
		$info = array(
			'name' => 'Signup',
			'description' => 'Allows users to signup for a piwik account',
			'author' => 'Stephan Miller',
			'author_homepage' => 'http://www.stephanmiller.com/',
			'version' => '0.2',
			'translationAvailable' => true,
		);
		
		return $info;
	}


	public function __construct()
	{
		self::$enableCaptcha = Zend_Registry::get('config')->Signup->enable_captcha;
	}
	
}
