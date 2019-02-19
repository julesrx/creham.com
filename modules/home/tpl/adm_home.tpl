
	<div id="centreLogin" align="center">
		<br/>
		<br/>
		<br/>
		<h1>Bienvenue sur l'interface d'administration du site {$CFG->titre_site}</h1>
		
		<br/>
		<br/>
		{if !$curSid}
			<h2>choix du site</h2><br/><br/>
			{foreach from=$lElt item=cSite}
				<p><a href="gestion.php?ob=home&site_id={$cSite->site_id}" style="font-size: 2.5em">&gt; {$cSite->site_lib}</a></p>
			{/foreach}
		{else}
			<h2 style="font-size: 2.5em">{$site->site_lib}</h2>
		{/if}
	</div>
	

	