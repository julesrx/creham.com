<style type="text/css">@import url(./plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css);</style>
<script type="text/javascript" src="./plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="./plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>

{literal}
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").plupload({
		// General settings
		runtimes : 'browserplus,html5',
		url : 'gestion.php?ob=page&act=uploadRessource&pop=X&pg_id={/literal}{$cPage->pg_id}{literal}',
		max_file_size : '10mb',
		preinit : attachCallbacks,
		//chunk_size : '1mb',
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
	uploader.bind('FileUploaded', function(Up, File, Response) {
	    if( (uploader.total.uploaded + 1) == uploader.files.length)
	         {
	    	// appel Ajax
            $.ajax({
                url: 'gestion.php?ob=page&act=getResAjax&pg_id=&pop=X&pg_id={/literal}{$cPage->pg_id}{literal}',
                type: 'get', 
                success: function(src) { // je récupère la réponse du fichier PHP
                    // affiche la liste des réponses en traitant le flux json
                    $('#ressListe').html(src);
                }
            });
	          }
	    })
	}
</script>
{/literal}


<div id="uploader">
	<p>Votre navigateur ne supporte pas ce service.</p>
</div>


