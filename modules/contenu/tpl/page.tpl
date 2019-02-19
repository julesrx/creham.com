
<article>	
	<div id="info">
		{$curPg->pg_contenu}
	</div>
	
{if $smarty.get.pop != 1}	
	<div id="tool">
		<a href="{MakeLienHTML lib=$curPg->pg_titre id=$curPg->pg_id type='p'}?pop=1" title="version imprimable" target="_blank"><img src="./images/picto-print.png" alt=""/> Imprimer la page</a>
		<hr/>
		<p align="right"><img src="./images/virgule.png" alt="" id="virgule"/></p>
		{if $curPg->pg_photo}
			<img src="{$CFG->imgurl}{$curPg->pg_photo}" alt=""/>
		{/if}
	</div>
{/if}
	<div class="nofloat"></div>
</article>
{if $smarty.get.pop == 1}
	<script type="text/javascript">
<!--
	window.print();
//-->
</script>
{/if}