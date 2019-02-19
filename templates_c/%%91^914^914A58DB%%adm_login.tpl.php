<?php /* Smarty version 2.6.18, created on 2013-12-30 18:12:10
         compiled from login/tpl/adm_login.tpl */ ?>
	
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
    		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "commun/tpl/adm_ok_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>		
    	</form>
    </div>
    
    <script>
    	$('#usr_email').focus();
    </script>