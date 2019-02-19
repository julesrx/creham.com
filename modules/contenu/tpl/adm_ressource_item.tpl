<div class="item" data-id="{$cR->res_id}">
	<div class="lib">
		<input type="text" name="res_titre" id="res_titre" value="{$cR->res_titre}" class="formInput ok"/>
	</div>
	<div class="elt">
		{if in_array($cR->res_mime, array('jpg', 'gif', 'png'))}<img src="{$CFG->docurl}{$cR->res_contenu}" width="50" />
		{else}<a href="{$CFG->docurl}{$cR->res_contenu}" target="_blank">Voir</a>
		{/if}
	</div>
	<div class="action">
		<img src="./images/fermer.png" title="supprimer" class="del"/>
	</div>
	<div class="nofloat"></div>
</div>


