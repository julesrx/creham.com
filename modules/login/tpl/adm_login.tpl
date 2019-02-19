	
	<div id="centreLogin">
	
		<form action="gestion.php?ob=login&act=check" method="post" id="formLogin" class="rond bord ombre">
			<h1>Identification</h1>
			<br/><br/>
			<div class="field">
				<label>Identifiant</label>
    			<input name="usr_email" id="usr_email" value="" class="formInput"/>
    			<div class="nofloat"></div>
    		</div>
    		
			<div class="field">
				<label>Mot de passe</label>
    			<input type=password name=usr_pwd  value="" id="usr_pwd" class="formInput"/>
    			<div class="nofloat"></div>
    		</div>
  			<div class="field">
				<label>&nbsp;</label>
    			<input type="submit" value="valider" class="btn rond"/>
    		</div>    	
    		{include file="commun/tpl/adm_ok_msg.tpl"}		
    	</form>
    </div>
    
    <script>
    	$('#usr_email').focus();
    </script>