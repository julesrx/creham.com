<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>{$nl->nl_sujet}</title>
{literal}
<style type="text/css">
	body {width: 700px; margin-left: auto; margin-right: auto; background-color: #F0F0F0; color: #424244; font-family: Helvetica; font-size: 12px; font-weight: normal; }
</style>
{/literal}
</head>
<body style="background-color: #F0F0F0;">
{if $smarty.get.act != "view"}
	<center><a href="{$site->site_url}voir-{$nl->nl_id}">Cliquez ici si vous ne parvenez pas à lire cette newsletter</a></center>
{/if}
<div>&nbsp;</div>
<div>{$nl->nl_corps}</div>
<div>&nbsp;</div>

<img src="{$site->site_url}index.php?ob=n&act=suivi&code={$code}&pop=G"/>

</body>
</html>