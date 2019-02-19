<?php /* Smarty version 2.6.18, created on 2013-10-07 19:15:10
         compiled from contenu/tpl/adm_ressource_form.tpl */ ?>
<style type="text/css">@import url(./plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css);</style>
<script type="text/javascript" src="./plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="./plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<?php echo '
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").plupload({
		// General settings
		runtimes : \'browserplus,html5\',
		url : \'gestion.php?ob=page&act=uploadRessource&pop=X&pg_id='; ?>
<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
<?php echo '\',
		max_file_size : \'10mb\',
		preinit : attachCallbacks,
		//chunk_size : \'1mb\',
		//unique_names : true,

		// Resize images on clientside if we can
		//resize : {width : 320, height : 240, quality : 90},

		// Specify what files to browse for
		filters : [
			{title : "Fichiers autorisé", extensions : "jpg,gif,png,doc,docx,pdf,xls,xlsx,avi,mpg, mov,wma"}
		],
		
	});

	
});

function attachCallbacks(uploader) {
	uploader.bind(\'FileUploaded\', function(Up, File, Response) {
	    if( (uploader.total.uploaded + 1) == uploader.files.length)
	         {
	    	// appel Ajax
            $.ajax({
                url: \'gestion.php?ob=page&act=getResAjax&pg_id=&pop=X&pg_id='; ?>
<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
<?php echo '\',
                type: \'get\', 
                success: function(src) { // je récupère la réponse du fichier PHP
                    // affiche la liste des réponses en traitant le flux json
                    $(\'#ressListe\').html(src);
                }
            });
	          }
	    })
	}
</script>
'; ?>



<div id="uploader">
	<p>Votre navigateur ne supporte pas ce service.</p>
</div>

