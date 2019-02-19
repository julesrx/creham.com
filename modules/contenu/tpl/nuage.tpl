

<div id="cloud" style="width: 100%; height: 350px; "></div>

{literal}
<script type="text/javascript">
      /*!
       * Create an array of word objects, each representing a word in the cloud
       */
      var word_array = [
       {/literal}
       
       {foreach from=$lMot item=nb key=id}
       	{assign var=mot value=$lTag.$id}
       	
			{if $mot->tag_lib != '0' && $mot->tag_lib != ''}
				{assign var=taille value=$taille-1}
				
				{ldelim}text: "{$mot->tag_lib}", weight: {$nb}, link: "{MakeLienHTML lib=$mot->tag_lib type='tag' id=$id}"{rdelim}{if $taille > 0},{/if}					
			{/if}
       {/foreach}
       {literal}                     
      ];

      $(function() {
        // When DOM is ready, select the container element and call the jQCloud method, passing the array of words as the first argument.
        $("#cloud").jQCloud(word_array);
      });
    </script>

{/literal}