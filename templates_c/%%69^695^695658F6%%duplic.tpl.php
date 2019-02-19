<?php /* Smarty version 2.6.18, created on 2014-02-19 09:52:38
         compiled from contenu/tpl/duplic.tpl */ ?>
<form action="gestion.php?ob=page&act=duplic" method="post">
	<input type="hidden" name="pg_id" value="<?php echo $_GET['pg_id']; ?>
"/>
	<div>Sélectionner les sites vers lesquels dupliquer la page en cours :</div>
	<div>&nbsp;</div>
	<?php $_from = $this->_tpl_vars['site_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['site_id'] => $this->_tpl_vars['site_lib']):
?>
		<?php if ($this->_tpl_vars['site_id'] > 0 && $this->_tpl_vars['site_id'] != $this->_tpl_vars['curSid']): ?>
			<div>
				<input type="checkbox" value="<?php echo $this->_tpl_vars['site_id']; ?>
" name="site_id[]" /> <strong><?php echo $this->_tpl_vars['site_lib']; ?>
</strong>
			</div>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<input type="submit" value="Dupliquer" class="btnSave" />
</form>