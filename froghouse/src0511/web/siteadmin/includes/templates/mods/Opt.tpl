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
                    <h2>{#catalog#}</h2>

                    <a href="{$curScriptName}">{#pcatalog#}</a>
                    {section name=i loop=$bc}
                         > <a href="{$bc[i].link}">{$bc[i].name}</a>
                    {/section}
                    <br />
                    <br />

                    {*<!--Catalog list output-->*}

                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    {*<!--Category list-->*}
                    {section name=i loop=$category}
                    <tr>
                        <td width="15">{$category[i].sortid}&nbsp;</td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="26"><img src="includes/templates/images/folder.gif" border="0"></td>
                                    <td><a href="{$curScriptName}?cid={$category[i].id}">{$category[i].block} :: {$category[i].name}</a></td>
                                </tr>
                            </table>
                        </td>


                       <td width="35"><a href="{$curScriptName}?cid={$category[i].id}"><IMG src="includes/templates/images/b_browse.png" border="0" width="16" height="16" title="{#enter#}" /></a></td>
                       <td width="35"><a href="{$curScriptName}?action=edit&cid={$category[i].id}"><IMG src="includes/templates/images/b_edit.png" border="0" width="16" height="16" title="{#edit#}" /></a></td>
                       <td width="35"><a href="{$curScriptName}?action=delcat&cid={$category[i].id}"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="{#delete#}" /></a></td>
                    </tr>
                                        <tr>
                                        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
                                    </tr>
                    {/section}

                     {*<!--Products list-->*}
                    {section name=i loop=$product}
                    <tr>
                        <td width="15">{$product[i].sortid}&nbsp;</td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="26"><img src="includes/templates/images/preview.gif" border="0"></td>
                                <td><a href="{$curScriptName}?cid={$cid}&action=edit&id={$product[i].pid}">{$product[i].val}</a></td>
                            </tr>
                            </table>
                        </td>
 
                        <td>
                            <a href="{$curScriptName}?cid={$cid}&action=change&id={$product[i].id}"><IMG src="includes/templates/images/b_edit.png" border="0" width="16" height="16" title="{#edit#}" /></a>
                        </td>

                        <td>
                            <a href="{$curScriptName}?cid={$cid}&action=delp&id={$product[i].id}"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="{#delete#}" /></a>
                        </td>
                        <td>
                        </td>
                    </tr>
                                        <tr>
                                        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
                                    </tr>
                    {/section}
                   </table>

                   {*<!--Pagging and buttons-->*}
                   <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr>
                       <td height="26" colspan="5"></td>
                   </tr>
                   <tr>
                       <td width="50%">&nbsp;</td>
                       {if $cid<>0 && $cid <> ''}
                       <td><a href="{$curScriptName}"><img src="includes/templates/images/b_up.gif" border="0" alt="{#ontop#}"></a>&nbsp;</td>
                       {/if}
                       <td>
                       {if $cid <> 0 }
                           <a href="{$curScriptName}?cid={$cid}&action=change"><img src="includes/templates/images/b_addoptval.gif" border="0" alt="{#add#} Option values"></a>&nbsp;
                       {/if}
                      </td>
                      <td>{if $cid == 0}<a href="{$curScriptName}?cid={$cid}&action=edit"><img src="includes/templates/images/b_addopt.gif" border="0" alt="{#add#} Option"></a>{/if}</td>
                   </tr>
                   </table>

            </table>

        </td>
        {*<!--End Central part-->*}

        <td width="4"><img width="4" height="0"></td>

        {*<!--Right part-->*}
        <td width="250" valign="top">

             {if $action == "change"}

                 <b>{#action#}: {if $id == 0 || $id == ''}{#add#}{else}{#edit#}{/if} option value</b>

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
                    <td><a href="{$curScriptName}?cid={$cid}"><img src="includes/templates/images/b_cancel.gif" border="0" alt="{#cancel#}"></a></td>
                 </tr>
                 </table>
                 </form>
            {/if}
			
             {if $action == "edit"}

                 <b>{#action#}: {if $cid == 0 || $cid == ''}{#add#}{else}{#edit#}{/if} option</b>

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
                 <br />
                 <table width="200" border="0" cellpadding="0" cellspacing="0">
                 <tr valign="top">
                    <td><A href="#" onClick="document.eform.submit();return false;"><IMG src="includes/templates/images/b_submit.gif" border="0" alt="{#submit#}" width="100" height="18" /></A>&nbsp;&nbsp;</td>
                    <td><a href="{$curScriptName}?cid={$cid}"><img src="includes/templates/images/b_cancel.gif" border="0" alt="{#cancel#}"></a></td>
                 </tr>
                 </table>
                 </form>
            {/if}
			
            {if $action=="delcat"}
                <br /><br />
                                <b>Delete option</b> "{$inf.name}" with all values?
                <br /><br />
                <a href="{$curScriptName}?cid={$inf.id}&action=delcat&do=1"><img src="includes/templates/images/b_submit.gif" alt="{#submit#}" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="{$curScriptName}"><img src="includes/templates/images/b_cancel.gif" border="0" alt="{#cancel#}"></a>
            {/if}

           {if $action=="delp"}
                <br /><br />
                <b>Delete option value</b> {$inf.val} ?
                                <br /><br />
                <a href="{$curScriptName}?cid={$cid}&id={$inf.id}&action=delp&do=1"><img src="includes/templates/images/b_submit.gif" alt="{#submit#}" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="{$curScriptName}?cid={$cid}"><img src="includes/templates/images/b_cancel.gif" border="0" alt="{#cancel#}"></a>
           {/if}
        </td>

    </tr>
</table>