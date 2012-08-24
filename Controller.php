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

class Piwik_Signup_Controller extends Piwik_Controller
{
	function index()
	{
		$this->register();
	}
	
	function register()
	{
		$messageNoAccess = null;

		$form = new Piwik_Signup_RegisterForm();

		if($form->validate())
		{
			try {
				$this->registerFormValidated(
					$form->getSubmitValue('form_login'),
					$form->getSubmitValue('form_password'),
					$form->getSubmitValue('form_email'),
					$form->getSubmitValue('form_website_url'),
					$form->getSubmitValue('form_website_name')
				);
			}
			catch(Exception $e)
			{
				$messageNoAccess = $e->getMessage();
			}
		}

		$view = Piwik_View::factory('register');
		$view->AccessErrorString = $messageNoAccess;
		
		$view->linkTitle = Piwik::getRandomTitle();
		$view->addForm( $form );
		$view->subTemplate = 'genericForm.tpl';
		$view->rand = rand();
		$view->enableCaptcha = Piwik_Signup::$enableCaptcha;
		
		$this->setBasicVariablesView($view);

		echo $view->render();
	}

	function showCaptcha()
	{
		$img = new securimage();
		$img->show();
	}

	function registerFormValidated($userLogin, $password, $email, $siteUrl, $siteName)
	{
		Piwik::createAccessObject();
		Piwik::setUserIsSuperUser();

		$usersManagerApi = Piwik_UsersManager_API::getInstance();
		$sitesManagerApi = Piwik_SitesManager_API::getInstance();

		$usersManagerApi->addUser($userLogin, $password, $email);

		try {
			Piwik::createAccessObject();
			Piwik::setUserIsSuperUser();

			$idSite = $sitesManagerApi->addSite($siteName, $siteUrl);
			
			$usersManagerApi->setUserAccess($userLogin, 'admin', $idSite);
		}
		catch( Exception $e )
		{
			// we need to delete user first
			$usersManagerApi->deleteUser($userLogin);
			
			throw $e;
		}

		$javascriptTag = $sitesManagerApi->getJavascriptTag($idSite);

		$view = Piwik_View::factory('success');
		$view->linkTitle = Piwik::getRandomTitle();

		// send email with login, password & javascript tag
		try
		{
			$mail = new Piwik_Mail();
			$mail->addTo($email, $userLogin);
			$mail->setSubject(Piwik_Translate('Signup_MailSubject'));

			$bodyText = str_replace(
					'\n',
					"\n",
					sprintf(Piwik_Translate('Signup_MailBody'), $userLogin, $userLogin, $password, $view->piwikUrl, $javascriptTag)
				) . "\n";

			$mail->setBodyText($bodyText);

			$piwikHost = $_SERVER['HTTP_HOST'];
			
			if(strlen($piwikHost) == 0)
			{
				$piwikHost = 'piwik.org';
			}

			$fromEmailName = Zend_Registry::get('config')->General->login_password_recovery_email_name;
			$fromEmailAddress = Zend_Registry::get('config')->General->login_password_recovery_email_address;
			$fromEmailAddress = str_replace('{DOMAIN}', $piwikHost, $fromEmailAddress);
			$mail->setFrom($fromEmailAddress, $fromEmailName);
			
			@$mail->send();
		}
		catch(Exception $e)
		{
			$view->ErrorString = $e->getMessage();
		}

		$view->javascriptTag = $javascriptTag;
		
		$this->setBasicVariablesView($view);

		echo $view->render();
		exit;
	}
}
