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

include_once "lib/securimage/securimage.php";

class Piwik_Signup_RegisterForm extends Piwik_QuickForm2
{
	function __construct( $id = 'registerform', $method = 'post', $attributes = null, $trackSubmit = false)
	{
		parent::__construct($id,  $method, $attributes, $trackSubmit);
	}

	function init()
	{
		$login = $this->addElement('text', 'form_login');
		$login->addRule('required', Piwik_Translate('General_Required', Piwik_Translate('General_Username')));

		$password = $this->addElement('password', 'form_password');
		$password->addRule('required', Piwik_Translate('General_Required', Piwik_Translate('Installation_Password')));

		$passwordBis = $this->addElement('password', 'form_password_bis');
		$passwordBis->addRule('required', Piwik_Translate('General_Required', Piwik_Translate('Installation_PasswordRepeat')));
		$passwordBis->addRule('eq', Piwik_Translate( 'Installation_PasswordDoNotMatch'), $password);
		
		$email = $this->addElement('text', 'form_email');
		$email->addRule('required', Piwik_Translate('General_Required', Piwik_Translate('Installation_Email')));
		$email->addRule('callback',Piwik_Translate( 'UsersManager_ExceptionInvalidEmail'), array($this, 'isValidEmail'));

		$websiteUrl = $this->addElement('text', 'form_website_url');
		$websiteUrl->addRule('required', Piwik_Translate('General_Required',  Piwik_Translate('Installation_SetupWebSiteURL')));
		$websiteUrl->addRule('callback', Piwik_Translate( 'Signup_InvalidWebsiteURL'),array($this, 'isValidUrl'));

		$websiteName =$this->addElement('text', 'form_website_name');
		$websiteName->addRule('required', Piwik_Translate('General_Required', Piwik_Translate('Installation_SetupWebSiteName')));

		if(  Zend_Registry::get('config')->Signup->enable_captcha == 1 )
		{
			$captcha = $this->addElement('text', 'form_captcha');
			$captcha->addRule('required', Piwik_Translate('General_Required',  Piwik_Translate('Signup_Captcha')));
			$captcha->addRule('callback', Piwik_Translate('Signup_InvalidCaptcha'), array($this, 'isValidCaptcha'));
		}
		
		$this->addElement('hidden', 'form_nonce');
		$this->addElement('submit', 'submit');
	}

	function isValidUrl( $value )
	{
		return preg_match('/^https?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)+/i', $value);
	}

	function isValidCaptcha( $value )
	{
		$img = new securimage();
		return $img->check($value);
	}

	function isValidEmail( $value )
	{
		return Piwik::isValidEmailString( $value );
	}
}
