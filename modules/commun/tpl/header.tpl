<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
	
{getMeta}
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<base href="{$site->site_url}"/>
<link href='http://fonts.googleapis.com/css?family=Cabin:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/style.css?v={$CFG->version}" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/style-ie.css?v={$CFG->version}"/>
<![endif]-->
<!-- Favicons -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="./images/favicon.gif" >
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="scripts/jquery.flexslider-min.js"></script>


{literal}
<script type="text/javascript">	
	$(function() {
		//alert($(window).width());
		
		$('.flexslider').flexslider({
		    animation: "slide",
		    slideshowSpeed: 3000,
		    controlNav: false,
		    start: function(slider) {
			    var num = 1;
				$('.mot').removeClass('motOn');
				$('#mot'+num).addClass('motOn');
		        $('#msg').val(slider.currentSlide);
		      },
		    after: function(slider) {
			    var num = slider.currentSlide+1;
				$('.mot').removeClass('motOn');
				$('#mot'+num).addClass('motOn');
		        $('#msg').val(slider.currentSlide);
		      }
		  });
	});

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{/literal}{$site->site_info.google_code}{literal}']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })(); 

</script>
{/literal}
</head>
<body>

<div id="main" class="">
{if $smarty.request.ob != ''}
	<a href="/" title="retour accueil"><img src="./images/logocreham.gif" alt="Créham" id="logo"></a>
	<hr/>
{if $smarty.get.pop != 1}	
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
	      <img src="./upload/images/diapo_urbaniste.jpg?v={$CFG->version}" />
	    </li>
	   	<li>
	      <img src="./upload/images/diapo_architecte1.jpg?v={$CFG->version}" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_paysage1.jpg?v={$CFG->version}" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_psycho.jpg?v={$CFG->version}" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_socio.jpg?v={$CFG->version}" />
	    </li>
    	<li>
	      <img src="./upload/images/diapo_geographe.jpg?v={$CFG->version}" />
	    </li>
	  </ul>
	</div>
{/if}	
	<nav id="interNav">
		{foreach from=$lMenu.1 item=cMenu}
			{if $smarty.get.pop != 1 || $curPg->pg_id == $cMenu->pg_id}
				<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}" title="{$cMenu->pg_titre}" {if $curPg->pg_id == $cMenu->pg_id}class="on"{/if}>{$cMenu->pg_titre}</a>
			{/if}
		{/foreach}
		
	{if $smarty.get.pop != 1}
		<div class="ssmenu">
			<a href="/contact" title="contactez-nous" {if $smarty.request.ob == 'c'}class="on"{/if}><img src="./images/picto-contact.png" alt=""/> contact</a>
			{foreach from=$lMenu.2 item=cMenu}
				<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}"  title="{$cMenu->pg_titre}" {if $curPg->pg_id == $cMenu->pg_id}class="on"{/if}><img src="./images/picto-acces.png" alt=""/> {$cMenu->pg_titre}</a>
			{/foreach}
			{foreach from=$lMenu.4 item=cMenu}
				<a href="{MakeLienHTML lib=$cMenu->pg_titre id=$cMenu->pg_id type='p'}"  title="{$cMenu->pg_titre}" {if $curPg->pg_id == $cMenu->pg_id}class="on"{/if}><img src="./images/picto-espace.png" alt=""/> {$cMenu->pg_titre}</a>
			{/foreach}	
		</div>
	{/if}
	</nav>
	<hr/>
{/if}	

	
	
