	<div id="gauche">
		<div class="tblEntete"><a href="gestion.php?ob=site&act=new" style="float:right"><b>>> Nouveau site</b></a></div>

		<div class="listeElt">
		{foreach from=$lElt item=cElt}			
			<a href="gestion.php?ob=site&act=view&site_id={$cElt->site_id}">
				<div class="{if $selElt->site_id == $cElt->site_id}tblOn{else}tblOff{/if}" style="padding-left: 10px;">
					{$cElt->site_lib}
				</div>
			</a>
		{foreachelse}
			<div class="tblOff">Pas de site</div>
		{/foreach}
		</div>
		<div class="tblEntete">{sizeof liste=$lElt} site{if sizeof($lElt) > 1}s{/if}</div>
	</div>
	 
	<div id="centre">
		<div id="action">		
			{include file="commun/tpl/adm_ok_msg.tpl"}			
		</div>

		<div id="viewMessage">
			<span class="tblEntete isCentre"><i><b>{if $selElt->site_id}Site : {$selElt->site_lib}{else}Nouveau site{/if}</b></i></span>
			<div>{if isset($lockMsg)}{$lockMsg}{/if}</div>
			<form action="gestion.php?ob=site&act=save" method="POST" id="formSite" class="retrait" enctype="multipart/form-data">
				<input type="hidden" value="{$selElt->site_id}" name="site_id" id="site_id">
				
				<label>Libellé : </label><input type="text" class="formInput required" value="{$selElt->site_lib}" name="site_lib" id="site_lib"/>
				<div class="nofloat"></div>
				<label>Url : </label><input type="text" class="formInput required" value="{$selElt->site_url}" name="site_url" id="site_url"/>
				<div class="nofloat"></div>
				<label>Code google : </label><input type="text" class="formInput required" value="{$selElt->site_info.google_code}" name="google_code" id="google_code"/>
				<div class="nofloat"></div>
				<label>Email de notification :<br/><small>(liste séparée par ;)</small> </label><input type="text" class="formInput required" value="{$selElt->site_info.email_admin}" name="email_admin" id="email_admin"/>
				<div class="nofloat">&nbsp;</div>
				<label>Meta Title : </label><input type="text" class="formInput required" value="{$selElt->site_info.site_title}" name="site_title" id="site_title"/>
				<div class="nofloat"></div>			
				<label>Meta Description : </label><input type="text" class="formInput required" value="{$selElt->site_info.site_desc}" name="site_desc" id="site_desc"/>
				<div class="nofloat"></div>

				<label>Contact : </label>
				<div class="nofloat"></div>				
				{PrintEditor innerHtml=$selElt->site_info.site_contact name="site_contact" width="90%" height="200"}
				<div class="nofloat"></div>				
				<br/><br/>
				<div class="btnAction">
					<input type="submit" value="Enregistrer" class="btnSave">
				</div>

			</form>
			
		</div>
		
			<script type="text/javascript">				
				{literal}$('#formSite').validate();{/literal}				
			</script>
		

	</div>
	

	
