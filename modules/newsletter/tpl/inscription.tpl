<div id="news">
	<h1 class="titre" id="titre">Restez informé ...</h1>
	{if $errMsg}<div class="errMsg">{$errMsg}</div>
	{elseif $okMsg}<div class="okMsg">{$okMsg}</div>
	{/if}
	
	{if !$currentUser}
		<form action="./newsletter" method="post" id="formPub" style="padding-left: 30px; width: 70%; background : #fff url(../images/vsepar.png) top left no-repeat">
			<div class="intro">Inscrivez-vous à la newsletter</div>		
			<label>Courriel</label><input type="text" class="inbox required email" name="email" value="adresse mail" onfocus="this.value=''" />
			<div class="nofloat">&nbsp;</div>			
			<div align="right"><input type="submit" value="Valider" class="submit"/></div>
			<div class="nofloat">&nbsp;</div>
		</form>
		<br/><br/>
		<div class="intro">Pour contribuer au site, inscrivez-vous <a href="./inscription" title="S'inscrire">ici</a></div>
	{elseif !$cUsr->usr_inscrit_nl}
		<form action="./newsletter" method="post" id="formPub" style="padding-left: 30px; width: 70%; background : #fff url(../images/vsepar.png) top left no-repeat">
			<div class="intro">Inscrivez-vous à la newsletter</div>
			<input type="hidden" name="inscrit" value="1"/>		
			<label>Courriel :</label><label>{$cUsr->usr_login}</label><label>&nbsp;</label><input type="submit" value="Valider" class="submit"/>
			<div class="nofloat">&nbsp;</div>
		</form>
		<br/><br/>
		{if !$currentUser}<div class="intro">Pour contribuer au site, inscrivez-vous <a href="./inscription" title="S'inscrire">ici</a></div>{/if}
	{else}
		<form action="./newsletter" method="post" id="formPub" style="width: 70%">
			<div class="intro">Vous souhaitez vous désinscrire de notre newsletter.</div>
			<input type="hidden" name="desinscrit" value="1"/>			
			<div align="left"><input type="submit" value="Désinscrire" class="submit"/></div>
			<div class="nofloat">&nbsp;</div>
		</form>
	{/if}
	
	{if $lNews}
		<br/><br/>
		<div class="intro">Consultez les newsletters</div>
		<div class="text">
			<ul >
			{foreach from=$lNews item=cN}
				<li>{$cN->nl_d_crea|date_format:"%d/%m/%Y"} : 
					<a href="./voir-{$cN->nl_id}" target="_blank">{$cN->nl_sujet}</a>
					{if $cN->nl_pj}(<a href="./upload/{$cN->nl_pj}" target="_blank">télécharger</a>){/if}
				</li>
			{/foreach}
			</ul>
		</div>
	{/if}
</div>

{literal}
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#formPub").validate();
})
</script>
{/literal}
	
