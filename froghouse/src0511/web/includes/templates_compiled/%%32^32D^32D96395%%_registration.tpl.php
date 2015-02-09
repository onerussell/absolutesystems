<?php /* Smarty version 2.6.12, created on 2006-05-09 12:54:33
         compiled from mods/me/_registration.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mods/me/_registration.tpl', 25, false),array('modifier', 'capitalize', 'mods/me/_registration.tpl', 63, false),array('modifier', 'date_format', 'mods/me/_registration.tpl', 94, false),array('function', 'html_select_date', 'mods/me/_registration.tpl', 186, false),)), $this); ?>

      <script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/js/main.js">
      </script>
    <?php if (! $this->_tpl_vars['AuthUser'] && ( $this->_tpl_vars['action'] == 'main' || $this->_tpl_vars['action'] == 'auth' )): ?>
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
                <form name="AuthForm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" method="post" enctype="application/x-www-form-urlencoded">
                <input type="hidden" name="mod" value="registration" />
                <input type="hidden" name="action" value="main" />
                <input type="hidden" name="redirectLocation" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['redirectLocation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
" />

                <div class="pad">
                    <div class="form">
                    <div class="pad">
                    <?php if ($this->_tpl_vars['UserLastError'] != ''): ?>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;<b><i><font color="red"><?php echo $this->_tpl_vars['UserLastError']; ?>
</font></i></b></div>
                        <div class="spacer s9"><!-- --></div>
                    <?php endif; ?>
                        <div class="spacer"><!-- --></div>
                        <div class="name"><div>Email:</div></div>
                        <div class="inp">
                            <input type="text" name="UserInfo[email]" maxlength="96" class="w192" id="login" value="<?php echo $this->_tpl_vars['custom_email']; ?>
" onKeyPress="filter(event,2,'@.-_0123456789',1)" />
                        </div>
                        <div class="spacer s9"><!-- --></div>
                        <div class="name"><div>Password:</div></div>
                        <div class="inp">
                            <input type="password" name="UserInfo[pass]" maxlength="21" class="w192" id="pass" />
                        </div>
                        <div class="spacer s9"><!-- --></div>
                        <div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=restore_password" class="gr">Forgot your password ?</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=reg"><b>New User ? Register here !</b></a></div>
                    </div>
                    </div>
            
                    <div class="spacer s9"><!-- --></div>
                    <div class="link link-left"><a href="javascript:document.AuthForm.submit();" ><b>Login</b></a></div>
                </div>
               </form>
            </div>
      </div>

            <?php elseif ($this->_tpl_vars['action'] == 'view'): ?>
    <div class="maincontainer">

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/me/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <div class="rightpart">

            <div class="title-block"><div><?php if (! $this->_tpl_vars['whom']): ?>My<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['UserInfo']['nickname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  endif; ?> Profile</div></div>
            <div class="block">
                <div class="pad">

                    <div>

                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="100%" height="400">
                          <param name="movie" value="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/swf/e37zoom.swf?server=imageLoader.php&amp;thumbnail=70,60&amp;images=<?php echo $this->_tpl_vars['UserInfo']['photos_list']; ?>
&amp;bgcolor=FFFFFF&amp;control=6&amp;preview=2&amp;rgb=18,156,53" />
                          <param name="quality" value="high" />
                          <param name="bgcolor" value="#FFFFFF" />
                          <param name="scale" value="noscale" />
                          <param name="salign" value="lt" />
                          <embed src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/swf/e37zoom.swf?server=imageLoader.php&amp;thumbnail=70,60&amp;images=<?php echo $this->_tpl_vars['UserInfo']['photos_list']; ?>
&amp;bgcolor=FFFFFF&amp;control=6&amp;preview=2&amp;rgb=18,156,53" bgcolor="#FFFFFF" scale="noscale" salign="lt" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="400" />
                        </object>
                            
                    </div>


                    <div class="spacer s9"><!-- --></div>

                    <div class="profile-info">
                        <div class="pad">
                            <?php if ($this->_tpl_vars['UserInfo']['quote']): ?><b>"<?php echo $this->_tpl_vars['UserInfo']['quote']; ?>
"</b><?php endif; ?><p><b><?php echo $this->_tpl_vars['UserInfo']['age']; ?>
 years, currently abroad, <?php echo $this->_tpl_vars['UserInfo']['city_name']; ?>
 (<?php echo $this->_tpl_vars['UserInfo']['country_name']; ?>
)</b>
                            <?php if ($this->_tpl_vars['UserInfo']['about_me']): ?><p><br><span>About Me:</span> <?php echo $this->_tpl_vars['UserInfo']['about_me'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['best_travel_story']): ?><p><br><span>Best Travel Story:</span> <?php echo $this->_tpl_vars['UserInfo']['best_travel_story'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['originally_from']): ?><p><br><span>Originally from:</span> <?php echo $this->_tpl_vars['UserInfo']['originally_from'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['here_for']): ?><p><span>Here for:</span> <?php echo $this->_tpl_vars['UserInfo']['here_for'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['uni_host']): ?><p><span>Host University:</span> <?php echo $this->_tpl_vars['UserInfo']['uni_host'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['uni_home']): ?><p><span>Home University:</span> <?php echo $this->_tpl_vars['UserInfo']['uni_home'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['languages']): ?><p><span>Languages:</span> <?php echo $this->_tpl_vars['UserInfo']['languages'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['travel_advice']): ?><p><span>Travel Advice:</span> <?php echo $this->_tpl_vars['UserInfo']['travel_advice'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['birthday']): ?><p><span>Birthday:</span> <?php echo ((is_array($_tmp=$this->_tpl_vars['UserInfo']['birthday'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %B %Y") : smarty_modifier_date_format($_tmp, "%d %B %Y"));  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['visited_cities']): ?><p><span>Cities Visited:</span> <?php echo $this->_tpl_vars['UserInfo']['visited_cities'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['like_visit']): ?><p><span>Places I'd Like to Visit:</span> <?php echo $this->_tpl_vars['UserInfo']['like_visit'];  endif; ?>
                            <p><span>Relationship Status:</span> <?php echo $this->_tpl_vars['UserInfo']['relation_status']; ?>

                            <p><span>Sexual Orientation:</span> <?php echo $this->_tpl_vars['UserInfo']['sexual_orientation']; ?>

                            <?php if ($this->_tpl_vars['UserInfo']['turn_ons']): ?><p><span>Turn Ons:</span> <?php echo $this->_tpl_vars['UserInfo']['turn_ons'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['turn_offs']): ?><p><span>Turn Offs:</span> <?php echo $this->_tpl_vars['UserInfo']['turn_offs'];  endif; ?>
                            <?php if ($this->_tpl_vars['UserInfo']['interested_in']): ?><p><span>Intersted In:</span> <?php echo $this->_tpl_vars['UserInfo']['interested_in'];  endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

            <?php elseif ($this->_tpl_vars['action'] == 'change'): ?>
    <div class="maincontainer">
        <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <?php if ($this->_tpl_vars['what'] == 'profile'): ?>
                            <li class="on"><span class="profile"><a>Edit My Profile</a></span>
                            <li><span class="photos">            <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=change&amp;what=photos">Upload Photos</a></span>
                            <?php elseif ($this->_tpl_vars['what'] == 'photos'): ?>
                            <li><span class="profile"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=change&amp;what=profile">Edit My Profile</a></span>
                            <li class="on"><span class="photos"> <a>Upload Photos</a></span>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

            <?php if ('profile' == $this->_tpl_vars['what']): ?>

        <div class="rightpart">

              <script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/js/SubSys.js"></script> 
              <script type="text/javascript" language="JavaScript">
                  <!--
                  <?php echo '

                  function doLoad(field_type, city_idx) 
                  { 
                      var iso2_cntr = \'\' + document.getElementById(\'iso2_cntr_sel\').value; 
                      var req = new Subsys_JsHttpRequest_Js(); 
                      req.onreadystatechange = function() 
                      { 
                          if (req.readyState == 4)
                          { 
                              document.getElementById(\'cities_list\').innerHTML = req.responseText; 
                          } 
                      } 
                      var field = \'abroad_city_id\';
                      req.caching = true; 
                      req.open(\'POST\', \'index.php?mod=registration&action=cities_ajax\', true); 
                      req.send({ iso2_cntr: iso2_cntr, field: field, city_idx: city_idx}); 
                  } 
                  '; ?>

                  // -->
              </script>

            <div class="title-block"><div>Edit Your Profile</div></div>
            <div class="block">
<?php if ($this->_tpl_vars['UserLastError'] != ''): ?><p>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;<b><i><font color="red"><?php echo $this->_tpl_vars['UserLastError']; ?>
</font></i></b></p><?php endif; ?>

            <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" method="post" name="<?php if ($this->_tpl_vars['action'] == 'reg'): ?>AddUserForm<?php elseif ($this->_tpl_vars['action'] == 'change'): ?>ChangeUserForm<?php endif; ?>" enctype="application/x-www-form-urlencoded" >
            <input type="hidden" name="mod"    value="registration" />
            <input type="hidden" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" />
            <input type="hidden" name="what"   value="<?php echo $this->_tpl_vars['what']; ?>
" />
            <input type="hidden" name="do"  value="1" />
                <div class="pad">
                    <div class="reg-name">E-Mail</div>
                    <div class="reg-inp"><input type="text"     name="UserInfo[email]" value="<?php echo $this->_tpl_vars['UserInfo']['email']; ?>
" maxlength="96" class="w1" onKeyPress="filter(event,2,'@.-_0123456789',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Password</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass]"  value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Confirm</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass2]" value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">NickName</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[nickname]" value="<?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
"  onKeyPress="filter(event,2,'-_0123456789',1)" maxlength="50" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Birthday</div>  
                    <div class="reg-inp"><?php echo smarty_function_html_select_date(array('start_year' => 1900,'field_order' => 'DMY','time' => $this->_tpl_vars['UserInfo']['birthday'],'field_separator' => ' ','field_array' => 'UserInfo[birthday]','prefix' => '','all_extra' => 'style="sw1"'), $this);?>
</div>
                    <div class="spacer s12"><!-- --></div>
                    
                    <div class="reg-name">Abroad Country</div>
                    <div class="reg-inp">
                                       <select id="iso2_cntr_sel" name="UserInfo[iso2_cntr]"  class="sw1" onChange="doLoad('','<?php echo $this->_tpl_vars['UserInfo']['abroad_city_id']; ?>
');" > 
                                       <?php unset($this->_sections['iicn']);
$this->_sections['iicn']['name'] = 'iicn';
$this->_sections['iicn']['loop'] = is_array($_loop=$this->_tpl_vars['cntr_ar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iicn']['show'] = true;
$this->_sections['iicn']['max'] = $this->_sections['iicn']['loop'];
$this->_sections['iicn']['step'] = 1;
$this->_sections['iicn']['start'] = $this->_sections['iicn']['step'] > 0 ? 0 : $this->_sections['iicn']['loop']-1;
if ($this->_sections['iicn']['show']) {
    $this->_sections['iicn']['total'] = $this->_sections['iicn']['loop'];
    if ($this->_sections['iicn']['total'] == 0)
        $this->_sections['iicn']['show'] = false;
} else
    $this->_sections['iicn']['total'] = 0;
if ($this->_sections['iicn']['show']):

            for ($this->_sections['iicn']['index'] = $this->_sections['iicn']['start'], $this->_sections['iicn']['iteration'] = 1;
                 $this->_sections['iicn']['iteration'] <= $this->_sections['iicn']['total'];
                 $this->_sections['iicn']['index'] += $this->_sections['iicn']['step'], $this->_sections['iicn']['iteration']++):
$this->_sections['iicn']['rownum'] = $this->_sections['iicn']['iteration'];
$this->_sections['iicn']['index_prev'] = $this->_sections['iicn']['index'] - $this->_sections['iicn']['step'];
$this->_sections['iicn']['index_next'] = $this->_sections['iicn']['index'] + $this->_sections['iicn']['step'];
$this->_sections['iicn']['first']      = ($this->_sections['iicn']['iteration'] == 1);
$this->_sections['iicn']['last']       = ($this->_sections['iicn']['iteration'] == $this->_sections['iicn']['total']);
?>
                                       <option value="<?php echo $this->_tpl_vars['cntr_ar'][$this->_sections['iicn']['index']]['iso2']; ?>
" <?php if ($this->_tpl_vars['UserInfo']['iso2_cntr'] == $this->_tpl_vars['cntr_ar'][$this->_sections['iicn']['index']]['iso2']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['cntr_ar'][$this->_sections['iicn']['index']]['name']; ?>
</option>
                                       <?php endfor; endif; ?>
                                       </select>
                    </div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-name">Abroad City</div>
                    <div class="reg-inp" id="cities_list"></div>
                    <br />

                    <div class="reg-name">Abroad Status</div>
                    <div class="reg-inp">
                    <select name="UserInfo[abroad_status]" class="sw1">
                    <?php $_from = $this->_tpl_vars['UserOptions'][0]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['abroad_status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select>
                    </div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-line"><!-- --></div>
                    <div class="reg-names"><span>These fields are not obligatory, but we recommend filling them:</span></div>
                    <div class="spacer s20"><!-- --></div>

                    
                    <div class="reg-name">First Name</div>
                    <div class="reg-inp"> <input type="text" name="UserInfo[fname]" value="<?php echo $this->_tpl_vars['UserInfo']['fname']; ?>
" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Middle Name</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[mname]" value="<?php echo $this->_tpl_vars['UserInfo']['mname']; ?>
" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>
                    
                    <div class="reg-name">Originally From</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[originally_from]" value="<?php echo $this->_tpl_vars['UserInfo']['originally_from']; ?>
"  class="w1" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Here For</div>
                    <div class="reg-inp">
                    <select class="sw1" name="UserInfo[here_for]">
                    <?php $_from = $this->_tpl_vars['UserOptions'][1]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['here_for']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Home University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_home]" value="<?php echo $this->_tpl_vars['UserInfo']['uni_home']; ?>
" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Host University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_host]" value="<?php echo $this->_tpl_vars['UserInfo']['uni_host']; ?>
" maxlength="100"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Languages</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[languages]" value="<?php echo $this->_tpl_vars['UserInfo']['languages']; ?>
" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Cities Visited</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[visited_cities]"  maxlength="255" value="<?php echo $this->_tpl_vars['UserInfo']['visited_cities']; ?>
"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Places I'd like to visit</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[like_visit]" maxlength="255" value="<?php echo $this->_tpl_vars['UserInfo']['like_visit']; ?>
"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Relationship status</div>
                    <div class="reg-inp">
                    <select class="sw2" name="UserInfo[relation_status]" >
                    <?php $_from = $this->_tpl_vars['UserOptions'][2]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['relation_status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Sexual Orientation</div>
                    <div class="reg-inp">
                    <select class="sw2" name="UserInfo[sexual_orientation]" >
                    <?php $_from = $this->_tpl_vars['UserOptions'][3]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['sexual_orientation']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Ons</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_ons]" ><?php echo $this->_tpl_vars['UserInfo']['turn_ons']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Offs</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_offs]" ><?php echo $this->_tpl_vars['UserInfo']['turn_offs']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Interested In</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_interested_in]" ><?php echo $this->_tpl_vars['UserInfo']['turn_interested_in']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-names">Quote <span>(will appear at the top of your profile)</span></div>
                    <div class="spacer"><!-- --></div>
                    <div class="reg-inp" style="text-align: right;"><textarea name="UserInfo[quote]" ><?php echo $this->_tpl_vars['UserInfo']['quote']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">About Me</div>
                    <div class="reg-inp"><textarea name="UserInfo[about_me]" ><?php echo $this->_tpl_vars['UserInfo']['about_me']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Best Travel Story</div>
                    <div class="reg-inp"><textarea name="UserInfo[best_travel_story]" ><?php echo $this->_tpl_vars['UserInfo']['best_travel_story']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Travel Advice</div>
                    <div class="reg-inp"><textarea name="UserInfo[travel_advice]" ><?php echo $this->_tpl_vars['UserInfo']['travel_advice']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="link"><a href="javascript:document.ChangeUserForm.submit();" class="b" >Submit</a></div>
                </div>
              </form>
          </div>

        </div>


                             <script type="text/javascript" language="JavaScript">
                             doLoad('','<?php echo $this->_tpl_vars['UserInfo']['abroad_city_id']; ?>
');
                             </script>

        <div class="spacer"><!-- --></div>

      </div>

            <?php elseif ('photos' == $this->_tpl_vars['what']): ?>
        <div class="rightpart">

            <div class="title-block"><div>Upload Photos</div></div>
            <div class="block">
                <div class="pad">
                    <div class="form">
                          <div class="pad">
                              <b>Currently uploaded: <?php echo $this->_tpl_vars['photos_cnt']; ?>
 out of 6</b><br>
                              <div class="spacer s9"><!-- --></div>
                             <!--
                              <div>
                                  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="100%" height="400">
                                    <param name="movie" value="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/swf/e37zoom_admin.swf?server=http://www.engine37.com/sandbox/thefroghouse/fileManager.php&amp;thumbnail=70,60&amp;images=<?php echo $this->_tpl_vars['UserInfo']['photos_list']; ?>
&amp;bgcolor=FFFFFF&amp;control=5&amp;preview=1&amp;rgb=18,156,53" />
                                    <param name="quality" value="high" />
                                    <param name="bgcolor" value="#FFFFFF" /> 
                                    <param name="scale" value="noscale" />
                                    <param name="salign" value="lt" />
                                    <embed src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/swf/e37zoom_admin.swf?server=http://www.engine37.com/sandbox/thefroghouse/fileManager.php&amp;thumbnail=70,60&amp;images=<?php echo $this->_tpl_vars['UserInfo']['photos_list']; ?>
&amp;bgcolor=FFFFFF&amp;control=5&amp;preview=1&amp;rgb=18,156,53" bgcolor="#FFFFFF" scale="noscale" salign="lt" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="400" />
                                  </object>
                              </div>    
                              -->
                              <div class="spacer s9"><!-- --></div>
                          
                              <?php unset($this->_sections['iiph']);
$this->_sections['iiph']['name'] = 'iiph';
$this->_sections['iiph']['loop'] = is_array($_loop=$this->_tpl_vars['photos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iiph']['show'] = true;
$this->_sections['iiph']['max'] = $this->_sections['iiph']['loop'];
$this->_sections['iiph']['step'] = 1;
$this->_sections['iiph']['start'] = $this->_sections['iiph']['step'] > 0 ? 0 : $this->_sections['iiph']['loop']-1;
if ($this->_sections['iiph']['show']) {
    $this->_sections['iiph']['total'] = $this->_sections['iiph']['loop'];
    if ($this->_sections['iiph']['total'] == 0)
        $this->_sections['iiph']['show'] = false;
} else
    $this->_sections['iiph']['total'] = 0;
if ($this->_sections['iiph']['show']):

            for ($this->_sections['iiph']['index'] = $this->_sections['iiph']['start'], $this->_sections['iiph']['iteration'] = 1;
                 $this->_sections['iiph']['iteration'] <= $this->_sections['iiph']['total'];
                 $this->_sections['iiph']['index'] += $this->_sections['iiph']['step'], $this->_sections['iiph']['iteration']++):
$this->_sections['iiph']['rownum'] = $this->_sections['iiph']['iteration'];
$this->_sections['iiph']['index_prev'] = $this->_sections['iiph']['index'] - $this->_sections['iiph']['step'];
$this->_sections['iiph']['index_next'] = $this->_sections['iiph']['index'] + $this->_sections['iiph']['step'];
$this->_sections['iiph']['first']      = ($this->_sections['iiph']['iteration'] == 1);
$this->_sections['iiph']['last']       = ($this->_sections['iiph']['iteration'] == $this->_sections['iiph']['total']);
?>
                              <div class="up-ph">
                                  <div class="pic"><a target="_blank" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['photos'][$this->_sections['iiph']['index']]['name']; ?>
"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['photos'][$this->_sections['iiph']['index']]['res_image']; ?>
" width="110" alt=""></a></div>
                                  <div class="link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=change&amp;what=photos&amp;pic_id=<?php echo $this->_tpl_vars['photos'][$this->_sections['iiph']['index']]['pic_id']; ?>
&amp;do=2" class="delete" >Delete</a></div>
                              </div>
                              <div class="spacer s25"><!-- --></div>
                              <?php endfor; endif; ?>
                          
                              <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" method="post" name="UploadPhotoForm" enctype="multipart/form-data" >
                              <input type="hidden" name="mod"    value="registration" />
                              <input type="hidden" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" />
                              <input type="hidden" name="what"   value="<?php echo $this->_tpl_vars['what']; ?>
" />
                              <input type="hidden" name="do"     value="1" />
                          
                              <?php if ($this->_tpl_vars['photos_cnt'] < 6): ?>
                              <b>Upload new photo</b><br>
                              <span class="note">Maximum file size is 5Mb. Our service will automatically create a thumbnail.</span>
                              <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                              <input type="file" name="new_photo" style="width:270px;margin-top:5px;">
                              <p><input type="submit" value="Upload File"><br>
                              <?php endif; ?>
                              </form>
                          </div>
                    </div>

                </div>
            </div>
         </div>
       </div>
            <?php endif; ?>

            <?php elseif ($this->_tpl_vars['action'] == 'reg'): ?>
       <?php if (! $this->_tpl_vars['step'] || $this->_tpl_vars['step'] == 1): ?>
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

              <script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/js/SubSys.js"></script> 
              <script type="text/javascript" language="JavaScript">
                  <!--
                  <?php echo '

                  function doLoad(field_type, city_idx) 
                  {
                      var iso2_cntr = \'\' + document.getElementById(\'iso2_cntr_sel\').value; 
                      var req = new Subsys_JsHttpRequest_Js(); 
                      req.onreadystatechange = function() 
                      { 
                          if (req.readyState == 4)
                          { 
                              document.getElementById(\'cities_list\').innerHTML = req.responseText; 
                          } 
                      } 
                      var field = \'abroad_city_id\';
                      req.caching = true; 
                      req.open(\'POST\', \'index.php?mod=registration&action=cities_ajax\', true); 
                      req.send({ iso2_cntr: iso2_cntr, field: field, city_idx: city_idx}); 
                  } 
                  '; ?>

                  // -->
              </script>


            <div class="title-block"><div>Create Your Profile</div></div>

            <div class="block">
            <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" method="post" name="<?php if ($this->_tpl_vars['action'] == 'reg'): ?>AddUserForm<?php elseif ($this->_tpl_vars['action'] == 'main'): ?>ChangeUserForm<?php endif; ?>" enctype="application/x-www-form-urlencoded" >
            <input type="hidden" name="mod"    value="registration" />
            <input type="hidden" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" />
            <input type="hidden" name="step"   value="1" />
            <input type="hidden" name="do"  value="1" />
                <div class="pad">
            <?php if ($this->_tpl_vars['UserLastError'] != ''): ?><p>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;<b><i><font color="red"><?php echo $this->_tpl_vars['UserLastError']; ?>
</font></i></b><br /><br /></p><?php endif; ?>
                    <div class="reg-name">E-Mail</div>
                    <div class="reg-inp"><input type="text"     name="UserInfo[email]" value="<?php echo $this->_tpl_vars['UserInfo']['email']; ?>
" maxlength="96" class="w1" onKeyPress="filter(event,2,'@.-_0123456789',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Password</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass]"  value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Confirm</div>
                    <div class="reg-inp"><input type="password" name="UserInfo[pass2]" value=""                  maxlength="21" class="w1" onKeyPress="filter(event,3,'_-',1)" /></div>
                    <div class="spacer s12"><!-- --></div>


                    <div class="reg-name">NickName</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[nickname]" value="<?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
" maxlength="50" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>


                    <div class="reg-name">Birthday</div>  
                    <div class="reg-inp"><?php echo smarty_function_html_select_date(array('start_year' => 1900,'field_order' => 'DMY','time' => $this->_tpl_vars['UserInfo']['birthday'],'field_separator' => ' ','field_array' => 'UserInfo[birthday]','prefix' => '','all_extra' => 'style="sw1"'), $this);?>
</div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Abroad Country</div>

                    <div class="reg-inp">
                            <select id="iso2_cntr_sel" name="UserInfo[iso2_cntr]"  class="w1" onChange="doLoad('','<?php echo $this->_tpl_vars['UserInfo']['abroad_city_id']; ?>
');" > 
                            <?php unset($this->_sections['iicn']);
$this->_sections['iicn']['name'] = 'iicn';
$this->_sections['iicn']['loop'] = is_array($_loop=$this->_tpl_vars['cntr_ar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iicn']['show'] = true;
$this->_sections['iicn']['max'] = $this->_sections['iicn']['loop'];
$this->_sections['iicn']['step'] = 1;
$this->_sections['iicn']['start'] = $this->_sections['iicn']['step'] > 0 ? 0 : $this->_sections['iicn']['loop']-1;
if ($this->_sections['iicn']['show']) {
    $this->_sections['iicn']['total'] = $this->_sections['iicn']['loop'];
    if ($this->_sections['iicn']['total'] == 0)
        $this->_sections['iicn']['show'] = false;
} else
    $this->_sections['iicn']['total'] = 0;
if ($this->_sections['iicn']['show']):

            for ($this->_sections['iicn']['index'] = $this->_sections['iicn']['start'], $this->_sections['iicn']['iteration'] = 1;
                 $this->_sections['iicn']['iteration'] <= $this->_sections['iicn']['total'];
                 $this->_sections['iicn']['index'] += $this->_sections['iicn']['step'], $this->_sections['iicn']['iteration']++):
$this->_sections['iicn']['rownum'] = $this->_sections['iicn']['iteration'];
$this->_sections['iicn']['index_prev'] = $this->_sections['iicn']['index'] - $this->_sections['iicn']['step'];
$this->_sections['iicn']['index_next'] = $this->_sections['iicn']['index'] + $this->_sections['iicn']['step'];
$this->_sections['iicn']['first']      = ($this->_sections['iicn']['iteration'] == 1);
$this->_sections['iicn']['last']       = ($this->_sections['iicn']['iteration'] == $this->_sections['iicn']['total']);
?>
                            <option value="<?php echo $this->_tpl_vars['cntr_ar'][$this->_sections['iicn']['index']]['iso2']; ?>
" <?php if ($this->_tpl_vars['UserInfo']['iso2_cntr'] == $this->_tpl_vars['cntr_ar'][$this->_sections['iicn']['index']]['iso2']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['cntr_ar'][$this->_sections['iicn']['index']]['name']; ?>
</option>
                            <?php endfor; endif; ?>
                            </select>
                    </div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-name">Abroad City</div>
                    <div class="reg-inp" id="cities_list"><!-- --></div>
                    <br />
                    <div class="reg-name">Abroad Status</div>
                    <div class="reg-inp">
                    <select name="UserInfo[abroad_status]" class="sw1">
                    <?php $_from = $this->_tpl_vars['UserOptions'][0]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['abroad_status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="reg-line"><!-- --></div>
                    <div class="reg-names"><span>These fields are not obligatory, but we recommend filling them:</span></div>
                    <div class="spacer s20"><!-- --></div>

                    
                    <div class="reg-name">First Name</div>
                    <div class="reg-inp"> <input type="text" name="UserInfo[fname]" value="<?php echo $this->_tpl_vars['UserInfo']['fname']; ?>
" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Middle Name</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[mname]" value="<?php echo $this->_tpl_vars['UserInfo']['mname']; ?>
" maxlength="25" class="w1" /></div>
                    <div class="spacer s12"><!-- --></div>
                    
                    <div class="reg-name">Originally From</div>
                    <div class="reg-inp"><input type="text" name="UserInfo[originally_from]" value="<?php echo $this->_tpl_vars['UserInfo']['originally_from']; ?>
"  class="w1" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Here For</div>
                    <div class="reg-inp">
                    <select class="sw1" name="UserInfo[here_for]">
                    <?php $_from = $this->_tpl_vars['UserOptions'][1]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['here_for']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Home University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_home]" value="<?php echo $this->_tpl_vars['UserInfo']['uni_home']; ?>
" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Host University</div>
                    <div class="reg-inp"><input type="text" class="w1" name="UserInfo[uni_host]" value="<?php echo $this->_tpl_vars['UserInfo']['uni_host']; ?>
" maxlength="100"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Languages</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[languages]" value="<?php echo $this->_tpl_vars['UserInfo']['languages']; ?>
" maxlength="100" /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Cities Visited</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[visited_cities]"  maxlength="255" value="<?php echo $this->_tpl_vars['UserInfo']['visited_cities']; ?>
"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Places I'd like to visit</div>
                    <div class="reg-inp"><input type="text" class="w2" name="UserInfo[like_visit]" maxlength="255" value="<?php echo $this->_tpl_vars['UserInfo']['like_visit']; ?>
"  /></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Relationship status</div>
                    <div class="reg-inp"><select class="sw2" name="UserInfo[relation_status]" >
                    <?php $_from = $this->_tpl_vars['UserOptions'][2]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['relation_status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Sexual Orientation</div>
                    <div class="reg-inp">
                    <select class="sw2" name="UserInfo[sexual_orientation]" >
                    <?php $_from = $this->_tpl_vars['UserOptions'][3]['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['UserInfo']['sexual_orientation']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    </select></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Ons</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_ons]" ><?php echo $this->_tpl_vars['UserInfo']['turn_ons']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Turn Offs</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_offs]" ><?php echo $this->_tpl_vars['UserInfo']['turn_offs']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Interested In</div>
                    <div class="reg-inp"><textarea name="UserInfo[turn_interested_in]" ><?php echo $this->_tpl_vars['UserInfo']['turn_interested_in']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-names">Quote <span>(will appear at the top of your profile)</span></div>
                    <div class="spacer"><!-- --></div>
                    <div class="reg-inp" style="text-align: right;"><textarea name="UserInfo[quote]" ><?php echo $this->_tpl_vars['UserInfo']['quote']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">About Me</div>
                    <div class="reg-inp"><textarea name="UserInfo[about_me]" ><?php echo $this->_tpl_vars['UserInfo']['about_me']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Best Travel Story</div>
                    <div class="reg-inp"><textarea name="UserInfo[best_travel_story]" ><?php echo $this->_tpl_vars['UserInfo']['best_travel_story']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>

                    <div class="reg-name">Travel Advice</div>
                    <div class="reg-inp"><textarea name="UserInfo[travel_advice]" ><?php echo $this->_tpl_vars['UserInfo']['travel_advice']; ?>
</textarea></div>

                    <div class="spacer s12"><!-- --></div>
                    <div class="link"><a href="javascript:document.AddUserForm.submit();" class="b">Next</a></div>
                  </div>
                  </form>

                </div>
              </div>
                             <script type="text/javascript" language="JavaScript">
                             doLoad('','<?php echo $this->_tpl_vars['UserInfo']['abroad_city_id']; ?>
');
                             </script>

    <div class="spacer"><!-- --></div>

            <?php elseif ($this->_tpl_vars['step'] == 3): ?>
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

            <?php else: ?>
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
            <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" method="post" name="UploadPhotoForm" enctype="multipart/form-data" >
            <input type="hidden" name="mod"    value="registration" />
            <input type="hidden" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" />
            <input type="hidden" name="step"   value="2" />
            <input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
" />
            <input type="hidden" name="do"     value="1" />
                <div class="pad">
                    <div class="form">
                         <div class="pad">
                             <b>Currently uploaded: <?php echo $this->_tpl_vars['photos_cnt']; ?>
 out of 6</b><br>
                        
                             <div class="spacer s9"><!-- --></div>
                        
                             <?php unset($this->_sections['iiph']);
$this->_sections['iiph']['name'] = 'iiph';
$this->_sections['iiph']['loop'] = is_array($_loop=$this->_tpl_vars['photos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iiph']['show'] = true;
$this->_sections['iiph']['max'] = $this->_sections['iiph']['loop'];
$this->_sections['iiph']['step'] = 1;
$this->_sections['iiph']['start'] = $this->_sections['iiph']['step'] > 0 ? 0 : $this->_sections['iiph']['loop']-1;
if ($this->_sections['iiph']['show']) {
    $this->_sections['iiph']['total'] = $this->_sections['iiph']['loop'];
    if ($this->_sections['iiph']['total'] == 0)
        $this->_sections['iiph']['show'] = false;
} else
    $this->_sections['iiph']['total'] = 0;
if ($this->_sections['iiph']['show']):

            for ($this->_sections['iiph']['index'] = $this->_sections['iiph']['start'], $this->_sections['iiph']['iteration'] = 1;
                 $this->_sections['iiph']['iteration'] <= $this->_sections['iiph']['total'];
                 $this->_sections['iiph']['index'] += $this->_sections['iiph']['step'], $this->_sections['iiph']['iteration']++):
$this->_sections['iiph']['rownum'] = $this->_sections['iiph']['iteration'];
$this->_sections['iiph']['index_prev'] = $this->_sections['iiph']['index'] - $this->_sections['iiph']['step'];
$this->_sections['iiph']['index_next'] = $this->_sections['iiph']['index'] + $this->_sections['iiph']['step'];
$this->_sections['iiph']['first']      = ($this->_sections['iiph']['iteration'] == 1);
$this->_sections['iiph']['last']       = ($this->_sections['iiph']['iteration'] == $this->_sections['iiph']['total']);
?>
                             <div class="up-ph">
                                 <div class="pic"><a target="_blank" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['photos'][$this->_sections['iiph']['index']]['name']; ?>
"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['photos'][$this->_sections['iiph']['index']]['res_image']; ?>
" width="110" alt=""></a></div>
                                 <div class="link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=reg&amp;step=2&amp;user_id=<?php echo $this->_tpl_vars['user_id']; ?>
&amp;pic_id=<?php echo $this->_tpl_vars['photos'][$this->_sections['iiph']['index']]['pic_id']; ?>
&amp;do=2" class="delete" >Delete</a></div>
                             </div>
                             <div class="spacer s25"><!-- --></div>
                             <?php endfor; endif; ?>
                        
                             <?php if ($this->_tpl_vars['photos_cnt'] < 6): ?>
                             <b>Upload new photo</b><br>
                             <span class="note">Maximum file size is 5Mb. Our service will automatically create a thumbnail.</span>
                             <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                             <input type="file" name="new_photo" style="width:270px;margin-top:5px;">
                             <p><input type="submit" value="Upload File"><br>
                             <?php endif; ?>
                         </div>
                    </div>

                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=reg&amp;step=3">End registration</a></div>
                </div>
                </form>

            </div>
       </div>
            <?php endif; ?>
            <?php elseif ($this->_tpl_vars['action'] == 'mess'): ?>
            <b><?php echo $this->_tpl_vars['Message']; ?>
</b>
            <?php elseif ($this->_tpl_vars['action'] == 'restore_password'): ?>

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

        <div class="title-block"><div><?php echo $this->_config[0]['vars']['RestPass']; ?>
</div></div>
          <div class="block">
              <form name="RestorePassForm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" method="post" enctype="application/x-www-form-urlencoded">
              <input type="hidden" name="do" value="1" />
              <input type="hidden" name="mod" value="registration" />
              <input type="hidden" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" />

                <div class="pad">
                    <div class="form">
                    <div class="pad">
                    <?php if ($this->_tpl_vars['UserLastError'] != ''): ?>
                        <div>&nbsp;&nbsp;&nbsp;&nbsp;<b><i><font color="red"><?php echo $this->_tpl_vars['UserLastError']; ?>
</font></i></b></div>
                        <div class="spacer s9"><!-- --></div>
                    <?php endif; ?>
                        <div class="spacer"><!-- --></div>
                        <div class="name"><div>Your Email:</div></div><div class="inp"><input type="text" name="email" maxlength="40" onKeyPress="filter(event,2,'@.-_0123456789',1)" /></div>
                        <div class="spacer s9"><!-- --></div>
                    </div>
                    </div>
            
                    <div class="spacer s9"><!-- --></div>
                    <div class="link link-left"><a href="javascript:document.RestorePassForm.submit();" ><b><?php echo $this->_config[0]['vars']['send']; ?>
</b></a></div>
                </div>
               </form>
            </div>
      </div>
    <?php endif; ?>