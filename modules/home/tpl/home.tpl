<a href="/" title="retour accueil"><img src="./images/logocreham.gif" alt="Créham" id="homeLogo"></a>
<span id="titre">une équipe pluridisciplinaire</span>
<hr/>
<p id="baseline">Urbanisme, paysage, sociologie et développement local</p>
<hr/>
<img src="./upload/images/home.jpg" alt="" id="homeImg"/>
<hr/>
<p id="metier">Etude,<img src="./images/pixel.gif" alt="" width="8"/>conseil,<img src="./images/pixel.gif" alt="" width="7"/>assistance à maîtrise d'ouvrage et maîtrise d'oeuvre</p>
<hr/>
<nav id="homeNav">
	<img src="./images/virgule.png" alt="" id="virgule"/>
	{foreach from=$lMenu.1 item=cMenu}
		<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}" title="">{$cMenu->pg_titre}</a>
	{/foreach}

<br><br><br><br>
<a href="https://www.gironde-habitat.fr/" target="_blank" style="text-decoration: underline;">Enquête Locataires Résidence de L'Europe</a>

</nav>
<footer class="">
	<a href="/contact" title="contactez-nous"><img src="./images/picto-contact.png" alt=""/> contact</a>
	{foreach from=$lMenu.2 item=cMenu}
		<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}" title=""><img src="./images/picto-acces.png" alt=""/> {$cMenu->pg_titre}</a>
	{/foreach}
	{foreach from=$lMenu.4 item=cMenu}
		<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}"  title="{$cMenu->pg_titre}" {if $curPg->pg_id == $cMenu->pg_id}class="on"{/if}><img src="./images/picto-espace.png" alt=""/> {$cMenu->pg_titre}</a>
	{/foreach}

	<span class="mention">
		{foreach from=$lMenu.3 item=cMenu}
			<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}" title="">{$cMenu->pg_titre}</a>
		{/foreach}
	</span>
</footer>
