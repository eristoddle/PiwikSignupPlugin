#Piwik Signup Plugin

##Added README to make plugin easy to use for Piwik newbies
I was writing a [book on Piwik](http://www.packtpub.com/piwik-web-analytics-essentials/book) and was featuring this plugin in a chapter and ran into all sorts of issues. But finally realized all the answers are in the [plugin's thread](http://dev.piwik.org/trac/ticket/1148). They are just not consolidated.

So I merged all the changes mentioned into this plugin zip file and added this README instead of a patch file so that user's can manually change their Piwik files to get this plugin to work. A lot of people, even PHP developers, don't know what a patch file is, let alone how to use it.

[Stephan Miller](http://www.stephanmiller.com)

##Plugin Instructions

1. Upload the Signup folder to your to the plugins folder of your Piwik installation.
2. Open up your config.ini.php file in the config folder of your Piwik installation and add the following lines to the bottom of the file (without the backticks):
`[Signup] 
enable_captcha = 0` 
3. Open up your en.php file in the lang folder of your Piwik installation and add the following lines right before ); on the last line of the file. (without the backticks):
`'Signup_InvalidWebsiteURL' => 'Invalid Website URL. Enter full URL with http:// prefix.', 
	'Signup_Captcha' => 'Enter text from image above', 
	'Signup_InvalidCaptcha' => 'Invalid text from image.', 
	'Signup_Signup' => 'Sign Up', 
	'Signup_Intro' => 'Please fill this form to sign up for an account.', 
	'Signup_ProceedDashboard' => 'Proceed to Dashboard', 
	'Signup_CompleteMessage' => 'Sign up Complete!<br /><br />Make sure your JavaScript code is entered in your pages, and wait for your first visitors.<br /><br />You will receive an email with confirmation shortly.', 
	'Signup_MailSubject' => 'Signup Complete', 
	'Signup_MailBody' => "Hi %1\$s!\n\nYou have successfully signed up for an account. \n\nYour Username:\t%2\$s\nYour Password:\t%3\$s\nLogin URL:\t%4\$s\n\nTo count all visitors, you must insert the JavaScript code available inside your Dashboard: Settings > Websites > View Tracking Code.\n\nSincerely,\nPiwik Open Source Analytics%5",`

For a more visual, yet outdated way to follow steps 2 and 3, please see [http://dev.piwik.org/trac/attachment/ticket/1148/signup.patch](http://dev.piwik.org/trac/attachment/ticket/1148/signup.patch)
##Installation