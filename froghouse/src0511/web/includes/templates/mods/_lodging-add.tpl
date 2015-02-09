	<div class="maincontainer">

	   {include file="mods/lodging/_left_menu.tpl"}
	   
  	    <div class="rightpart">
			<div class="title-block"><div>{if !$mid || $mid == 0}Add new{else}Edit{/if} {$bl_inf.c2}</div></div>
			<div class="block">
				<div class="pad">
					<div class="form">
					<form {$fdata.attributes}>
					{if $fdata.errors}
                    {foreach from=$fdata.errors item=err}
                        <p style="color:red">&nbsp;&nbsp;{$err}</p>
                    {/foreach}
					{/if}										
					{section name=i loop=$fdata.elements}
                    {if $fdata.elements[i].type=='hidden'}{$fdata.elements[i].html}{/if} 
					{/section}
					<div class="pad">
						<div class="field">
							<div class="name">Name:</div>
							<div class="inp">{$fdata.el.title.html}</div>
						</div>
						<div class="spacer s9"><!-- --></div>
						<div class="field">
							<div class="name">Address:</div>
							<div class="inp">{$fdata.el.descr.html}</div>
						</div>
						<div class="spacer s9"><!-- --></div>

						{section name=i loop=$fdata.elements}
						{if $fdata.elements[i].label <> ''}
						<div class="field">
							<div class="name">{$fdata.elements[i].label}:</div>
							<div class="inp">{$fdata.elements[i].html}</div>
						</div>
						<div class="spacer s9"><!-- --></div>
						{/if}
						{/section}

						<div class="field">
							<div class="name">Rate:</div>
							<div class="inp">{include file="mods/nightlife/_rate.tpl"}</div>
						</div>
						<div class="spacer s20"><!-- --></div>
						<b class="note">Photo:</b><br>
						<span class="note">Maximum file size is 2Mb. Our service will automatically create a thumbnail. </span>
						{$fdata.el.image.html}
						{$fdata.el.imgdel.html}
						<p>{*<input type="submit" value="Upload File"><br>*}
						{if !$uadmin || (!$mid || $mid == 0)}
						<p><b class="note">Description:</b> (this description will appear as a first review)<br>
						<div class="spacer s5"><!-- --></div>
							<div class="field">
							<div class="name"><!-- --></div>
							<div class="inp">{$fdata.el.comment.html}</div>
						</div>
						{/if}
						<div class="spacer"><!-- --></div>
					</div>
					</form>
					</div>
					<div class="spacer s9"><!-- --></div>
					<div class="link link-left"><a href="#" onClick="document.eform.submit(); return false;">Post it</a>
					{if $uadmin && $mid > 0}&nbsp;&nbsp;&nbsp;<a href="{$siteAdr}page.php?mod={$mod}&block={$block}&mid={$mid}">Cancel</a>{/if}
					</div>
				</div>
			</div>

		</div>

	<div class="spacer"><!-- --></div>
	</div>
