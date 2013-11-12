#Piwik Signup Plugin

##Added README to make plugin easy to use for Piwik newbies
I was writing a [book on Piwik](http://www.packtpub.com/piwik-web-analytics-essentials/book) and was featuring this plugin in a chapter and ran into all sorts of issues. But finally realized all the answers are in the [plugin's thread](http://dev.piwik.org/trac/ticket/1148). They are just not consolidated.

So I merged all the changes mentioned into this plugin zip file and added this README instead of a patch file so that user's can manually change their Piwik files to get this plugin to work. A lot of people, even PHP developers, don't know what a patch file is, let alone how to use it.

[Stephan Miller](http://www.stephanmiller.com)

##Installation and Setup
1. Unzip the plugin file.

2. Rename the extracted folder "Signup"

3. Upload the Signup folder to your to the plugins folder of your Piwik installation.

4. Open up your config.ini.php file in the config folder of your Piwik installation and add the following lines to the bottom of the file (without the backticks):
`[Signup] 
enable_captcha = 0`

5. Using your admin account, login to your Piwik installation and visit plugins (installed) in the sidebar on the settings page.

6. Look for the plugin titled "Signup" click the "activate" link it (if it is inactive, otherwise you're done).

For a more visual, yet outdated way to follow steps 2 and 3, please see [http://dev.piwik.org/trac/attachment/ticket/1148/signup.patch](http://dev.piwik.org/trac/attachment/ticket/1148/signup.patch)
