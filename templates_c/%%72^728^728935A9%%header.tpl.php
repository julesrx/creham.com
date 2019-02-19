<?php /* Smarty version 2.6.18, created on 2014-02-07 18:10:14
         compiled from commun/tpl/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getMeta', 'commun/tpl/header.tpl', 6, false),array('function', 'MakeLienHTML', 'commun/tpl/header.tpl', 102, false),)), $this); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
	
<?php echo getMeta(array(), $this);?>

<meta name="viewport" content="width=device-width, initial-scale=1"/>
<base href="<?php echo $this->_tpl_vars['site']->site_url; ?>
"/>
<link href='http://fonts.googleapis.com/css?family=Cabin:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/style-ie.css?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
"/>
<![endif]-->
<!-- Favicons -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="./images/favicon.gif" >
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="scripts/jquery.flexslider-min.js"></script>


<?php echo '
<script type="text/javascript">	
	$(function() {
		//alert($(window).width());
		
		$(\'.flexslider\').flexslider({
		    animation: "slide",
		    slideshowSpeed: 3000,
		    controlNav: false,
		    start: function(slider) {
			    var num = 1;
				$(\'.mot\').removeClass(\'motOn\');
				$(\'#mot\'+num).addClass(\'motOn\');
		        $(\'#msg\').val(slider.currentSlide);
		      },
		    after: function(slider) {
			    var num = slider.currentSlide+1;
				$(\'.mot\').removeClass(\'motOn\');
				$(\'#mot\'+num).addClass(\'motOn\');
		        $(\'#msg\').val(slider.currentSlide);
		      }
		  });
	});

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \''; ?>
<?php echo $this->_tpl_vars['site']->site_info['google_code']; ?>
<?php echo '\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })(); 

</script>
'; ?>

</head>
<body>

<div id="main" class="">
<?php if ($_REQUEST['ob'] != ''): ?>
	<a href="/" title="retour accueil"><img src="./images/logocreham.gif" alt="Créham" id="logo"></a>
	<hr/>
<?php if ($_GET['pop'] != 1): ?>	
	<p id="metierSlide"><input type="hidden" id="msg"/>
		<span id="mot1" class="mot">urbanist<span class="on">e</span></span>
		<span id="mot2" class="mot">archit<span class="on">e</span>cte</span>
		<span id="mot3" class="mot">paysagist<span class="on">e</span></span>
		<span id="mot4" class="mot">psychosociologu<span class="on">e</span></span>
		<span id="mot5" class="mot">socio<span class="on">é</span>conomiste</span>
		<span id="mot6" class="mot">g<span class="on">é</span>ographe</span>
	</p>
	<hr/>
	<div class="flexslider">
	  <ul class="slides">
	    <li>
	      <img src="./upload/images/diapo_urbaniste.jpg?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
" />
	    </li>
	   	<li>
	      <img src="./upload/images/diapo_architecte1.jpg?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_paysage1.jpg?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_psycho.jpg?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_socio.jpg?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_geographe.jpg?v=<?php echo $this->_tpl_vars['CFG']->version; ?>
" />
	    </li>
	  </ul>
	</div>
<?php endif; ?>	
	<nav id="interNav">
		<?php $_from = $this->_tpl_vars['lMenu']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
			<?php if ($_GET['pop'] != 1 || $this->_tpl_vars['curPg']->pg_id == $this->_tpl_vars['cMenu']->pg_id): ?>
				<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
" title="<?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
" <?php if ($this->_tpl_vars['curPg']->pg_id == $this->_tpl_vars['cMenu']->pg_id): ?>class="on"<?php endif; ?>><?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		
	<?php if ($_GET['pop'] != 1): ?>
		<div class="ssmenu">
			<a href="/contact" title="contactez-nous" <?php if ($_REQUEST['ob'] == 'c'): ?>class="on"<?php endif; ?>><img src="./images/picto-contact.png" alt=""/> contact</a>
			<?php $_from = $this->_tpl_vars['lMenu']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
				<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
"  title="<?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
" <?php if ($this->_tpl_vars['curPg']->pg_id == $this->_tpl_vars['cMenu']->pg_id): ?>class="on"<?php endif; ?>><img src="./images/picto-acces.png" alt=""/> <?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
			<?php endforeach; endif; unset($_from); ?>
			<?php $_from = $this->_tpl_vars['lMenu']['4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
				<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
"  title="<?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
" <?php if ($this->_tpl_vars['curPg']->pg_id == $this->_tpl_vars['cMenu']->pg_id): ?>class="on"<?php endif; ?>><img src="./images/picto-espace.png" alt=""/> <?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
			<?php endforeach; endif; unset($_from); ?>	
		</div>
	<?php endif; ?>
	</nav>
	<hr/>
<?php endif; ?>	

	
	