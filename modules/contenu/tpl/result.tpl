
<div id="liste" style="width: 90% !important">
	{if $from == "publi"}
		<h1 class="titre" >Mes publications</h1>
		{if $errMsg}<div class="errMsg">{$errMsg}</div>
		{elseif $okMsg}<div class="okMsg">{$okMsg}</div>
		{/if}
	{else}<div class="texte" style="font-size: 1.3em;">Résultat de la recherche : "{$mot}"</div>
		<br/><br/><br/>
	{/if}
	
	{assign var="prec" value=""}
	{foreach from=$lPg item=cPg}
		{if $prec != $cPg->rub_id}
			<h2 class="titre" style="margin-top: 20px;"><img src="./upload/images/picto/{$cPg->rub_info.rub_picto}" style="vertical-align: middle; height: 20px"/>&nbsp;{$cPg->rub_lib}</h2>
		{/if}
		<ul class="liste">			
			<li>
				<a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}" title="{$cPg->pg_titre}">{$cPg->pg_titre}</a>
				{if $from == "publi"}<small>({if $cPg->pg_statut == 1}En ligne{else}En validation{/if})</small>{/if}
				<a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}#comments" class="comment"><span class="comment"><span class="puceFleche">&nbsp;</span> {$cPg->pg_nb_com+0} commentaire{if $cPg->pg_nb_com > 1}s{/if}</a></span>
				{if $from == "publi"}
					<button class="btnOk" onclick="location.href='./modifier-{$cPg->pg_id}'" title="Modifier cette publication">Modifier</button>
					<button class="btnDel" onclick="checkConfirmUrl('./supprimer-{$cPg->pg_id}', 'la suppression de cette publication')">Supprimer</button>
				{/if}
			</li>
		</ul>
		
		{assign var="prec" value=$cPg->rub_id}
	{/foreach}
	{if $lPro}
		<h2 class="titre">CARTOGRAPHIE</h2>
		{foreach from=$lPro item=cUser}		
		<ul>			
			<li>
				<a href="{MakeLienHTML lib=$cUser->usr_prenom|myucfirst|cat:'-'|cat:$cUser->usr_nom|upper type='carte' id=$cUser->usr_id}" title="{$cUser->usr_prenom|myucfirst} {$cUser->usr_nom|strtoupper}">{$cUser->usr_prenom|myucfirst} {$cUser->usr_nom|strtoupper}</a>				
			</li>
		</ul>		
	{/foreach}
	{/if}
</div>

<div class="noleft"></div>
