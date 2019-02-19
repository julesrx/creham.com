{include file="contenu/tpl/page_menu.tpl"}

<div id="liste">

	{if $curPg}
		<h2 class="titre">{$curPg->cat_lib}</h2>
		<h3 class="intro" id="intro">{$curPg->pg_titre}</h3>
					
		<div class="text " {* truncate="1" expand="1" truncid="1" id="toTruncate" *} style="">
			{if $curPg->pg_photo}
				<div class="illus">
					<img src="./upload/images/p_{$curPg->pg_photo}" alt="{$curPg->pg_titre}" class="rond"/><br/>
					{if $curPg->pg_info.pg_legende}{$curPg->pg_info.pg_legende}{/if}
				</div>
			{/if}
			{if $curPg->pg_chapo}<div class="intro" id="intro">{$curPg->pg_chapo}</div>{/if}
			{$curPg->pg_contenu}
			{if $lRes}
				<strong>A voir :</strong><br/> 
				{foreach from=$lRes item=cRes}
					<a href="{$CFG->docurl}{$cRes->res_contenu}" target="_blank">{$cRes->res_titre}</a><br/> 			
				{/foreach}			
				<br/>
			{/if}
		</div>
		{include file="contenu/tpl/tools.tpl"}
		<div id="autre">Autres conseils dans cette catégorie</div>
	{/if}
	
	{assign var="prec" value=""}
	{foreach from=$lPg item=cPg}
		{if $prec != $cPg->cat_id && !$curPg}
			<h2 class="titre">{$cPg->cat_lib}</h2>
		{/if}
		{if $curPg->pg_id != $cPg->pg_id}
			<ul class="liste">			
				<li>
					<a href="{MakeLienHTML lib=$cPg->pg_titre type='cp' id=$cPg->pg_id}" title="{$cPg->pg_titre}">{$cPg->pg_titre}</a>
					<a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}#comments" class="comment"><span class="comment"><span class="puceFleche">&nbsp;</span> {$cPg->pg_nb_com+0} commentaire{if $cPg->pg_nb_com > 1}s{/if}</a></span>
				</li>
			</ul>
		{/if}
		{assign var="prec" value=$cPg->cat_id}
	{/foreach}
	
</div>

<div class="noleft"></div>

<button class="more more{$curRub->rub_id} ptSans" onclick="{if $currentUser->usr_id > 0}location.href='./publier-{$curRub->rub_id}'{else}openModalPopup('./connexion', '', 280, 380){/if}">
	<span class="pucePartage">&nbsp;</span> Pour partager un conseil, c'est ici
</button>

{literal}
<script>
	$().ready(function() {
		
		
		// on définit la hauteur du bloc text pour que hauteur Titre + intro + text < 380px
		var hTitre = $("#titre").height();
		var hIntro = $("#intro").height();
		var hTexte = $("#toTruncate").height();
		var hListe = $("#Liste").height();
		var hToTruncate = 340-hTitre;
		if (hToTruncate > 0){
			// est-ce bien nécessaire
			if (hTitre + hTexte > 336)	$("#toTruncate").height(hToTruncate);
		} else $("#toTruncate").height('100');
	});
</script>
{/literal} 