
<article>	
	<div id="info">
		{$site->site_info.site_contact}
		
		<form action="./contact" method="post" id="contactForm">
			{if $smarty.post}
				<div class="okMsg">Votre message a été envoyé.</div>			
			{else}
			<label>Nom/Prénom</label><input type="text" name="Nom" class="required inbox" value="{if $currentUser}{$currentUser->usr_nom}{else}{$smarty.post.Nom}{/if}"/>
			<label>Société</label><input type="text" name="Societe" class="inbox" value="{if $currentUser}{$currentUser->usr_prenom}{else}{$smarty.post.Societe}{/if}"/>
			<label>Email</label><input type="text" name="Email" class="inbox email" value="{if $currentUser}{$currentUser->usr_login}{else}{$smarty.post.Email}{/if}"/>
			<label>Téléphone</label><input type="text" name="Telephone" class="inbox" value="{if $currentUser}{$currentUser->usr_tel}{else}{$smarty.post.Telephone}{/if}"/>
			<label>Message</label>
			<textarea name="Message" rows="5" class="required inbox textbox"/>{$smarty.post.Message}</textarea>
			<br/>
			<input type="submit" value="Envoyer" class="submit"/>
			<div class="nofloat">&nbsp;</div>
			{/if}		
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



{literal}
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#contactForm").validate();
})
</script>
{/literal}		