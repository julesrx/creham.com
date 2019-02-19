<?php /* Smarty version 2.6.18, created on 2014-01-15 12:44:08
         compiled from commun/tpl/mail.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php echo '
<style type="text/css">
	body {width: 700px; margin-left: auto; margin-right: auto; background-color: #ffffff; color: #424244; font-family: Helvetica; font-size: 12px; font-weight: normal; }
</style>
'; ?>

</head>
<body>
<?php echo $this->_tpl_vars['content']; ?>


<?php if ($this->_tpl_vars['code']): ?><img src="<?php echo $this->_tpl_vars['site']->site_url; ?>
/?ob=n&act=suivi&code=<?php echo $this->_tpl_vars['code']; ?>
&pop=G"/><?php endif; ?>

</body>
</html>