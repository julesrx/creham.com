<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./ckfinder/ckfinder.js"></script>

{if $errMsg}<div class="errMsg">{$errMsg}</div>
{elseif $okMsg}<div class="okMsg">{$okMsg}</div>
{/if}

<div class="tools">
	<a name="comments"></a>
	<a href="javascript:void(0)" class="btcomment {if $taille > 0}voirComment{/if}"><span class="puceFleche">&nbsp;</span> {$taille} commentaire{if $taille > 1}s{/if}</a>
	<div id="comments" style="display: none">
		{foreach from=$lCom item=cCom}
		<div class="item">
			<div class="lib ptSans">
				<span class="pseudo">{$cCom->usr_initiales}</span>
				<span class="date">{$cCom->com_date|date_format:"%d %B %Y"}</span>
			</div>
			<div class="tComment ptSans">
				{$cCom->com_content}
			</div>
		</div>
		{/foreach}
		
	</div>
	<a href="javascript:void(0)" {if $currentUser->usr_id > 0}class="reagir"{else}onclick="openModalPopup('./connexion', '', 280, 380)"{/if} ><span class="puceFleche">&nbsp;</span> réagir</a>
{if $currentUser->usr_id > 0}	
	<a name="reagir"></a>
	<div id="pub">		
		<form action="./reagir-{$curPg->pg_id}" method="post" id="reaction" style="display: none;">
			<br/>
			<p>Nous vous invitons à laisser un commentaire sur cet article en remplissant ce formulaire. Il sera signé de vos initiales et sera publié après vérification par notre équipe éditoriale.</p>
			<br/>
			{PrintEditor innerHtml=$smarty.post.com_content name="com_content" width="555" height="300"}
			<div class="nofloat"></div>	
			<div class="btnAction">
				<a href="javascript:void(0)" onclick="$('#reaction').toggle();" title="retour">Annuler</a>
				<input type="submit" value="Enregistrer" class="submit"/>
				<div class="nofloat">&nbsp;</div>
			</div>
		<div class="nofloat">&nbsp;</div>
		</form>
	</div>
{/if}
	
</div>

{literal}
<script>
	$().ready(function() {
		//affichage direct des commentaires
		var URI = location.href; // local url without hash
		var regComment = new RegExp("#comments", "g");
		if (URI.match(regComment)) {
			$('#comments').show();
		}
		var regReagir = new RegExp("#reagir", "g");
		if (URI.match(regReagir)) {
			$('#reaction').show();
		}
	})
</script>
{/literal}
