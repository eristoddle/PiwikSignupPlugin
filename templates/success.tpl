{include file="Login/templates/header.tpl"}

<div id="login">

{if isset($ErrorString)}
	<div id="login_error"><strong>{'General_Error'|translate}</strong>: {$ErrorString}<br />
	{'Login_ContactAdmin'|translate}
	</div>
{else}
	<p class="message">
		{'Signup_CompleteMessage'|translate}
	</p>
{/if}

<form method="POST" action="{$piwikUrl}index.php?module=CoreHome&action=index">
	<p>
		<textarea rows="20" cols="30">{$javascriptTag}</textarea>
	</p>
	<p class="submit">
		<input type="submit" value="{'Signup_ProceedDashboard'|translate} »" tabindex="100" />
	</p>
</form>

<p id="nav">
</p>

</div>

</body>
</html>
