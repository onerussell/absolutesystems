{strip}
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td colspan="2" height="3"><img height="3" border="0" /></td>
    </tr>

    <tr>
    <td colspan="2" height="450" align="left" valign="top" width="100%">


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="5"></td></tr>
                <tr>
                    <td>
                             <br />
                             {if $action=='view'&&$what=='list'}
                             <h2>History</h2>
                             <a href="{$curScriptName}?action=delete&what=all&start_date={$start_date}&end_date={$end_date}&pvstart={$pvstart}" onClick="return confirmLink(this, '{#confirm#} clear history?');" ><b>Clear history</b></a><br /><br />
                             <table cellSpacing="2" cellPadding="0" border="0" width="100%" bgcolor="#FFFFFF" >
                             <tr bgcolor="#DDDEDF" align="center" vAlign="middle" height="20">
                                <td>&nbsp;<b>Date</b>&nbsp;</td>
                                <td>&nbsp;<b>Action type</b>&nbsp;</td>
                                <td>&nbsp;<b>What</b>&nbsp;</td>
                                <td>&nbsp;<b>User</b>&nbsp;</td>
                                <td>&nbsp;<b>IP</b>&nbsp;</td>
                                <td><b>&nbsp;Actions&nbsp;</b></td>
                             </tr>
                             {section name=iif loop=$HA}
                             <tr align="center" vAlign="middle" height="35" bgColor="#ECEEF1">
                                 <td>&nbsp;{$HA[iif].date_f}&nbsp;</td>
                                 <td>&nbsp;{$HA[iif].action}&nbsp;</td>
                                 <td>&nbsp;{$HA[iif].what}&nbsp;</td>
                                 <td>&nbsp;<b>{$HA[iif].login}</b>&nbsp;</td>
                                 <td>&nbsp;{$HA[iif].ip}&nbsp;</td>
                                 <td width="70"><a href="{$curScriptName}?action=delete&what=record&id={$HA[iif].id}&start_date={$start_date}&end_date={$end_date}&pvstart={$pvstart}" onClick="return confirmLink(this, '{#confirm#} delete this record?');" ><img alt="Delete" src="{$siteAdmin}templates/images/b_drop.png" border="0" width="16" height="16" /></a></td>
                             </tr>
                             {/section}
                             {if $pages>1}
                 <tr>
                    <td colSpan="8" align="right">{if $curPage>0}<a href="{$curScriptName}?action=view&what=list&start_date={$start_date}&end_date={$end_date}&pvstart={$pvstart-$ResOnPage}">&lt;&lt;&lt;</a>{/if}&nbsp;
            Page <select name="pvstart" style="font-size:8.5px" onChange="self.location='{$curScriptName}?action=view&what=list&start_date={$start_date}&end_date={$end_date}&pvstart='+ this.options[this.selectedIndex].value">
            {section name=pg loop=$pgArr}
            <option value="{$pgArr[pg]}" {if $pgArr[pg]==$pvstart}selected="selected"{/if}>{$smarty.section.pg.rownum}</option>
            {/section}
            </select> from {$pages}

{if $curPage<$pages-1}&nbsp;<a href="{$curScriptName}?action=view&what=list&start_date={$start_date}&end_date={$end_date}&pvstart={$pvstart+$ResOnPage}">&gt;&gt;&gt;</a>{/if}</td>
       </tr>
{/if}
                             </table>
                             {/if}
                    </td>
                </tr>
        </table>

    </td>
    <td width="250"></td>
  </tr>
</table>

    </td>
    </tr>   

</table>
{/strip}