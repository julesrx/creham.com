<?php /* Smarty version 2.6.18, created on 2014-02-18 17:52:44
         compiled from commun/tpl/adm_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'commun/tpl/adm_menu.tpl', 7, false),)), $this); ?>
<div id="menu">
	<?php if ($this->_tpl_vars['currentUser']): ?>
		<div id="identite"><?php echo $this->_tpl_vars['currentUser']->usr_login; ?>
 | <a href="gestion.php?ob=logout">D&eacute;connexion</a></div>	
	<ul>
		<li class="btmenu first">
			<select name="site_id" id="siteid" onchange="location.href='gestion.php?ob=home&amp;site_id='+$('#siteid').val()">					
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['site_options'],'selected' => $this->_tpl_vars['curSid']), $this);?>

			</select>			
		</li>
						
		<?php if ($this->_tpl_vars['curSid']): ?>
			<li class="btmenu<?php if ($_REQUEST['ob'] == 'page'): ?> On<?php endif; ?>" >
				<a href="gestion.php?ob=page&amp;act=liste">CONTENUS</a>
										
			</li>
		<?php endif; ?>
		<li class="btmenu">|</li>				
		<li class="btmenu<?php if (in_array ( $_REQUEST['ob'] , array ( 'site' , 'categ' , 'rubrique' ) )): ?> On<?php endif; ?>" >				
			<a href="javascript:void(0)">PARAMETRAGE</a>
			<div class="menu_niv_1">					
						
								<div class="niv1"><a href="gestion.php?ob=profil&amp;act=liste&amp;type=admin">Les administrateurs</a></div>
			</div>
		</li>	
	</ul>
	<?php endif; ?>
</div>