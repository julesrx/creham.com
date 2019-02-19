{if $smarty.request.ob != '' && $smarty.get.pop != 1}
	<footer class="" style="text-align: right">
		{foreach from=$lMenu.3 item=cMenu}
			<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}" title="">{$cMenu->pg_titre}</a>
		{/foreach}
	</footer>
{/if}

</div><!-- Fin de main -->
</body>
</html>