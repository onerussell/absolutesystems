{strip}
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
<h2>Configuration</h2>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr vAlign="top">
    <td valign="top">
        <!-- main parth-->
{if $siteSelect!='%admin%'}
<b>Site:</b><br /><br />

<select name="selSite" style="width:362px;height:18px;font-size:10px;background-COLOR: steelblue;" onChange="self.location='{$curScriptName}?site=' + this.options[this.selectedIndex].value+'{$SIDA}'">
<option value="">{$C_DOMEN}</option>
{section name=iisite loop=$allSites}
<option value="{$allSites[iisite].IDSITE}" {if $site==$allSites[iisite].IDSITE}selected="selected"{/if}>{$allSites[iisite].name}</option>
{/section}
</select>
<br />
<br />
{/if}

{if $group==''}
<table width="100%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF" >
  <tr bgcolor="#DDDEDF">
    <td align="center" width="25">&nbsp;</td>   
    <td align="center" height="20" width="250"><b>Name</b></td>
    <td align="center"><b>Filename</b></td>
    <td align="center" colSpan="2" width="70">&nbsp;<b>Action</b>&nbsp;</td>
   </tr>

{section name=i loop=$gar}
  <tr bgColor="#ECEEF1">
    <td align="center" width="25"><a href="configure.php?site={$site}&group={$gar[i].id}"><img src="{$siteAdmin}templates/images/folder.gif" border="0" /></a></td>    
    <td align="center" height="20" width="250"><a href="configure.php?site={$site}&group={$gar[i].id}">{$gar[i].name}</a></td>
    <td align="center">{$gar[i].fname}</td>
    <td align="center" width="35"><a href="configure.php?site={$site}&action=editgroup&group={$gar[i].id}"><img src="{$siteAdmin}templates/images/b_edit.png" border="0" width="16" height="16"/></a></td><td align="center" width="35"><a href="configure.php?site={$site}&action=delgroup&group={$gar[i].id}"><img src="{$siteAdmin}templates/images/b_drop.png" border="0" width="16" height="16"/></a></td>
   </tr>
{/section}
</table>
{else}
<b>{$name_} > {$fname}</b><br /><br />
<a href="configure.php?site={$site}"><img src="{$siteAdmin}templates/images/b_up.gif" border="0" /></a><br />
{/if}

<br />  
<table width="100%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF">
  <tr bgcolor="#DDDEDF">
    <td align="center" width="25">&nbsp;</td>   
    <td align="center" height="20" width="250"><b>Description [constant]</b></td>
    <td align="center"><b>Value</b></td>
    <td align="center" colSpan="2" width="70">&nbsp;<b>Actions</b>&nbsp;</td>
   </tr>

{section name=i loop=$show_ar}
   <tr bgColor="#ECEEF1">
    <td align="center">{$show_ar[i].sortid}</td>
    <td align="left" height="18"><a href="configure.php?site={$site}&action=edit&ocid={$show_ar[i].ocid}{if $group<>''}&group={$group}{/if}" title="{$show_ar[i].var}">{$show_ar[i].name}</a></td>
    <td align="left">&nbsp;{$show_ar[i].val}</td>
    <td align="center" width="35"><a href="configure.php?site={$site}&action=edit&ocid={$show_ar[i].ocid}{if $group<>''}&group={$group}{/if}"><img src="{$siteAdmin}templates/images/b_edit.png" border="0" width="16" height="16" title="Change" /></a></td><td align="center" width="35"><a href="configure.php?site={$site}&action=del&ocid={$show_ar[i].ocid}{if $group<>''}&group={$group}{/if}"><img src="{$siteAdmin}templates/images/b_drop.png" border="0" width="16" height="16" title="Delete" /></a></td>
   </tr>
  {/section}    
</table>


      <!-- end main parth-->    

    
    </td>
    <td width="10" valign="top"><img width="10" height="0" />
    </td>
    <td width="250" valign="top">
<br />
{if $action=='editgroup'}
<b>Action: {if $group<>''}Edit{else}Add{/if} group </b> 
    <form name="formopt" action="configure.php?site={$site}&action=editgroup&do=1{if $group<>''}&group={$group}{/if}" method="post">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td>Name:&nbsp;</td>
          <td><input name="name" type="text" value="{$name}" style="width:140;font-size:9px" /></td>    
          </tr>
          <tr><td height="4" colspan="2"></td></tr>
          <tr>
          <td>Filename:&nbsp;</td>
          <td><input name="fname" type="text" value="{if !$fname}def{else}{$fname}{/if}" style="width:140;font-size:9px" /></td>  
          </tr>
          <tr><td height="4" colspan="2"></td></tr>
