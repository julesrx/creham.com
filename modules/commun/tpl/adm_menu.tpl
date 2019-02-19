<div id="menu">
	{if $currentUser}
		<div id="identite">{$currentUser->usr_login} | <a href="gestion.php?ob=logout">D&eacute;connexion</a></div>	
	<ul>
		<li class="btmenu first">
			<select name="site_id" id="siteid" onchange="location.href='gestion.php?ob=home&amp;site_id='+$('#siteid').val()">					
				{html_options options=$site_options selected=$curSid}
			</select>			
		</li>
						
		{if $curSid}
			<li class="btmenu{if $smarty.request.ob == 'page'} On{/if}" >
				<a href="gestion.php?ob=page&amp;act=liste">CONTENUS</a>
										
			</li>
		{/if}
		<li class="btmenu">|</li>				
		<li class="btmenu{if in_array($smarty.request.ob, array('site', 'categ', 'rubrique'))} On{/if}" >				
			<a href="javascript:void(0)">PARAMETRAGE</a>
			<div class="menu_niv_1">					
				{*<div class="niv1"><a href='gestion.php?ob=site'>Les sites</a></div>							
				<div class="niv1"><a href='gestion.php?ob=rubrique'>Les rubriques</a></div>	*}		
				{*<div class="niv1"><a href="gestion.php?ob=categ&amp;act=liste">Les catégories</a></div>*}
				<div class="niv1"><a href="gestion.php?ob=profil&amp;act=liste&amp;type=admin">Les administrateurs</a></div>
			</div>
		</li>	
	</ul>
	{/if}
</div>