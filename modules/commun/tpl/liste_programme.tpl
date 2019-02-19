
<div id="lastProg" class="last nofloat rond">
	<ul id="caroussel" elastislide-list>
	{foreach from=$lProd item=cProg}
		<li>
			<div style="background: url(./upload/images/p_{$cProg->pg_photo}) no-repeat" class="prog" onclick="location.href='{MakeLienHTML lib=$cProg->$rub_titre type='p' id=$cProg->pg_id}'" title="{$cProg->$pg_titre}">
				<div class="legende">
					<strong>{$cProg->$pg_titre}</strong><br/>
					{$cProg->$pg_contenu|strip_tags|truncate:50}
				</div>
			</div>
		</li>
	{/foreach}
	</ul>
</div>
{literal}
	<script type="text/javascript" src="scripts/jquerypp.custom.js"></script>
	<script type="text/javascript" src="scripts/jquery.elastislide.js"></script>
	<script type="text/javascript">		
		$('#caroussel').elastislide();			
	</script>
{/literal}		