</table>
<table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr valign="top">
    <td><input type="submit" value="Submit" style="width:95px;height:19px;font-size:12px" />&nbsp;&nbsp;</td>
    <td><img width="20" height="0" border="0" /><a href="configure.php?site={$site}&{if $group<>''}&group={$group}{/if}"><img src="{$siteAdmin}templates/images/b_cancel.gif" border="0" alt="Cancel" /></a></td>
  </tr>
</table>
            
      </form>           

{elseif $action=='edit'}
    <b>Action: {if $ocid<>''}Edit{else}Add{/if} parameter </b>  
        <form name="formopt" action="configure.php?site={$site}&action=edit&do=1{if $ocid<>''}&ocid={$ocid}{/if}{if $group<>''}&group={$group}{/if}" method="post">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
          <td>Description:&nbsp;</td>
          <td><input name="name" type="text" value='{$info.name}' style="width:140;font-size:9px" /></td>    
          </tr>
          <tr><td height="4" colspan="2"></td></tr>
          <tr>
          <td>Constant:&nbsp;</td>
          <td><input name="var" type="text" value="{$info.var}" style="width:140;font-size:9px" /></td>  
          </tr>
          <tr><td height="4" colspan="2"></td></tr>
          <tr>
          <td>Sorting order:&nbsp;</td>
          <td><input name="sortid" type="text" value="{$info.sortid}" style="width:140;font-size:9px" /></td>    
          </tr>
          <tr><td height="4" colspan="2"></td></tr>
          <tr>
          <td>Group:&nbsp;</td>
          <td>
            <select name="groupf" style="height:20px;width:150px;font-size:10px">
            <option value="-1">No</option>
            {section name=i loop=$gar}
            <option value="{$gar[i].id}" {if $group==$gar[i].id}selected{/if}>{$gar[i].name}&nbsp;[{$gar[i].fname}]</option>
            {/section}      
            </select>
            </td>   
          </tr>
          <tr><td height="4" colspan="2"></td></tr>

          <!--tr>
          <td colspan="2"><input name="onelang" type="checkbox" value="1" {if $onelang==1}checked{/if} />&nbsp;One value for all languages</td>
          </tr>
          <tr>
          <td colspan="2">(If it is checked - it is necessary to set value only for one language)</td>
          </tr-->
          <tr><td height="4" colspan="2"></td></tr>
          <tr>
          <td>Value:&nbsp;</td>
          <td>
            <textarea name="val" style="font-size:11px " rows="5" cols="20">{$info.val}</textarea>
        </td>   
          </tr>
         <tr><td height="14" colspan="2"></td></tr>
    </table>
<table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr valign="top">
    <td><input type="submit" value="Submit" style="width:95px;height:19px;font-size:12px" />&nbsp;&nbsp;</td>
    <td><img width="20" height="0" border="0" /><a href="configure.php?site={$site}{if $group<>''}&group={$group}{/if}"><img src="{$siteAdmin}templates/images/b_cancel.gif" border="0" alt="Cancel" /></a></td>
  </tr>
</table>
            
      </form>           
</td>
  </tr>
</table>
{elseif $action=="delgroup"}
        Delete group '{$name_}' with all settings?<br /><br />
        <a href="configure.php?site={$site}&group={$group}&action=delgroup&do=1"><img src="{$siteAdmin}templates/images/b_submit.gif" alt="Apply" border="0" /></a><img width="10" height="0" border="0" />&nbsp;<a href="configure.php?site={$site}"><img src="{$siteAdmin}templates/images/b_cancel.gif" border="0" alt="Cancel" /></a>   
{elseif $action=="del"}
        Delete this parameter ?<br /><br />
        <a href="configure.php?site={$site}&ocid={$ocid}&action=del&do=1"><img src="{$siteAdmin}templates/images/b_submit.gif" alt="Apply" border="0" /></a><img width="10" height="0" border="0" />&nbsp;<a href="configure.php?site={$site}"><img src="{$siteAdmin}templates/images/b_cancel.gif" border="0" alt="Cancel" /></a>  
{else}
<div align="center"><a href="configure.php?site={$site}&action=edit{if $group<>''}&group={$group}{/if}"><img src='{$siteAdmin}templates/images/b_addopt.gif' border="0" /></a></div>
{if $group==''}
<div align="center"><br /><a href="configure.php?site={$site}&action=editgroup"><img src='{$siteAdmin}templates/images/b_addgr.gif' border="0" /></a></div>
{else}
<div align="center"><br /><a href="configure.php?site={$site}&action=editgroup&group={$group}"><img src='{$siteAdmin}templates/images/b_edgr.gif' border="0" /></a></div>
{/if}

{/if}   
    </td>
    </tr>   

</table>
{/strip}