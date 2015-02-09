{*<meta http-equiv="Content-Type" content="text/HTML; charset=windows-1251" />*}

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2" height="3"><img height="3" border="0"></td>
    </tr>

    <tr>
        {*<!--Central part-->*}
        <td colspan="2" height="450" align="left" valign="top">
            <br />

            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                    <h2>Main page images (image size 196x235px)</h2>
                    <br />

                    {*<!--banner list output-->*}

                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    {*<!--List-->*}
                    {section name=i loop=$category}
                    <tr>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="26"><img src="includes/templates/images/preview.gif" border="0"></td>
                                    <td width="150px"><a href="{$category[i].image}" target="_blank"><b>{$category[i].name}</b></a></td>
									<td width="150px"><a href="{$category[i].link}"  target="_blank">{$category[i].link}</a></td>
									<td>{if $category[i].btype == 0}{#btype1#}{else}{#btype2#}{/if}</td>
                                </tr>
                            </table>
                        </td>

                        <td width="35"><a href="{$curScriptName}?action=delban&id={$category[i].id}"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="{#delete#}" /></a></td>
                    </tr>
					<tr>
				        <td colspan="2" height="1px" bgcolor="#CCCCCC"></td>
				    </tr>	
                    {/section}
                   </table>

            </table>

        </td>
        {*<!--End Central part-->*}

        <td width="4"><img width="4" height="0"></td>

        {*<!--Right part-->*}
        <td width="250" valign="top">

             {if $action == "change"}

             <b>{#action#}: {#add#} image</b>

             {if $fdata.javascript}
                 {$fdata.javascript}
             {/if}

             <form {$fdata.attributes}>
             {if $fdata.errors}
                 {foreach from=$fdata.errors item=err}
                   <p style="color:red">{$err}</p>
                 {/foreach}
             {/if}
             <table>
                {section name=i loop=$fdata.elements}
                {if $fdata.elements[i].type=='text' || $fdata.elements[i].type=='textarea' || $fdata.elements[i].type=='static'
                                           || $fdata.elements[i].type=='file' || $fdata.elements[i].type=='select'}
                <tr>
                    <td><b>{$fdata.elements[i].label}</b></td>
                </tr>
                <tr>
                    <td>{$fdata.elements[i].html}</td>
                </tr>
                {elseif $fdata.elements[i].type=='hidden'}
                    {$fdata.elements[i].html}
                {/if}
                {/section}
             </table>

             <table width="200" border="0" cellpadding="0" cellspacing="0">
             <tr valign="top">
                <td><A href="#" onClick="document.eform.submit();return false;"><IMG src="includes/templates/images/b_submit.gif" border="0" alt="{#submit#}" width="100" height="18" /></A>&nbsp;&nbsp;</td>
                <td><a href="{$curScriptName}"><img src="includes/templates/images/b_cancel.gif" border="0" alt="{#cancel#}"></a></td>
             </tr>
             </table>
             </form>
            {elseif $action=="delban"}
                <br /><br />
                                <b>Delete Image</b> "{$inf.name}" ?
                <br /><br />
                <a href="{$curScriptName}?id={$inf.id}&action=delban&do=1"><img src="includes/templates/images/b_submit.gif" alt="{#submit#}" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="{$curScriptName}"><img src="includes/templates/images/b_cancel.gif" border="0" alt="{#cancel#}"></a>
            
			{else}
			<br />
			<a href="{$curScriptName}?action=change"><IMG src="includes/templates/images/b_addusr.gif" border="0" alt="{#submit#}" /></a>
			{/if}
        </td>
    </tr>
</table>