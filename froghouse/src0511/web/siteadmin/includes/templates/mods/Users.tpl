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
                             {if $action == 'view' && $what == 'list'}
                             
                             <h2>{#ModuleName#}</h2>
                             {if $UserLastError != ''}<p>&#8226;&nbsp;<b><i><font color="red">{$UserLastError}</font></i></b></p>{/if}

                             <a href="{$curScriptName}?action=add&what=user&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&pvstart={$pvstart}&status_sel={$status_sel}"><img border="0" src="{$siteAdmin}templates/images/12.gif" alt="" width="10" height="10" />&nbsp;{#AddSpec#}</a><br /><br />

                             View as <select name="type_sel" style="font-size:10px" onChange="self.location='{$curScriptName}?action=view&what=list&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&iso2_cntr={$iso2_cntr}&pvstart=0&type='+ this.options[this.selectedIndex].value">
                             <option value="catalog" {if "catalog" == $type}selected="selected"{/if} >catalog</option>
                             <option value="list" {if "list" == $type}selected="selected"{/if} >full list</option>
                             </select>&nbsp;
                             and filter by status <select name="status_sel" style="font-size:10px" onChange="self.location='{$curScriptName}?action=view&what=list&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&iso2_cntr={$iso2_cntr}&pvstart=0&type={$type}&status_sel='+ this.options[this.selectedIndex].value">
                             <option value="-1" {if -1 == $status_sel}selected="selected"{/if} >all</option>
                             <option value="1"  {if 1  == $status_sel}selected="selected"{/if} >accepted</option>
                             <option value="0"  {if 0  == $status_sel}selected="selected"{/if} >pending</option>
                             <option value="2"  {if 2  == $status_sel}selected="selected"{/if} >rejected</option>
                             <option value="3"  {if 3  == $status_sel}selected="selected"{/if} >suspended</option>
                             </select>
                             <hr color="#80BFFF" size="1" />

                             {if $type == 'list' || ($type == 'catalog' && $city_id > 0) }
                             {if $city_id > 0 && $type == 'catalog'}
                             <a href="{$curScriptName}?action=view&what=list&ordercol={$ordercol}&orderdesc={$orderdesc}&type=catalog&pvstart={$pvstart}&status_sel={$status_sel}">{#Countries#}</a>&nbsp;<img src="{$siteAdmin}templates/images/path.gif" border="0" width="5" height="9" alt="" />&nbsp;<a href="{$curScriptName}?action=view&what=list&ordercol={$ordercol}&orderdesc={$orderdesc}&iso2_cntr={$cycrNames.iso2}&type=catalog&pvstart={$pvstart}&status_sel={$status_sel}">{$cycrNames.country_name}</a>&nbsp;<img src="{$siteAdmin}templates/images/path.gif" border="0" width="5" height="9" alt="" />&nbsp;<b>{$cycrNames.city_name}</b><br /><br />
                             {/if}
                             <table cellSpacing="2" cellPadding="0" border="0" width="100%" bgcolor="#FFFFFF">
                             <tr bgcolor="#DDDEDF" align="center" vAlign="middle" height="20">
                                <td colSpan="2">&nbsp;<b><a href="{$curScriptName}?action=view&what=list&pvstart={$pvstart}&status_sel={$status_sel}&ordercol=email&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&orderdesc={if $ordercol=='email'&&$orderdesc=='asc'}desc{else}asc{/if}">{#EMail#}</a>{if $ordercol=='email'}&nbsp;<img src="{$siteAdmin}templates/images/s_{$orderdesc}.png" width="11" height="9" alt="" />{/if}</b>&nbsp;</td>
                                <td>&nbsp;<b><a href="{$curScriptName}?action=view&what=list&pvstart={$pvstart}&status_sel={$status_sel}&ordercol=nickname&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&orderdesc={if $ordercol=='nickname'&&$orderdesc=='asc'}desc{else}asc{/if}">{#NickName#}</a>{if $ordercol=='nickname'}&nbsp;<img src="{$siteAdmin}templates/images/s_{$orderdesc}.png" width="11" height="9" alt="" />{/if}</b>&nbsp;</td>
                                <td>&nbsp;<b><a href="{$curScriptName}?action=view&what=list&pvstart={$pvstart}&status_sel={$status_sel}&ordercol=name&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&orderdesc={if $ordercol=='name'&&$orderdesc=='asc'}desc{else}asc{/if}">{#Name#}</a>{if $ordercol=='name'}&nbsp;<img src="{$siteAdmin}templates/images/s_{$orderdesc}.png" width="11" height="9" alt="" />{/if}</b>&nbsp;</td>
                                <td width="90"><b>&nbsp;<a href="{$curScriptName}?action=view&what=list&pvstart={$pvstart}&status_sel={$status_sel}&ordercol=onmain&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&orderdesc={if $ordercol=='onmain'&&$orderdesc=='asc'}desc{else}asc{/if}">On main page</a>{if $ordercol=='onmain'}&nbsp;<img src="{$siteAdmin}templates/images/s_{$orderdesc}.png" width="11" height="9" alt="" />{/if}</b>&nbsp;</td>
                                <td width="90"><b>&nbsp;<a href="{$curScriptName}?action=view&what=list&pvstart={$pvstart}&status_sel={$status_sel}&ordercol=status&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&orderdesc={if $ordercol=='status'&&$orderdesc=='asc'}desc{else}asc{/if}">{#Status#}</a>{if $ordercol=='status'}&nbsp;<img src="{$siteAdmin}templates/images/s_{$orderdesc}.png" width="11" height="9" alt="" />{/if}</b>&nbsp;</td>
                                <td colSpan="2"><b>&nbsp;{#Manage#}&nbsp;</b></td>
                             </tr>
                             {section name=iif loop=$UA}
                             <tr align="center" vAlign="middle" bgColor="#ECEEF1">
                                 <td width="20"><img src="{$siteAdmin}templates/images/b_usradd.png" alt="" width="16" height="16" border="0" /></td>
                                 <td>&nbsp;<b><a href="mailto:{$UA[iif].email}">{$UA[iif].email}</a></b>&nbsp;</td>
                                 <td>&nbsp;{$UA[iif].nickname}&nbsp;</td>
                                 <td>&nbsp;{$UA[iif].mname}{if $UA[iif].fname} {$UA[iif].fname}{/if}&nbsp;</td>
                                 <td>&nbsp;{if $UA[iif].onmain}Yes{else}No{/if}&nbsp;</td>
                                 <td>
                                    <select name="status" style="font-size:10px" onChange="self.location='{$curScriptName}?action=change&what=status&uid={$UA[iif].uid}&pvstart={$pvstart}&status_sel={$status_sel}&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&status='+ this.options[this.selectedIndex].value">
                                     <option value="1"  {if 1  == $UA[iif].status}selected="selected"{/if} >accepted</option>
                                     <option value="0"  {if 0  == $UA[iif].status}selected="selected"{/if} >pending</option>
                                     <option value="2"  {if 2  == $UA[iif].status}selected="selected"{/if} >rejected</option>
                                     <option value="3"  {if 3  == $UA[iif].status}selected="selected"{/if} >suspended</option>
                                     </select>
                                 </td>

                                 <td width="30"><a href="{$curScriptName}?action=change&what=user&uid={$UA[iif].uid}&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&pvstart={$pvstart}&status_sel={$status_sel}" title="{#edit#}"><img src="{$siteAdmin}templates/images/b_edit.png" border="0" width="16" height="16" /></a></td>
                                 <td width="30"><a href="{$curScriptName}?action=delete&what=user&uid={$UA[iif].uid}&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&pvstart={$pvstart}&status_sel={$status_sel}" onClick="return confirmLink(this, '{#confirm#} {#DeleteSpec#}?');" title="{#delete#}" ><img src="{$siteAdmin}templates/images/b_drop.png" border="0" width="16" height="16" /></a></td>
                             </tr>
                             {/section}
                             {elseif $type == 'catalog'}
                             {if $iso2_cntr != ''}
                             <a href="{$curScriptName}?action=view&what=list&ordercol={$ordercol}&orderdesc={$orderdesc}&type=catalog&pvstart={$pvstart}&status_sel={$status_sel}">{#Countries#}</a>&nbsp;<img src="{$siteAdmin}templates/images/path.gif" border="0" width="5" height="9" alt="" />&nbsp;<b>{$countryName}</b><br ><br />
                             <table cellSpacing="1" cellPadding="0" border="0" >
                             {section name=iic loop=$cities}
                             <tr align="left" vAlign="middle">
                                 <td width="20"><img src="{$siteAdmin}templates/images/industry.png" alt="" width="16" height="16" border="0" /></td>
                                 <td>&nbsp;<a href="{$curScriptName}?action=view&what=list&ordercol={$ordercol}&orderdesc={$orderdesc}&type=catalog&pvstart={$pvstart}&status_sel={$status_sel}&iso2_cntr={$iso2_cntr}&city_id={$cities[iic].city_id}"><b>{$cities[iic].name}</b></a>&nbsp;</td>
                             </tr>
                             {/section}
                             {else}
                             <b>Countries</b><br /><br />
                             <table cellSpacing="1" cellPadding="0" border="0" >
                             {section name=iic loop=$countries}
                             <tr align="left" vAlign="middle">
                                 <td width="20"><img src="{$siteAdmin}templates/images/world.gif" alt="" width="16" height="16" border="0" /></td>
                                 <td>&nbsp;<a href="{$curScriptName}?action=view&what=list&ordercol={$ordercol}&status_sel={$status_sel}&orderdesc={$orderdesc}&type=catalog&pvstart={$pvstart}&status_sel={$status_sel}&iso2_cntr={$countries[iic].iso2}"><b>{$countries[iic].name}</b></a>&nbsp;</td>
                             </tr>
                             {/section}
                             {/if}
                             {/if}
                             {if $pages > 1}
                 <tr bgcolor="#FFFFFF"><td colSpan="8" align="right">&nbsp;</td></tr>
                 <tr bgcolor="#FFFFFF">
                    <td colSpan="8" align="right">{if $curPage>0}<a href="{$curScriptName}?action=view&what=list&status_sel={$status_sel}&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&pvstart={$pvstart-$ResOnPage}">&lt;&lt;&lt;</a>{/if}&nbsp;
            {#Page#} <select name="pvstart" style="font-size:8.5px" onChange="self.location='{$curScriptName}?action=view&what=list&status_sel={$status_sel}&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&pvstart='+ this.options[this.selectedIndex].value">
            {section name=pg loop=$pgArr}
            <option value="{$pgArr[pg]}" {if $pgArr[pg]==$pvstart}selected="selected"{/if}>{$smarty.section.pg.rownum}</option>
            {/section}
            </select> {#from#} {$pages}

{if $curPage < $pages-1}&nbsp;<a href="{$curScriptName}?action=view&what=list&status_sel={$status_sel}&ordercol={$ordercol}&orderdesc={$orderdesc}&city_id={$city_id}&type={$type}&iso2_cntr={$iso2_cntr}&pvstart={$pvstart+$ResOnPage}">&gt;&gt;&gt;</a>{/if}</td>
       </tr>
{/if}
                             </table>
                             {elseif ($action=='add'||$action=='change')&&$what=='user'}
                             <script language="JavaScript" src="{$siteAdmin}templates/js/SubSys.js"></script> 
                             <script type="text/javascript" language="JavaScript">
                             <!--
                             {literal}

                             function doLoad(field_type, city_id) 
                             { 
                                 var iso2_cntr = '' + document.getElementById('iso2_cntr_sel').value; 
                                 var req = new Subsys_JsHttpRequest_Js(); 
                                 req.onreadystatechange = function() 
                                 { 
                                     if (req.readyState == 4)
                                     { 
                                         document.getElementById('cities_list').innerHTML = req.responseText; 
                                     } 
                                 } 
                                 var field = 'abroad_city_id';
                                 req.caching = true; 
                                 req.open('POST', 'cities_ajax.php', true); 
                                 req.send({ iso2_cntr: iso2_cntr, field: field, city_id: city_id}); 
                             } 
                             {/literal}
                             // -->
                             </script>
                             <h2>{#ModuleName#} | {if $action=='add'}{#add#}{elseif $action=='change'}{#edit#}{/if}</h2>
                             {if $UserLastError != ''}<p><b><i><font color="red">{$UserLastError}</font></i></b></p>{/if}
                             <form action="{$curScriptName}" method="post" name="{if $action=='add'}AddUserForm{elseif $action=='change'}ChangeUserForm{/if}" enctype="application/x-www-form-urlencoded" >
                             <input type="hidden" name="do"  value="1" />

                             {if !empty($UserInfo.uid)}
                             <input type="hidden" name="uid"       value="{$UserInfo.uid}" />
                             {/if}
                             <input type="hidden" name="action"    value="{$action}"       />
                             <input type="hidden" name="what"      value="{$what}"         />
                             <input type="hidden" name="ordercol"  value="{$ordercol}"     />
                             <input type="hidden" name="orderdesc" value="{$orderdesc}"    />
                             <input type="hidden" name="pvstart"   value="{$pvstart}"      />
                             <input type="hidden" name="type"      value="{$type}"         />
                             <input type="hidden" name="status_sel" value="{$status_sel}"    />
                             <input type="hidden" name="iso2_cntr" value="{$iso2_cntr}"    />
                             <input type="hidden" name="city_id"   value="{$city_id}"    />
                             <input type="hidden" name="type"      value="{$type}"         />
                             <input type="hidden" name="pvstart"   value="{$pvstart}"      />
                             <table height="50%" cellSpacing="2" cellPadding="2" border="0">
                             <tr align="left" vAlign="middle"> <td>On main page</td> <td><input {if $UserInfo.onmain}checked="checked"{/if} type="checkbox" value="1" name="UserInfo[onmain]" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td colSpan="2">&nbsp;</td> </tr>

                             <tr align="left" vAlign="middle"> <td><b>*</b> {#EMail#}</td>     <td> <input type="text"     name="UserInfo[email]" value="{$UserInfo.email}" maxlength="96" style="font-size:12px;width:150px;" onKeyPress="filter(event,2,'@.-_0123456789',1)" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td><b>*</b> {#Password#}</td>  <td> <input type="password" name="UserInfo[pass]"  value=""                  maxlength="21" style="font-size:12px;width:150px;" onKeyPress="filter(event,3,'_-',1)" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td><b>*</b> {#PassRetry#}</td> <td> <input type="password" name="UserInfo[pass2]" value=""                  maxlength="21" style="font-size:12px;width:150px;" onKeyPress="filter(event,3,'_-',1)" /> </td> </tr>
                             {if $action == 'change'}
                             <tr align="left" vAlign="middle"> <td colSpan="2"><i>{#PassSpec#}</i><br /><br /></td> </tr>
                             {/if}
                             <tr align="left" vAlign="middle"> <td><b>*</b> {#Status#}</td> 
                                                               <td> 
                                     <select name="UserInfo[status]" style="font-size:10px" >
                                      <option value="1"  {if 1  == $UserInfo.status}selected="selected"{/if} >accepted</option>
                                      <option value="0"  {if 0  == $UserInfo.status}selected="selected"{/if} >pending</option>
                                      <option value="2"  {if 2  == $UserInfo.status}selected="selected"{/if} >rejected</option>
                                      <option value="3"  {if 3  == $UserInfo.status}selected="selected"{/if} >suspended</option>
                                     </select>
                                                               
                                                               </td> </tr>
                             <tr align="left" vAlign="middle"> <td>&nbsp;</td> </tr>
                             <tr align="left" vAlign="middle"> 
                                   <td><b>*</b> {#Country#}</td>  
                                   <td> 
                                       <select id="iso2_cntr_sel" name="UserInfo[iso2_cntr]"  style="font-size:12px;width:150px;" onChange="doLoad('','{$UserInfo.abroad_city_id}');" /> 
                                       {section name=iicn loop=$cntr_ar}
                                       <option value="{$cntr_ar[iicn].iso2}" {if $UserInfo.iso2_cntr == $cntr_ar[iicn].iso2}selected="selected"{/if}>{$cntr_ar[iicn].name}</option>
                                       {/section}
                                       </select>
                                   </td>
                             </tr>
                             <tr align="left" vAlign="middle"> <td><b>*</b> {#City#}</td>    <td><div id="cities_list" style="margin:0px; width:150px; height:19px">&nbsp;</div></td> </tr>
                             <tr align="left" vAlign="middle"> <td><b>*</b> Abroad Status</td>     <td><select name="UserInfo[abroad_status]" ><option value="1" {if 1 == $UserInfo.abroad_status}selected="selected"{/if}>Education</option><option value="2" {if 2 == $UserInfo.abroad_status}selected="selected"{/if}>Travel</option><option value="3"  {if 3 == $UserInfo.abroad_status}selected="selected"{/if}>Friends</option><option value="4" {if 4 == $UserInfo.abroad_status}selected="selected"{/if}>Other</option></select></td> </tr>

                             <tr align="left" vAlign="middle"> <td><b>*</b> NickName</td>     <td> <input type="text" name="UserInfo[nickname]"    value="{$UserInfo.nickname}"     maxlength="30"  style="font-size:12px;width:150px;" onKeyPress="filter(event,2,'01234567890_-',1)" /> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>Birthday</td>  <td>{html_select_date start_year=1900 field_order="DMY" time=$UserInfo.birthday  field_separator=" " field_array='UserInfo[birthday]' prefix='' }  </td> </tr>

                             {*<tr align="left" vAlign="middle"> <td>{#LName#}</td>  <td> <input type="text" name="UserInfo[lname]" value="{$UserInfo.lname}" maxlength="50" style="font-size:12px;width:150px;" /> </td> </tr>*}
                             <tr align="left" vAlign="middle"> <td>{#FName#}</td>  <td> <input type="text" name="UserInfo[fname]" value="{$UserInfo.fname}" maxlength="25" style="font-size:12px;width:150px;" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td>{#MName#}</td>  <td> <input type="text" name="UserInfo[mname]" value="{$UserInfo.mname}" maxlength="25" style="font-size:12px;width:150px;" /> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>Originally from</td>  <td> <input type="text" name="UserInfo[originally_from]"    value="{$UserInfo.originally_from}"     maxlength="100"  style="font-size:12px;width:150px;" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td>Here for</td>     <td><select name="UserInfo[here_for]" ><option value="1" {if 1 == $UserInfo.here_for}selected="selected"{/if}>1</option><option value="2" {if 2 == $UserInfo.here_for}selected="selected"{/if}>2</option><option value="3"  {if 3 == $UserInfo.here_for}selected="selected"{/if}>3</option></select></td> </tr>
                             <tr align="left" vAlign="middle"> <td>Home university</td>  <td> <input type="text" name="UserInfo[uni_home]"    value="{$UserInfo.uni_home}"     maxlength="100"  style="font-size:12px;width:150px;" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td>Host univercity</td>  <td> <input type="text" name="UserInfo[uni_host]"    value="{$UserInfo.uni_host}"     maxlength="100"  style="font-size:12px;width:150px;" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td>Languages</td>  <td> <input type="text"       name="UserInfo[languages]"    value="{$UserInfo.languages}"     maxlength="100"  style="font-size:12px;width:150px;" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td>Cities visited</td>  <td> <input type="text" name="UserInfo[visited_cities]"    value="{$UserInfo.visited_cities}"     maxlength="255"  style="font-size:12px;width:150px;" /> </td> </tr>
                             <tr align="left" vAlign="middle"> <td>Places I'd like to visit</td>  <td> <input type="text" name="UserInfo[like_visit]"    value="{$UserInfo.like_visit}"     maxlength="255"  style="font-size:12px;width:150px;" /> </td> </tr>

                             <tr align="left" vAlign="middle">
                                <td>Relationship status</td> 
                                <td>
                                     <select name="UserInfo[relation_status]" >
                                       {foreach key=key item=item from=$UserOptions[2].vals}
                                        <option value="{$key}" {if $key == $UserInfo.relation_status}selected="selected"{/if}>{$item}</option>
                                       {/foreach}
                                     </select>
                                </td>
                             </tr>

                             <tr align="left" vAlign="middle"> 
                                <td>Sexual Orientation</td> 
                                <td>
                                     <select name="UserInfo[sexual_orientation]" >
                                        {foreach key=key item=item from=$UserOptions[3].vals}
                                         <option value="{$key}" {if $key == $UserInfo.sexual_orientation}selected="selected"{/if}>{$item}</option>
                                        {/foreach}
                                     </select>
                                </td> 
                              </tr>
  
                             <tr align="left" vAlign="middle"> <td>Turn Ons</td> <td><textarea name="UserInfo[turn_ons]" style="width:200px; font-size:12px">{$UserInfo.turn_ons}</textarea> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>Turn Offs</td> <td><textarea name="UserInfo[turn_offs]" style="width:200px; font-size:12px">{$UserInfo.turn_offs}</textarea> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>Interested In</td> <td><textarea name="UserInfo[interested_in]" style="width:200px; font-size:12px">{$UserInfo.interested_in}</textarea> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>Quote</td> <td><textarea name="UserInfo[quote]" style="width:200px; font-size:12px">{$UserInfo.quote}</textarea> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>About me</td> <td><textarea name="UserInfo[about_me]" style="width:200px; font-size:12px">{$UserInfo.about_me}</textarea> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>Best Travel Story</td> <td><textarea name="UserInfo[best_travel_story]" style="width:200px; font-size:12px">{$UserInfo.best_travel_story}</textarea> </td> </tr>

                             <tr align="left" vAlign="middle"> <td>Travel Advice</td> <td><textarea name="UserInfo[travel_advice]" style="width:200px; font-size:12px">{$UserInfo.travel_advice}</textarea> </td> </tr>

                      
                             <tr align="left" vAlign="middle"> <td colSpan="2"><br /><b>{#ReqFields#}</b><br /></td> </tr>
                             <tr align="left" vAlign="middle"> <td colSpan="2"><input type="submit" value="{#submit#}" style="width:70px;height:19px;font-size:12px;" /> <input type="submit" name="cancel" value="{#cancel#}" style="width:70px;height:19px;font-size:12px;" /></td> </tr>
                             </table>
                             </form>

                             <script type="text/javascript" language="JavaScript">
                             doLoad('','{$UserInfo.abroad_city_id}');
                             </script>
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