<?php /* Smarty version 2.6.18, created on 2013-10-11 10:13:42
         compiled from securite/tpl/perdu.tpl */ ?>
<div id="compte">
	<h1 class="titre" id="titre"><span class="pucej">&nbsp;</span> Mot de passe perdu ?</h1>
	
	<div id="pop" class="">		
		<?php if ($this->_tpl_vars['okMsg']): ?>
			<div class="okMsg"><?php echo $this->_tpl_vars['okMsg']; ?>
</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['errMsg']): ?>
			<div class="errMsg"><?php echo $this->_tpl_vars['errMsg']; ?>
</div>
		<?php endif; ?>
		<form action="./perdu" method="post" id="">
			<label>Courriel</label><input type="text" class="inbox" name="email" value="adresse mail" onfocus="this.value=''" />
			<input type="submit" value="ok" class="submit" />
			<div class="nofloat">&nbsp;</div>
			
		</form>
		
		<div class="nofloat"></div>
		<div class="separ"></div>
		<div class="soustitre ptSans"><span class="pucej">&nbsp;</span> <a href="./inscription" class="login">S'inscrire</a></div>
	
	</div>
</div>	