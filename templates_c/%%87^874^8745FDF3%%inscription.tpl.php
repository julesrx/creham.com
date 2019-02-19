<?php /* Smarty version 2.6.18, created on 2013-10-02 18:49:06
         compiled from newsletter/tpl/inscription.tpl */ ?>
<div id="news">
	<h1 class="titre" id="titre">Restez informé ...</h1>
	<?php if ($this->_tpl_vars['errMsg']): ?><div class="errMsg"><?php echo $this->_tpl_vars['errMsg']; ?>
</div>
	<?php elseif ($this->_tpl_vars['okMsg']): ?><div class="okMsg"><?php echo $this->_tpl_vars['okMsg']; ?>
</div>
	<?php endif; ?>
	
	<?php if (! $this->_tpl_vars['currentUser']): ?>
		<form action="./newsletter" method="post" id="formPub" style="padding-left: 30px; width: 70%; background : #fff url(../images/vsepar.png) top left no-repeat">
			<div class="intro">Inscrivez-vous à la newsletter</div>		
			<label>Courriel</label><input type="text" class="inbox required email" name="email" value="adresse mail" onfocus="this.value=''" />
			<div class="nofloat">&nbsp;</div>			
			<div align="right"><input type="submit" value="Valider" class="submit"/></div>
			<div class="nofloat">&nbsp;</div>
		</form>
		<br/><br/>
		<div class="intro">Pour contribuer au site, inscrivez-vous <a href="./inscription" title="S'inscrire">ici</a></div>
	<?php elseif (! $this->_tpl_vars['cUsr']->usr_inscrit_nl): ?>
		<form action="./newsletter" method="post" id="formPub" style="padding-left: 30px; width: 70%; background : #fff url(../images/vsepar.png) top left no-repeat">
			<div class="intro">Inscrivez-vous à la newsletter</div>
			<input type="hidden" name="inscrit" value="1"/>		
			<label>Courriel :</label><label><?php echo $this->_tpl_vars['cUsr']->usr_login; ?>
</label><label>&nbsp;</label><input type="submit" value="Valider" class="submit"/>
			<div class="nofloat">&nbsp;</div>
		</form>
		<br/><br/>
		<?php if (! $this->_tpl_vars['currentUser']): ?><div class="intro">Pour contribuer au site, inscrivez-vous <a href="./inscription" title="S'inscrire">ici</a></div><?php endif; ?>
	<?php else: ?>
		<form action="./newsletter" method="post" id="formPub" style="width: 70%">
			<div class="intro">Vous souhaitez vous désinscrire de notre newsletter.</div>
			<input type="hidden" name="desinscrit" value="1"/>			
			<div align="left"><input type="submit" value="Désinscrire" class="submit"/></div>
			<div class="nofloat">&nbsp;</div>
		</form>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['lNews']): ?>
		<br/><br/>
		<div class="intro">Consultez les newsletters</div>
		<div class="text">
			<ul >
			<?php $_from = $this->_tpl_vars['lNews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cN']):
?>
				<li><a href="./voir-<?php echo $this->_tpl_vars['cN']->nl_id; ?>
" target="_blank"><?php echo $this->_tpl_vars['cN']->nl_sujet; ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	<?php endif; ?>
</div>

<?php echo '
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#formPub").validate();
})
</script>
'; ?>

	