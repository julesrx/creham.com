<?php /* Smarty version 2.6.18, created on 2013-10-24 17:27:57
         compiled from securite/tpl/notif_user.tpl */ ?>


<div id="compte">
	<h1 class="titre" id="titre"><span class="pucej">&nbsp;</span> S'inscrire</h1>
	<?php if ($this->_tpl_vars['err']): ?>
		<p><?php echo $this->_tpl_vars['err']; ?>
</p>
	<?php else: ?>
		<p>Votre demande d'inscription est enregistrée.</p>
		<p>Vous recevrez dans quelques instants un courriel qui vous permettra de confirmer votre inscription.</p>
	<?php endif; ?>	
		
</div>

<div class="noleft"></div>
