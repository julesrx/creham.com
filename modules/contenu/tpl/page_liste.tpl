{include file="contenu/tpl/page_menu.tpl"}

<div id="liste">
	<h1 class="titre">
		{if $curRub->rub_id == 4}Tous les évènements
		{elseif $curRub->rub_id == 5}Toutes les actus
		{else}Tous les articles{/if}
	</h1>
	<ul class="liste">		
		{foreach from=$lPg item=cPg}		
				<li>					
					{if $curRub->rub_id == 4}
						<a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}" title="{$cPg->pg_titre}">
							<span class="puce">&nbsp;</span> <span class="bleu">{$cPg->pg_date}</span> : {$cPg->pg_titre} {if $cPg->pg_lieu}({$cPg->pg_lieu}){/if}
						</a>
					{else}
						<a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}" title="{$cPg->pg_titre}">{$cPg->pg_titre}</a>
						<a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}#comments" class="comment"><span class="puceFleche">&nbsp;</span> {$cPg->pg_nb_com+0} commentaire{if $cPg->pg_nb_com > 1}s{/if}</a>
					{/if}
				</li>
		{/foreach}
	</ul>
</div>

<div class="noleft"></div>

<button class="more more{$curRub->rub_id} ptSans" onclick="{if $currentUser->usr_id > 0}location.href='./publier-{$curRub->rub_id}'{else}openModalPopup('./connexion', '', 280, 380){/if}">
	<span class="pucePartage">&nbsp;</span> Pour partager {if $curRub->rub_id == 4}un évènement{elseif $curRub->rub_id == 5}une expérience{else}un usage{/if}, c'est ici
</button>