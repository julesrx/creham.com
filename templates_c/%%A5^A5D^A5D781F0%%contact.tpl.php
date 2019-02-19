<?php /* Smarty version 2.6.18, created on 2014-01-23 07:36:23
         compiled from commun/tpl/contact.tpl */ ?>

<article>	
	<div id="info">
		<?php echo $this->_tpl_vars['site']->site_info['site_contact']; ?>

		
		<form action="./contact" method="post" id="contactForm">
			<?php if ($_POST): ?>
				<div class="okMsg">Votre message a été envoyé.</div>			
			<?php else: ?>
			<label>Nom/Prénom</label><input type="text" name="Nom" class="required inbox" value="<?php if ($this->_tpl_vars['currentUser']): ?><?php echo $this->_tpl_vars['currentUser']->usr_nom; ?>
<?php else: ?><?php echo $_POST['Nom']; ?>
<?php endif; ?>"/>
			<label>Société</label><input type="text" name="Societe" class="inbox" value="<?php if ($this->_tpl_vars['currentUser']): ?><?php echo $this->_tpl_vars['currentUser']->usr_prenom; ?>
<?php else: ?><?php echo $_POST['Societe']; ?>
<?php endif; ?>"/>
			<label>Email</label><input type="text" name="Email" class="inbox email" value="<?php if ($this->_tpl_vars['currentUser']): ?><?php echo $this->_tpl_vars['currentUser']->usr_login; ?>
<?php else: ?><?php echo $_POST['Email']; ?>
<?php endif; ?>"/>
			<label>Téléphone</label><input type="text" name="Telephone" class="inbox" value="<?php if ($this->_tpl_vars['currentUser']): ?><?php echo $this->_tpl_vars['currentUser']->usr_tel; ?>
<?php else: ?><?php echo $_POST['Telephone']; ?>
<?php endif; ?>"/>
			<label>Message</label>
			<textarea name="Message" rows="5" class="required inbox textbox"/><?php echo $_POST['Message']; ?>
</textarea>
			<br/>
			<input type="submit" value="Envoyer" class="submit"/>
			<div class="nofloat">&nbsp;</div>
			<?php endif; ?>		
		</form>
			<div class="nofloat"></div>
		
		
	</div>
	<div id="tool">
		<a href="" title="version imprimable"><img src="./images/picto-print.png" alt=""/> Imprimer la page</a>
		<hr/>
		<p align="right"><img src="./images/virgule.png" alt="" id="virgule"/></p>
	</div>
	<div class="nofloat"></div>
</article>



<?php echo '
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#contactForm").validate();
})
</script>
'; ?>
		