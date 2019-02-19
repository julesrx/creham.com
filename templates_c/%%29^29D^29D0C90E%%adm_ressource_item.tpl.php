<?php /* Smarty version 2.6.18, created on 2013-10-11 15:22:53
         compiled from contenu/tpl/adm_ressource_item.tpl */ ?>
<div class="item" data-id="<?php echo $this->_tpl_vars['cR']->res_id; ?>
">
	<div class="lib">
		<input type="text" name="res_titre" id="res_titre" value="<?php echo $this->_tpl_vars['cR']->res_titre; ?>
" class="formInput ok"/>
	</div>
	<div class="elt">
		<?php if (in_array ( $this->_tpl_vars['cR']->res_mime , array ( 'jpg' , 'gif' , 'png' ) )): ?><img src="<?php echo $this->_tpl_vars['CFG']->docurl; ?>
<?php echo $this->_tpl_vars['cR']->res_contenu; ?>
" width="50" />
		<?php else: ?><a href="<?php echo $this->_tpl_vars['CFG']->docurl; ?>
<?php echo $this->_tpl_vars['cR']->res_contenu; ?>
" target="_blank">Voir</a>
		<?php endif; ?>
	</div>
	<div class="action">
		<img src="./images/fermer.png" title="supprimer" class="del"/>
	</div>
	<div class="nofloat"></div>
</div>

