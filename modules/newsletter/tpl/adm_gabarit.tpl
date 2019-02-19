{if $type == 'une'}
	<table border="0" cellpadding="0" cellspacing="0" width="700">		
		<tr>
			<td style="width: 30px">&nbsp;</td>
			<td style="width: 180px" align="left">
			{if $cPg->pg_photo}				
					<img src="{$site->site_url}upload/images/p_{$cPg->pg_photo}" alt="{$cPg->pg_titre}" width="60" style="width: 160px;"/>
			{else}&nbsp;										
			{/if}
			</td>
			<td>
				<div><img src="{$site->site_url}images/nl/rub1.gif" alt="A la une"/></div>
				<div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 23px">{$cPg->pg_titre}</span></span></span></span></div>
				<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
					{$cPg->pg_contenu|strip_tags|truncate:200:'...'}
					<a href="{$site->site_url}{MakeLienHTML lib=$cPg->pg_titre type="p" id=$cPg->pg_id}" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
					</span></span></span></span>
				</div>
			</td>			
			<td width="30px">&nbsp;</td>
		</tr>
	</table>
{else}
	<table border="0" cellpadding="0" cellspacing="0" width="300">
	{assign var=prec value=""}
	{foreach from=$lPg item=cPg}
		{if $prec != $cPg->rub_id}
			<tr>
				<td><img src="{$site->site_url}images/nl/rub{$cPg->rub_id}.gif" alt="{$cPg->rub_titre}"/></td>
			</tr>				
			<tr>
				<td>&nbsp;</td>
			</tr>
		{/if}
		{assign var=prec value=$cPg->rub_id}
		
		<tr>
			<td>
				{if $cPg->rub_id != 4}
					{if $cPg->pg_photo}
						<table border="0" cellpadding="0" cellspacing="0" width="300">
							<tr><td colspan="2"><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 20px">{$cPg->pg_titre}</span></span></span></span></td></tr>
							<tr>
								<td style="width: 180px; text-align: left; vertical-align: top;">
									<img src="{$site->site_url}upload/images/p_{$cPg->pg_photo}" alt="{$cPg->pg_titre}" style="width: 160px;"/>
								</td>
								<td style="vertical-align: top"></td>
							</tr>
							<tr>
								<td colspan="2">
									{if $cPg->pg_chapo}<div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 13px">{$cPg->pg_chapo}</span></span></span></span></div>{/if}
									<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
										{$cPg->pg_contenu|strip_tags|truncate:200:'...'}
										<a href="{$site->site_url}{MakeLienHTML lib=$cPg->pg_titre type="p" id=$cPg->pg_id}" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
										</span></span></span></span>
									</div>	
								</td>
							</tr>							
						</table>
					{else}
						<div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 20px">{$cPg->pg_titre}</span></span></span></span></div>
						<div>&nbsp;</div>
						{if $cPg->pg_chapo}<div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 13px">{$cPg->pg_chapo}</span></span></span></span></div>{/if}
						<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
							{$cPg->pg_contenu|strip_tags|truncate:200:'...'}
							<a href="{$site->site_url}{MakeLienHTML lib=$cPg->pg_titre type="p" id=$cPg->pg_id}" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
							</span></span></span></span>
						</div>
					{/if}
				{else}
					<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
						<span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 13px">{$cPg->pg_date} : </span></span></span></span>
						{$cPg->pg_titre}						
						</span></span></span></span>
					</div>
					<div style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px">
						{$cPg->pg_contenu|strip_tags|truncate:200:'...'}
						<a href="{$site->site_url}{MakeLienHTML lib=$cPg->pg_titre type="p" id=$cPg->pg_id}" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
					</div>
					
				{/if}
			</td>			
			
		</tr>
	{/foreach}
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				{if $prec == 2}
					<a href="{$site->site_url}usages-r-2" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="{$site->site_url}images/nl/plus.png" alt="" style="vertical-align: middle"/> Tous les usages
					</a>
				{elseif $prec == 3}
					<a href="{$site->site_url}tous-les-conseils-pratiques-c-" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="{$site->site_url}images/nl/plus.png" alt="" style="vertical-align: middle"/> Plus de conseils pratiques
					</a>		
				{elseif $prec == 4}
					<a href="{$site->site_url}rendez-vous-r-4" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="{$site->site_url}images/nl/plus.png" alt="" style="vertical-align: middle"/> Tous les rendez-vous
					</a>
				{elseif $prec == 5}
					<a href="{$site->site_url}toutes-les-actus-r-5" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="{$site->site_url}images/nl/plus.png" alt="" style="vertical-align: middle"/> Toutes les actus
					</a>
				{/if}
			</td>
		</tr>
	</table>


{/if}