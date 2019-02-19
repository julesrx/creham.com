<div id="pop">
	<h1>Ajout ou modification d'une photo d'illusration</h1>
	<form action="gestion.php" method="post"  enctype="multipart/form-data" id="">
		<input type="hidden" name="ob" value="res"/>
		<input type="hidden" name="act" value="save"/>
		<input type="hidden" name="res_id" value="{$cRes->res_id}"/>
		<input type="hidden" name="elt_id" value="{$smarty.get.elt_id}"/>
		<input type="hidden" name="elt_type" value="{$smarty.get.elt_type}"/>
		<p><label>Légende :</label><input type="text" name="res_titre" value="{$cRes->res_titre}" class="text"/></p>
		<p><label>Ordre :</label><input type="text" name="res_ordre" value="{$cRes->res_ordre}" class="text"/></p>		
		<p><label>Photo :</label><input type="file" name="res_contenu" class="text"/></p>
		<input type="hidden" name="res_contenu_old" value="{$cRes->res_contenu}" class=""/>
		{if $cRes->res_contenu}<p><img src="./upload/vign_{$cRes->res_contenu}"/></p>{/if}
		<div align="right">
			<input type="button" value="Supprimer" style="width: 60px; margin-right: 5px; " onclick="checkConfirmUrl('gestion.php?ob=res&act=del&res_id={$cRes->res_id}', 'la suppression')">
			<input type="submit" value="Enregistrer"/>
		</div>
	</form>


</div>