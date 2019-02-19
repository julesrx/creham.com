	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=profil&act=liste">>> Nouvel utilisateur</a>
		</div>

		<div class="listeElt">
		{foreach from=$lElt item=cElt}
			<a href="gestion.php?ob=profil&act=liste&usr_id={$cElt->usr_id}">
					<div class="{if $cUsr->usr_id == $cElt->usr_id}tblOn{else}tblOff{/if} statut{$cElt->usr_statut+0}">
						<b>{$cElt->usr_nom|upper} {$cElt->usr_prenom|myucfirst}</b> <small>({$cElt->usr_login})</small>
			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Pas d'utilisateur s&eacute;lectionn&eacute;</div>
		{/foreach}
		</div>
		<div class="tblEntete">{sizeof liste=$lElt} utilisateurs</div>
	</div>
	<div id="centre">
		<div id="action">
	{include file="commun/tpl/adm_ok_msg.tpl"}
</div>
		
<div id="viewProfil">
	<span class="tblEntete isCentre"><i><b>{if $cUsr->usr_id}Utilisateur : {$cUsr->usr_nom|upper} {$cUsr->usr_prenom|myucfirst}{else}Nouvel utilisateur{/if}</b></i></span>
	<form action="gestion.php?ob=profil&act=saveUser" method="POST" id="formProfil" enctype="multipart/form-data">
		<input type="hidden" value="{$cUsr->usr_id}" name="usr_id" id="usr_id">
		<input type="hidden" value="1" name="usr_statut" id="usr_statut">
		<div class="btnAction">
			<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=profil&act=delUser&usr_id={$cUsr->usr_id}', 'la suppression')">
			<input type="submit" value="Enregistrer" class="btnSave">
		</div>
		<div class="nofloat"></div>
		
		<div id="tabs">
			<div id="niv1">
				<label>Nom : </label><input type="text" class="formInput" value="{$cUsr->usr_nom|upper}" name="usr_nom" id="usr_nom">
				<div class="nofloat"></div>
				<label>Prénom : </label><input type="text" class="formInput" value="{$cUsr->usr_prenom|myucfirst}" name="usr_prenom" id="usr_prenom">
				<div class="nofloat"></div>	
				<label>Identifiant : </label><input type="text" class="formInput required" value="{$cUsr->usr_login}" name="usr_login" id="usr_login">
				<div class="nofloat"></div>
				<label>Mot de passe : </label><input type="password" class="formInput" value="{$cUsr->usr_pwd}" name="usr_pwd" id="usr_pwd">
				<input type="hidden" value="{$cUsr->usr_pwd}" name="usr_pwd_old" id="usr_pwd_old">
				<div class="nofloat"></div>
				<label>Groupe : </label><select name=grp_id class="formInput">
								<option></option>
							  {html_options options=$groupe_options selected=$cUsr->grp_id}
							</select>
				<div class="nofloat"></div>				
			</div>
			
		</div>
				
		<div class="nofloat"></div>
					
		<div class="btnAction">
			<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=profil&act=delUser&usr_id={$cUsr->usr_id}', 'la suppression')">
			<input type="submit" value="Enregistrer" class="btnSave">
		</div>

		<div class="nofloat"></div>
	</form>
</div>

	</div>
	

	