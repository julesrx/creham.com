<?php /* Smarty version 2.6.18, created on 2013-12-30 18:12:10
         compiled from commun/tpl/adm_ok_msg.tpl */ ?>
<?php if ($this->_tpl_vars['msg']): ?>
<div id="okMsg"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<?php echo '
	<script>
		$(\'#okMsg\').fadeOut(5000);
	</script>
'; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['errMsg']): ?>
<div id="errMsg"><?php echo $this->_tpl_vars['errMsg']; ?>
</div>
<?php echo '
	<script>
		$(\'#errMsg\').fadeOut(5000);
	</script>
'; ?>

<?php endif; ?>
		
		
		