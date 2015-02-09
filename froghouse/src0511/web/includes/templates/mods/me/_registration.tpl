
      <script type="text/javascript" language="JavaScript" src="{$siteAdr}includes/templates/js/main.js">
      </script>
    {if !$AuthUser && ($action == 'main' || $action == 'auth')}
        <div class="leftpart">
            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Login
                            <div class="spacer s15"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="rightpart">

        <div class="title-block"><div>Login - Thefroghouse.net is free, but you have to login to see that.</div></div>
          <div class="block">
                <form name="AuthForm" action="{$siteAdr}" method="post" enctype="application/x-www-form-urlencoded">
                <input type="hidden" name="mod" value="registration" />
                <input type="hidden" name="action" value="main" />
                <input type="hidden" name="redirectLocation" value="{$redirectLocation|escape:"quotes"}" />

                <div class="pad">
                    <div class="form">
                    <div class="pad">
                    {if $UserLastError != ''}
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;<b><i><font color="red">{$UserLastError}</font></i></b></div>
                        <div class="spacer s9"><!-- --></div>
                    {/if}
                        <div class="spacer"><!-- --></div>
                        <div class="name"><div>Email:</div></div>
                        <div class="inp">
                            <input type="text" name="UserInfo[email]" maxlength="96" class="w192" id="login" value="{$custom_email}" onKeyPress="filter(event,2,'@.-_0123456789',1)" />
                        </div>
                        <div class="spacer s9"><!-- --></div>
                        <div class="name"><div>Password:</div></div>
                        <div class="inp">
                            <input type="password" name="UserInfo[pass]" maxlength="21" class="w192" id="pass" />
                        </div>
                        <div class="spacer s9"><!-- --></div>
                        <div><a href="{$siteAdr}?mod=registration&amp;action=restore_password" class="gr">Forgot your password ?</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteAdr}?mod=registration&amp;action=reg"><b>New User ? Register here !</b></a></div>
                    </div>
                    </div>
            
                    <div class="spacer s9"><!-- --></div>
                    <div class="link link-left"><a href="javascript:document.AuthForm.submit();" ><b>Login</b></a></div>
                </div>
               </form>
            </div>
      </div>

            {elseif $action == 'view'}
    <div class="maincontainer">

    {include file="mods/me/_left_menu.tpl"}

        <div class="rightpart">

            <div class="title-block"><div>{if !$whom}My{else}{$UserInfo.nickname|capitalize}{/if} Profile</div></div>
            <div class="block">
                <div class="pad">

                    <div>

                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="100%" height="400">
                          <param name="movie" value="{$siteAdr}includes/templates/swf/e37zoom.swf?server=imageLoader.php&amp;thumbnail=70,60&amp;images={$UserInfo.photos_list}&amp;bgcolor=FFFFFF&amp;control=6&amp;preview=2&amp;rgb=18,156,53" />
                          <param name="quality" value="high" />
                          <param name="bgcolor" value="#FFFFFF" />
                          <param name="scale" value="noscale" />
                          <param name="salign" value="lt" />
                          <embed src="{$siteAdr}includes/templates/swf/e37zoom.swf?server=imageLoader.php&amp;thumbnail=70,60&amp;images={$UserInfo.photos_list}&amp;bgcolor=FFFFFF&amp;control=6&amp;preview=2&amp;rgb=18,156,53" bgcolor="#FFFFFF" scale="noscale" salign="lt" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="400" />
                        </object>
                            
                    </div>


                    <div class="spacer s9"><!-- --></div>

                    <div class="profile-info">
                        <div class="pad">
                            {if $UserInfo.quote}<b>"{$UserInfo.quote}"</b>{/if}<p><b>{$UserInfo.age} years, currently abroad, {$UserInfo.city_name} ({$UserInfo.country_name})</b>
                            {if $UserInfo.about_me}<p><br><span>About Me:</span> {$UserInfo.about_me}{/if}
                            {if $UserInfo.best_travel_story}<p><br><span>Best Travel Story:</span> {$UserInfo.best_travel_story}{/if}
                            {if $UserInfo.originally_from}<p><br><span>Originally from:</span> {$UserInfo.originally_from}{/if}
                            {if $UserInfo.here_for}<p><span>Here for:</span> {$UserInfo.here_for}{/if}
                            {if $UserInfo.uni_host}<p><span>Host University:</span> {$UserInfo.uni_host}{/if}
                            {if $UserInfo.uni_home}<p><span>Home University:</span> {$UserInfo.uni_home}{/if}
                            {if $UserInfo.languages}<p><span>Languages:</span> {$UserInfo.languages}{/if}
                            {if $UserInfo.travel_advice}<p><span>Travel Advice:</span> {$UserInfo.travel_advice}{/if}
                            {if $UserInfo.birthday}<p><span>Birthday:</span> {$UserInfo.birthday|date_format:"%d %B %Y"}{/if}
                            {if $UserInfo.visited_cities}<p><span>Cities Visited:</span> {$UserInfo.visited_cities}{/if}
                            {if $UserInfo.like_visit}<p><span>Places I'd Like to Visit:</span> {$UserInfo.like_visit}{/if}
                            <p><span>Relationship Status:</span> {$UserInfo.relation_status}
                            <p><span>Sexual Orientation:</span> {$UserInfo.sexual_orientation}
                            {if $UserInfo.turn_ons}<p><span>Turn Ons:</span> {$UserInfo.turn_ons}{/if}
                            {if $UserInfo.turn_offs}<p><span>Turn Offs:</span> {$UserInfo.turn_offs}{/if}
                            {if $UserInfo.interested_in}<p><span>Intersted In:</span> {$UserInfo.interested_in}{/if}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

            {elseif $action == 'change'}
    <div class="maincontainer">
        <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            {if $what == 'profile'}
                            <li class="on"><span class="profile"><a>Edit My Profile</a></span>
                            <li><span class="photos">            <a href="{$siteAdr}?mod=registration&amp;action=change&amp;what=photos">Upload Photos</a></span>
                            {elseif $what == 'photos' }
                            <li><span class="profile"><a href="{$siteAdr}?mod=registration&amp;action=change&amp;what=profile">Edit My Profile</a></span>
                            <li class="on"><span class="photos"> <a>Upload Photos</a></span>
                            {/if}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

            {if 'profile' == $what}

        <div class="rightpart">

              <script type="text/javascript" language="JavaScript" src="{$siteAdr}includes/templates/js/SubSys.js"></script> 
              <script type="text/javascript" language="JavaScript">
                  <!--
                  {literal}

                  function doLoad(field_type, city_idx) 
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
                      req.open('POST', 'index.php?mod=registration&action=cities_ajax', true); 
                      req.send({ iso2_cntr: iso2_cntr, field: field, city_idx: city_idx}); 
                  } 
                  {/literal}
                  // -->
              </script>

            <div class="title-block"><div>Edit Your Profile</div></div>
            <div class="block">
{if $UserLastError != ''}<p>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;<b><i><font color="red">{$UserLastError}</font></i></b></p>{/if}

            <form action="{$siteAdr}" method="post" name="{if $action=='reg'}AddUserForm{elseif $action=='change'}ChangeUserForm{/if}" enctype="application/x-www-form-urlencoded" >
            <input type="hidden" name="mod"    value="registration" />
            <input type="hidden" name="action" value="{$action}" />
            <input type="hidden" name="what"   value="{$what}" />
            <input type="hidden" name="do"  value="1" />
                <div class="pad">
                    <div class="reg-name">E-Mail</div>
                    <div class="reg-inp"><input type="text"     name="UserInfo[email]" value="{$UserInfo.email}" maxlength="96" class="w1" onKeyPress="filter(event,2,'@.-_0123456789',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Password</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass]"  value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Confirm</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass2]" value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">NickName</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[nickname]" value="{$UserInfo.nickname}"  onKeyPress="filter(event,2,'-_0123456789',1)" maxlength="50" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Birthday</div>  
                    <div class="reg-inp">{html_select_date start_year=1900 field_order="DMY" time=$UserInfo.birthday  field_separator=" " field_array='UserInfo[birthday]' prefix='' all_extra='style="sw1"' }</div>
                    <div class="spacer s12"><!-- --></div>
                    
                    <div class="reg-name">Abroad Country</div>
                    <div class="reg-inp">
                                       <select id="iso2_cntr_sel" name="UserInfo[iso2_cntr]"  class="sw1" onChange="doLoad('','{$UserInfo.abroad_city_id}');" > 
                                       {section name=iicn loop=$cntr_ar}
                                       <option value="{$cntr_ar[iicn].iso2}" {if $UserInfo.iso2_cntr == $cntr_ar[iicn].iso2}selected="selected"{/if}>{$cntr_ar[iicn].name}</option>
                                       {/section}
                                       </select>
                    </div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-name">Abroad City</div>
                    <div class="reg-inp" id="cities_list"></div>
                    <br />

                    <div class="reg-name">Abroad Status</div>
                    <div class="reg-inp">
                    <select name="UserInfo[abroad_status]" class="sw1">
                    {foreach key=key item=item from=$UserOptions[0].vals}
                        <option value="{$key}" {if $key == $UserInfo.abroad_status}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select>
                    </div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-line"><!-- --></div>
                    <div class="reg-names"><span>These fields are not obligatory, but we recommend filling them:</span></div>
                    <div class="spacer s20"><!-- --></div>

                    {*<div class="reg-name">Last Name</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[lname]" value="{$UserInfo.lname}" maxlength="50" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>*}

                    <div class="reg-name">First Name</div>
                    <div class="reg-inp"> <input type="text" name="UserInfo[fname]" value="{$UserInfo.fname}" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Middle Name</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[mname]" value="{$UserInfo.mname}" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>
                    
                    <div class="reg-name">Originally From</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[originally_from]" value="{$UserInfo.originally_from}"  class="w1" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Here For</div>
                    <div class="reg-inp">
                    <select class="sw1" name="UserInfo[here_for]">
                    {foreach key=key item=item from=$UserOptions[1].vals}
                        <option value="{$key}" {if $key == $UserInfo.here_for}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Home University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_home]" value="{$UserInfo.uni_home}" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Host University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_host]" value="{$UserInfo.uni_host}" maxlength="100"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Languages</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[languages]" value="{$UserInfo.languages}" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Cities Visited</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[visited_cities]"  maxlength="255" value="{$UserInfo.visited_cities}"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Places I'd like to visit</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[like_visit]" maxlength="255" value="{$UserInfo.like_visit}"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Relationship status</div>
                    <div class="reg-inp">
                    <select class="sw2" name="UserInfo[relation_status]" >
                    {foreach key=key item=item from=$UserOptions[2].vals}
                        <option value="{$key}" {if $key == $UserInfo.relation_status}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Sexual Orientation</div>
                    <div class="reg-inp">
                    <select class="sw2" name="UserInfo[sexual_orientation]" >
                    {foreach key=key item=item from=$UserOptions[3].vals}
                        <option value="{$key}" {if $key == $UserInfo.sexual_orientation}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Ons</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_ons]" >{$UserInfo.turn_ons}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Offs</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_offs]" >{$UserInfo.turn_offs}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Interested In</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_interested_in]" >{$UserInfo.turn_interested_in}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-names">Quote <span>(will appear at the top of your profile)</span></div>
                    <div class="spacer"><!-- --></div>
                    <div class="reg-inp" style="text-align: right;"><textarea name="UserInfo[quote]" >{$UserInfo.quote}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">About Me</div>
                    <div class="reg-inp"><textarea name="UserInfo[about_me]" >{$UserInfo.about_me}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Best Travel Story</div>
                    <div class="reg-inp"><textarea name="UserInfo[best_travel_story]" >{$UserInfo.best_travel_story}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Travel Advice</div>
                    <div class="reg-inp"><textarea name="UserInfo[travel_advice]" >{$UserInfo.travel_advice}</textarea></div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="link"><a href="javascript:document.ChangeUserForm.submit();" class="b" >Submit</a></div>
                </div>
              </form>
          </div>

        </div>


                             <script type="text/javascript" language="JavaScript">
                             doLoad('','{$UserInfo.abroad_city_id}');
                             </script>

        <div class="spacer"><!-- --></div>

      </div>

            {elseif 'photos' == $what}
        <div class="rightpart">

            <div class="title-block"><div>Upload Photos</div></div>
            <div class="block">
                <div class="pad">
                    <div class="form">
                          <div class="pad">
                              <b>Currently uploaded: {$photos_cnt} out of 6</b><br>
                              <div class="spacer s9"><!-- --></div>
                             <!--
                              <div>
                                  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="100%" height="400">
                                    <param name="movie" value="{$siteAdr}includes/templates/swf/e37zoom_admin.swf?server=http://www.engine37.com/sandbox/thefroghouse/fileManager.php&amp;thumbnail=70,60&amp;images={$UserInfo.photos_list}&amp;bgcolor=FFFFFF&amp;control=5&amp;preview=1&amp;rgb=18,156,53" />
                                    <param name="quality" value="high" />
                                    <param name="bgcolor" value="#FFFFFF" /> 
                                    <param name="scale" value="noscale" />
                                    <param name="salign" value="lt" />
                                    <embed src="{$siteAdr}includes/templates/swf/e37zoom_admin.swf?server=http://www.engine37.com/sandbox/thefroghouse/fileManager.php&amp;thumbnail=70,60&amp;images={$UserInfo.photos_list}&amp;bgcolor=FFFFFF&amp;control=5&amp;preview=1&amp;rgb=18,156,53" bgcolor="#FFFFFF" scale="noscale" salign="lt" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="400" />
                                  </object>
                              </div>    
                              -->
                              <div class="spacer s9"><!-- --></div>
                          
                              {section name=iiph loop=$photos}
                              <div class="up-ph">
                                  <div class="pic"><a target="_blank" href="{$siteAdr}includes/data/gallery/{$photos[iiph].name}"><img src="{$siteAdr}includes/data/gallery/{$photos[iiph].res_image}" width="110" alt=""></a></div>
                                  <div class="link"><a href="{$siteAdr}?mod=registration&amp;action=change&amp;what=photos&amp;pic_id={$photos[iiph].pic_id}&amp;do=2" class="delete" >Delete</a></div>
                              </div>
                              <div class="spacer s25"><!-- --></div>
                              {/section}
                          
                              <form action="{$siteAdr}" method="post" name="UploadPhotoForm" enctype="multipart/form-data" >
                              <input type="hidden" name="mod"    value="registration" />
                              <input type="hidden" name="action" value="{$action}" />
                              <input type="hidden" name="what"   value="{$what}" />
                              <input type="hidden" name="do"     value="1" />
                          
                              {if $photos_cnt < 6}
                              <b>Upload new photo</b><br>
                              <span class="note">Maximum file size is 5Mb. Our service will automatically create a thumbnail.</span>
                              <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                              <input type="file" name="new_photo" style="width:270px;margin-top:5px;">
                              <p><input type="submit" value="Upload File"><br>
                              {/if}
                              </form>
                          </div>
                    </div>

                </div>
            </div>
         </div>
       </div>
            {/if}

            {elseif $action == 'reg'}
       {if !$step || $step == 1}
       <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li class="on"><span class="profile"><a>Create Profile</a></span>
                            <li><span class="photos"><a>Upload Photos</a></span>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="rightpart">

              <script type="text/javascript" language="JavaScript" src="{$siteAdr}includes/templates/js/SubSys.js"></script> 
              <script type="text/javascript" language="JavaScript">
                  <!--
                  {literal}

                  function doLoad(field_type, city_idx) 
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
                      req.open('POST', 'index.php?mod=registration&action=cities_ajax', true); 
                      req.send({ iso2_cntr: iso2_cntr, field: field, city_idx: city_idx}); 
                  } 
                  {/literal}
                  // -->
              </script>


            <div class="title-block"><div>Create Your Profile</div></div>

            <div class="block">
            <form action="{$siteAdr}" method="post" name="{if $action=='reg'}AddUserForm{elseif $action=='main'}ChangeUserForm{/if}" enctype="application/x-www-form-urlencoded" >
            <input type="hidden" name="mod"    value="registration" />
            <input type="hidden" name="action" value="{$action}" />
            <input type="hidden" name="step"   value="1" />
            <input type="hidden" name="do"  value="1" />
                <div class="pad">
            {if $UserLastError != ''}<p>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;<b><i><font color="red">{$UserLastError}</font></i></b><br /><br /></p>{/if}
                    <div class="reg-name">E-Mail</div>
                    <div class="reg-inp"><input type="text"     name="UserInfo[email]" value="{$UserInfo.email}" maxlength="96" class="w1" onKeyPress="filter(event,2,'@.-_0123456789',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Password</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass]"  value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Confirm</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass2]" value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>


                    <div class="reg-name">NickName</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[nickname]" value="{$UserInfo.nickname}" maxlength="50" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>


                    <div class="reg-name">Birthday</div>  
                    <div class="reg-inp">{html_select_date start_year=1900 field_order="DMY" time=$UserInfo.birthday  field_separator=" " field_array='UserInfo[birthday]' prefix='' all_extra='style="sw1"' }</div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Abroad Country</div>

                    <div class="reg-inp">
                            <select id="iso2_cntr_sel" name="UserInfo[iso2_cntr]"  class="w1" onChange="doLoad('','{$UserInfo.abroad_city_id}');" > 
                            {section name=iicn loop=$cntr_ar}
                            <option value="{$cntr_ar[iicn].iso2}" {if $UserInfo.iso2_cntr == $cntr_ar[iicn].iso2}selected="selected"{/if}>{$cntr_ar[iicn].name}</option>
                            {/section}
                            </select>
                    </div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-name">Abroad City</div>
                    <div class="reg-inp" id="cities_list"><!-- --></div>
                    <br />
                    <div class="reg-name">Abroad Status</div>
                    <div class="reg-inp">
                    <select name="UserInfo[abroad_status]" class="sw1">
                    {foreach key=key item=item from=$UserOptions[0].vals}
                        <option value="{$key}" {if $key == $UserInfo.abroad_status}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select></div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-line"><!-- --></div>
                    <div class="reg-names"><span>These fields are not obligatory, but we recommend filling them:</span></div>
                    <div class="spacer s20"><!-- --></div>

                    {*<div class="reg-name">Last Name</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[lname]" value="{$UserInfo.lname}" maxlength="50" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>*}

                    <div class="reg-name">First Name</div>
                    <div class="reg-inp"> <input type="text" name="UserInfo[fname]" value="{$UserInfo.fname}" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Middle Name</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[mname]" value="{$UserInfo.mname}" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>
                    
                    <div class="reg-name">Originally From</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[originally_from]" value="{$UserInfo.originally_from}"  class="w1" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Here For</div>
                    <div class="reg-inp">
                    <select class="sw1" name="UserInfo[here_for]">
                    {foreach key=key item=item from=$UserOptions[1].vals}
                        <option value="{$key}" {if $key == $UserInfo.here_for}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Home University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_home]" value="{$UserInfo.uni_home}" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Host University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_host]" value="{$UserInfo.uni_host}" maxlength="100"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Languages</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[languages]" value="{$UserInfo.languages}" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Cities Visited</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[visited_cities]"  maxlength="255" value="{$UserInfo.visited_cities}"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Places I'd like to visit</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[like_visit]" maxlength="255" value="{$UserInfo.like_visit}"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Relationship status</div>
                    <div class="reg-inp"><select class="sw2" name="UserInfo[relation_status]" >
                    {foreach key=key item=item from=$UserOptions[2].vals}
                        <option value="{$key}" {if $key == $UserInfo.relation_status}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Sexual Orientation</div>
                    <div class="reg-inp">
                    <select class="sw2" name="UserInfo[sexual_orientation]" >
                    {foreach key=key item=item from=$UserOptions[3].vals}
                        <option value="{$key}" {if $key == $UserInfo.sexual_orientation}selected="selected"{/if}>{$item}</option>
                    {/foreach}
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Ons</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_ons]" >{$UserInfo.turn_ons}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Offs</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_offs]" >{$UserInfo.turn_offs}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Interested In</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_interested_in]" >{$UserInfo.turn_interested_in}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-names">Quote <span>(will appear at the top of your profile)</span></div>
                    <div class="spacer"><!-- --></div>
                    <div class="reg-inp" style="text-align: right;"><textarea name="UserInfo[quote]" >{$UserInfo.quote}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">About Me</div>
                    <div class="reg-inp"><textarea name="UserInfo[about_me]" >{$UserInfo.about_me}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Best Travel Story</div>
                    <div class="reg-inp"><textarea name="UserInfo[best_travel_story]" >{$UserInfo.best_travel_story}</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Travel Advice</div>
                    <div class="reg-inp"><textarea name="UserInfo[travel_advice]" >{$UserInfo.travel_advice}</textarea></div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="link"><a href="javascript:document.AddUserForm.submit();" class="b">Next</a></div>
                  </div>
                  </form>

                </div>
              </div>
                             <script type="text/javascript" language="JavaScript">
                             doLoad('','{$UserInfo.abroad_city_id}');
                             </script>

    <div class="spacer"><!-- --></div>

            {elseif $step == 3}
       <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li ><span class="profile"><a>Create Profile</a></span>
                            <li ><span class="photos"><a>Upload Photos</a></span>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="rightpart">

            <div class="title-block"><div>Successful registration</div></div>
            <div class="block">
            <br />
            &nbsp;&nbsp;&nbsp;<b>Thanks for registering. Your account will be activated within a day.</b>
            <br /><br />
            </div>
        </div>

            {else}
       <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li ><span class="profile"><a>Create Profile</a></span>
                            <li class="on"><span class="photos"><a>Upload Photos</a></span>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="rightpart">

            <div class="title-block"><div>Upload Photos</div></div>
            <div class="block">
            <form action="{$siteAdr}" method="post" name="UploadPhotoForm" enctype="multipart/form-data" >
            <input type="hidden" name="mod"    value="registration" />
            <input type="hidden" name="action" value="{$action}" />
            <input type="hidden" name="step"   value="2" />
            <input type="hidden" name="user_id" value="{$user_id}" />
            <input type="hidden" name="do"     value="1" />
                <div class="pad">
                    <div class="form">
                         <div class="pad">
                             <b>Currently uploaded: {$photos_cnt} out of 6</b><br>
                        
                             <div class="spacer s9"><!-- --></div>
                        
                             {section name=iiph loop=$photos}
                             <div class="up-ph">
                                 <div class="pic"><a target="_blank" href="{$siteAdr}includes/data/gallery/{$photos[iiph].name}"><img src="{$siteAdr}includes/data/gallery/{$photos[iiph].res_image}" width="110" alt=""></a></div>
                                 <div class="link"><a href="{$siteAdr}?mod=registration&amp;action=reg&amp;step=2&amp;user_id={$user_id}&amp;pic_id={$photos[iiph].pic_id}&amp;do=2" class="delete" >Delete</a></div>
                             </div>
                             <div class="spacer s25"><!-- --></div>
                             {/section}
                        
                             {if $photos_cnt < 6}
                             <b>Upload new photo</b><br>
                             <span class="note">Maximum file size is 5Mb. Our service will automatically create a thumbnail.</span>
                             <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                             <input type="file" name="new_photo" style="width:270px;margin-top:5px;">
                             <p><input type="submit" value="Upload File"><br>
                             {/if}
                         </div>
                    </div>

                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="{$siteAdr}?mod=registration&amp;action=reg&amp;step=3">End registration</a></div>
                </div>
                </form>

            </div>
       </div>
            {/if}
            {elseif $action == 'mess'}
            <b>{$Message}</b>
            {elseif $action =='restore_password'}

        <div class="leftpart">
            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Restore password
                            <div class="spacer s15"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="rightpart">

        <div class="title-block"><div>{#RestPass#}</div></div>
          <div class="block">
              <form name="RestorePassForm" action="{$siteAdr}" method="post" enctype="application/x-www-form-urlencoded">
              <input type="hidden" name="do" value="1" />
              <input type="hidden" name="mod" value="registration" />
              <input type="hidden" name="action" value="{$action}" />

                <div class="pad">
                    <div class="form">
                    <div class="pad">
                    {if $UserLastError != ''}
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;<b><i><font color="red">{$UserLastError}</font></i></b></div>
                        <div class="spacer s9"><!-- --></div>
                    {/if}
                        <div class="spacer"><!-- --></div>
                        <div class="name"><div>Your Email:</div></div><div class="inp"><input type="text" name="email" maxlength="40" onKeyPress="filter(event,2,'@.-_0123456789',1)" /></div>
                        <div class="spacer s9"><!-- --></div>
                    </div>
                    </div>
            
                    <div class="spacer s9"><!-- --></div>
                    <div class="link link-left"><a href="javascript:document.RestorePassForm.submit();" ><b>{#send#}</b></a></div>
                </div>
               </form>
            </div>
      </div>
    {/if}
