<?php /* Smarty version 2.6.18, created on 2013-10-24 18:16:15
         compiled from newsletter/tpl/mail.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title><?php echo $this->_tpl_vars['nl']->nl_sujet; ?>
</title>
<?php echo '
<style type="text/css">
	body {width: 700px; margin-left: auto; margin-right: auto; background-color: #F0F0F0; color: #424244; font-family: Helvetica; font-size: 12px; font-weight: normal; }
</style>
'; ?>

</head>
<body style="background-color: #F0F0F0;">

<div>&nbsp;</div>
<div><?php echo $this->_tpl_vars['nl']->nl_corps; ?>
</div>
<div>&nbsp;</div>

<img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
index.php?ob=n&act=suivi&code=<?php echo $this->_tpl_vars['code']; ?>
&pop=G"/>

</body>
</html>