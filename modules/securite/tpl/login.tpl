{if $smarty.request.pop == "X"}

<div id="pop" class="">
	<div class="titre login ptSans" >
		<button class="close" onclick="$( '#modal-popup' ).dialog( 'close' );">fermer</button>
		Se connecter
	</div>

	<div class="soustitre ptSans"><span class="pucej">&nbsp;</span> Déjà inscrit ?</div>
	<form action="./connexion" method="post" id="">
		<label>Login</label><input type="text" class="inbox rond" name="login" value="adresse mail" onfocus="this.value=''" />
		<div class="nofloat">&nbsp;</div>
		<label>Mot de passe</label><input type="password" class="inbox rond" name="pwd"/>
		<input type="submit" value="ok" class="submit" />
		<div class="nofloat">&nbsp;</div>
		<a href="./perdu" class="link">Mot de passe oublié ?</a>
	</form>
	
	<div class="nofloat"></div>
	<div class="separ"></div>
	<div class="soustitre ptSans"><span class="pucej">&nbsp;</span> <a href="./inscription" class="login">S'inscrire</a></div>

</div>

{else}
<div id="compte">
	<h1 class="titre" id="titre"><span class="pucej">&nbsp;</span> Se connecter</h1>
	
	<div id="pop" class="">
		<div class="err">Erreur de connexion</div>
	
		<div class="soustitre ptSans">&nbsp;</div>
		<form action="./connexion" method="post" id="">
			<label>Login</label><input type="text" class="inbox" name="login" value="adresse mail" onfocus="this.value=''" />
			<div class="nofloat">&nbsp;</div>
			<label>Mot de passe</label><input type="password" class="inbox" name="pwd"/>
			<input type="submit" value="ok" class="submit" />
			<div class="nofloat">&nbsp;</div>
			<a href="./perdu" class="link">Mot de passe oublié ?</a>
		</form>
		
		<div class="nofloat"></div>
		<div class="separ"></div>
		<div class="soustitre ptSans"><span class="pucej">&nbsp;</span> <a href="./inscription" class="login">S'inscrire</a></div>
	
	</div>
	
	
</div>	

{/if}