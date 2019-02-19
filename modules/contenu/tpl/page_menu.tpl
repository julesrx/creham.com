<div id="ssmenu">
{if $curRub->rub_id == 2} {* Usages *}
	<div class="titre rondTop">Derniers articles</div>
	<ul class="liste rondBas">
		{assign var=i value=1}
		{foreach from=$lPg item=cPg}
			{if $i <= 3}
				<li><a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}" title="{$cPg->pg_titre}"><span class="puceg left">&nbsp;</span><span class="left item {if $cPg->pg_id == $curPg->pg_id}on{/if}">{$cPg->pg_titre}</span></a><br class="noleft"/></li>
			{/if}
			{assign var=i value=$i+1}
		{/foreach}
	</ul>	
	<div class="more rondTop rondBas"><a href="{MakeLienHTML lib=$curRub->rub_lib type='r' id=$curRub->rub_id}" title="{$curRub->rub_lib}"><span class="puceplus">&nbsp;</span> <span {if !$curPg->pg_id}class="on"{/if}>Tous les articles</span></a></div>
{elseif $curRub->rub_id == 5} {* Actus *}
	<div class="titre rondTop">Dernières actus</div>
	<ul class="liste rondBas">
		{assign var=i value=1}
		{foreach from=$lPg item=cPg}
			{if $i <= 4}
				<li><a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}" title="{$cPg->pg_titre}"><span class="puceg left">&nbsp;</span><span class="left item {if $cPg->pg_id == $curPg->pg_id}on{/if}">{$cPg->pg_titre}</span></a><br class="noleft"/></li>
			{/if}
			{assign var=i value=$i+1}
		{/foreach}
	</ul>	
	<div class="more rondTop rondBas"><a href="{MakeLienHTML lib=$curRub->rub_lib type='r' id=$curRub->rub_id}" title="{$curRub->rub_lib}"><span class="puceplus">&nbsp;</span> <span {if !$curPg->pg_id}class="on"{/if}>Toutes les actus</span></a></div>
{elseif $curRub->rub_id == 6} {* Logiciel *}
	<div class="titre rondTop">Editeurs</div>
	<ul class="liste rondBas">
		{foreach from=$lPg item=cPg}
			<li><a href="{MakeLienHTML lib=$cPg->pg_titre type='p' id=$cPg->pg_id}" title="{$cPg->pg_titre}"><span class="puceg left">&nbsp;</span><span class="left item {if $cPg->pg_id == $curPg->pg_id}on{/if}">{$cPg->pg_titre}</span></a><br class="noleft"/></li>
		{/foreach}
	</ul>	
		
	
{elseif $curRub->rub_id == 3} {* CONSEILS *}
	<div class="titre rondTop">Par catégorie</div>
	<ul class="liste rondBas">
		{foreach from=$lCateg item=cCateg}
			<li><a href="{MakeLienHTML lib=$cCateg->cat_lib type='c' id=$cCateg->cat_id}" title="{$cPg->pg_titre}"><span class="puceg left">&nbsp;</span><span class="left item {if $curCateg->cat_id == $cCateg->cat_id}on{/if}">{$cCateg->cat_lib}</span></a><br class="noleft"/></li>			
		{/foreach}
	</ul>	
	<div class="more rondTop rondBas"><a href="{MakeLienHTML lib='Tous les conseils pratiques' type='c' id=''}" title="{$curRub->rub_lib}"><span class="puceplus">&nbsp;</span> <span {if !$curPg->pg_id && !$curCateg->cat_id}class="on"{/if}>Tous les conseils<br/>pratiques</span></a></div>
{/if}
</div>