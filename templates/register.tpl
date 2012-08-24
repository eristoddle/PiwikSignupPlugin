{include file="Login/templates/header.tpl"}

{literal}
<style type="text/css">
#form_password_bis,#form_website_url,#form_website_name,#form_email,#form_captcha {
	font-size: 20px;
	width: 97%;
	padding: 3px;
	margin-right: 6px;
}
</style>
{/literal}

<div id="login">

{if $form_data.errors}
<div id="login_error">	
	{foreach from=$form_data.errors item=data}
		<strong>{'General_Error'|translate}</strong>: {$data}<br />
	{/foreach}
</div>
{/if}

{if $AccessErrorString}
<div id="login_error"><strong>{'General_Error'|translate}</strong>: {$AccessErrorString}<br /></div>
{/if}

<p class="message">
	{'Signup_Intro'|translate}
</p>

<form {$form_data.attributes}>
	<p>
		<label>{'General_Username'|translate}:<br />
		<input type="text" name="form_login" id="form_login" class="input" value="{$form_data.form_login.value}" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>{'Installation_Password'|translate}:<br />
		<input type="password" name="form_password" id="form_password" class="input" value="{$form_data.form_password.value}" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>{'Installation_PasswordRepeat'|translate}:<br />
		<input type="password" name="form_password_bis" id="form_password_bis" class="input" value="{$form_data.form_password_bis.value}" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>{'Installation_Email'|translate}:<br />
		<input type="text" name="form_email" id="form_email" class="input" value="{$form_data.form_email.value}" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>{'Installation_SetupWebSiteName'|translate}:<br />
		<input type="text" name="form_website_name" id="form_website_name" class="input" value="{$form_data.form_website_name.value}" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>{'Installation_SetupWebSiteURL'|translate}:<br />
		<input type="text" name="form_website_url" id="form_website_url" class="input" value="{$form_data.form_website_url.value}" size="20" tabindex="10" /></label>
	</p>
	{if $enableCaptcha eq 1}
	<p>
		<label></br >
		<div style="float:left;">
			<img id="captcha" src="{$piwikUrl}index.php?module=Signup&action=showCaptcha&sid={$rand}" border="0" />
		</div>
		<div>
			<a href="#" onclick="document.getElementById('captcha').src = '{$piwikUrl}index.php?module=Signup&action=showCaptcha&sid=' + Math.random(); return false">
				<img src="{$piwikUrl}/plugins/Signup/lib/securimage/images/refresh.gif" border="0" />
			</a>
		</div>
		</label>
	</p>
	<p>
		<label>{'Signup_Captcha'|translate}:</br >
		<input type="text" name="form_captcha" id="form_captcha" class="input" value="" size="20" tabindex="10" /></label>
		</label>
	</p>
	{/if}
	<p class="submit">
		<input type="submit" value="{'Signup_Signup'|translate}" tabindex="100" />
	</p>
</form>

<p id="nav">
</p>

</div>

</body>
</html>
