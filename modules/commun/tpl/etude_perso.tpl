<div id="edito" class="rond">		
	{if !$smarty.post || $errMsg}
	<form action="/contact" method="post" id="myForm" style="float: left; width: 100%">
		<h1>Etude personnalisée</h1>
		<br/><br/>
		<label>Je souhaite</label>
		<div class="nofloat">&nbsp;</div>
		<input type="checkbox" name="Documentation" value="Oui"/><strong>Recevoir une documentation</strong>
		
		<input type="checkbox" name="Rendez-vous" value="Oui"/><strong>Convenir d'un rendez-vous</strong>
		
		<input type="checkbox" name="Rappel" value="Oui"/><strong>Etre rappelé(e) pour d'autres précisions</strong>
		<div class="nofloat">&nbsp;</div>
		<div>&nbsp;</div>
		<p>Afin d'obtenir une première approche personnelle , il vous suffit de remplir le formulaire ci-dessous.</p>
		<div style="float: left; width: 50%">
			<label>Civilité*:</label><select name="Civilite" class="required text"><option value="">choisir ...</option><option value="Mme">Mme</option><option value="M.">M.</option></select>
			<div class="nofloat">&nbsp;</div>
			<label>Situation familiale*:</label><select name="Situation" class="required text"><option value="">choisir ...</option><option value="Marié(e)">Marié(e)</option><option value="Célibataire">Célibataire</option></select>
			<div class="nofloat">&nbsp;</div>
			<label>Nom*:</label><input type="text" name="Nom" class="required text" value="{$smarty.post.Nom}"/>
			<div class="nofloat">&nbsp;</div>
			<label>Prénom*:</label><input type="text" name="Prenom" class="required text" value="{$smarty.post.Prenom}"/>
			<div class="nofloat">&nbsp;</div>
			<label>{$trad.adresse.$curLang}:</label><input type="text" name="Adresse" class="text" value="{$smarty.post.Adresse}"/>
			<div class="nofloat">&nbsp;</div>
			<label>{$trad.cp.$curLang}:</label><input type="text" name="CP" class="text" value="{$smarty.post.CP}"/>
			<div class="nofloat">&nbsp;</div>
			<label>{$trad.ville.$curLang}:</label><input type="text" name="Ville" class="text" value="{$smarty.post.Ville}"/>
			<div class="nofloat">&nbsp;</div>
			<label>{$trad.tel.$curLang}*:</label><input type="text" name="Telephone" class="required text" value="{$smarty.post.Telephone}"/>
			<div class="nofloat">&nbsp;</div>
			<label>Email*:</label><input type="text" name="Email" class="required email text" value="{$smarty.post.Email}"/>
			<div class="nofloat">&nbsp;</div>
		</div>
		<div style="float: left; width: 50%">	
			<label>Type de bien:</label><select name="Type_bien" class="text"><option value="">choisir ...</option>
						<option value="studio-T2">studio-T2</option>
						<option value="T2-T3">T2-T3</option>
						<option value="T3-T4">T3-T4</option>
						<option value="T4 et +">T4 et +</option>
						</select>
			<div class="nofloat">&nbsp;</div>		
			<label>Revenus net imposable:</label><input type="text" name="Revenu_net" class="text" value="{$smarty.post.Revenu_net}"/>
			<div class="nofloat">&nbsp;</div>
			<label>Impôts payés:</label><input type="text" name="Impots_payes" class="text" value="{$smarty.post.Impots_payes}"/>
			<div class="nofloat">&nbsp;</div>
			<label>Nombre de parts fiscales:</label><input type="text" name="Nb_parts" class="text" value="{$smarty.post.Nb_parts}"/>
			<div class="nofloat">&nbsp;</div>
			<label>Budget envisagé:</label><select name="Budget" class="text"><option value="">choisir ...</option>
						<option value="100-150K&euro;">100-150K&euro;</option>
						<option value="150-200K&euro;">150-200K&euro;</option>
						<option value="200-250K&euro;">200-250K&euro;</option>
						<option value="250-300K&euro;">250-300K&euro;</option>
						<option value="300-350K&euro;">300-350K&euro;</option>
						<option value="350-400K&euro;">350-400K&euro;</option>
						<option value="400-450K&euro;">400-450K&euro;</option>
						<option value="450-500K&euro;">450-500K&euro;</option>
						<option value="500-550K&euro;">500-550K&euro;</option>
						<option value="550-600K&euro;">550-600K&euro;</option>
					</select>
			<div class="nofloat">&nbsp;</div>
			<label>Apport possible:</label><input type="text" name="Apport" class="text" value="{$smarty.post.Apport}"/>
			<div class="nofloat">&nbsp;</div>
			<label>Epargne mensuelle possible:</label><input type="text" name="Epargne_mensuelle" class="text" value="{$smarty.post.Epargne_mensuelle}"/>
			<div class="nofloat">&nbsp;</div>
			
			<div class="nofloat">&nbsp;</div>
			<div style="float:right; margin-right: 24px;">
				{php}
					dsp_crypt(0,0);
				{/php}
			</div>
			<label>{$trad.code.$curLang} :</label><input type="text" value="" name="code" id="code" class="">
			<div class="nofloat">&nbsp;</div>
			{if $errMsg}<div><font color="red">{$errMsg}</font>&nbsp;</div>{/if}
			
			<label>{$trad.message.$curLang}:</label><textarea name="Message" rows="5" class="text"/>{$smarty.post.Message}</textarea>
			<div class="nofloat">&nbsp;</div>
			<label>&nbsp;</label><input type="submit" value="{$trad.envoyer.$curLang}" class="submit"/>
			<div class="nofloat">&nbsp;</div>
		</div>
		<div class="nofloat">&nbsp;</div>
	</form>
	{else}
		<p style="float: left; width: 45%">{$trad.sentOK.$curLang}</p>
	{/if}	
	<div class="nofloat"></div>
</div>


{literal}
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#myForm").validate();
})
</script>
{/literal}		