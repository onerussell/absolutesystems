<?php /* Smarty version 2.6.12, created on 2006-05-07 14:44:37
         compiled from mods/people/_people.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'mods/people/_people.tpl', 9, false),array('modifier', 'date_format', 'mods/people/_people.tpl', 36, false),)), $this); ?>
    <div class="maincontainer">

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/people/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if ($this->_tpl_vars['action'] == 'view'): ?>

        <div class="rightpart">

            <div class="title-block"><div><?php echo ((is_array($_tmp=$this->_tpl_vars['UserInfo']['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
's Profile</div></div>
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
       <?php elseif ($this->_tpl_vars['action'] == 'send'): ?>
        <div class="rightpart">
            <div class="title-block"><div>Send Message</div></div>

            <div class="block">
              <div class="pad">
                 <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
/send.html" name="SendMessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                 <input type="hidden" name="do"             value="1" />
                    <div class="form">
                      <div class="pad">
                         <div class="spacer"><!-- --></div>
                         <div class="name"><div>To:</div></div><div class="inp"><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['nickname']; ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['whom'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</a></div></div>
                         <div class="spacer s9"><!-- --></div>
                         <div class="name"><div>Subject:</div></div><div class="inp"><input type="text" name="mess[subject]" value=""></div>
                         <div class="spacer s9"><!-- --></div>
                         <div class="name"><div><br>Message:</div></div><div class="inp"><textarea name="mess[message]"></textarea></div>
                         <div class="spacer"><!-- --></div>
                      </div>
                    </div>

                    <div class="spacer s9"><!-- --></div>
                    <div class="link link-left"><a href="javascript:document.SendMessagesForm.submit();">Send</a></div>
                 </form>
                 </div>
            </div>
        </div>
       <?php elseif ($this->_tpl_vars['action'] == 'mess'): ?>
        <div class="rightpart">

            <div class="title-block"><div><?php echo $this->_tpl_vars['Message']; ?>
</div></div>
            <div class="block">
                 <div class="pad">
                      <div class="link link-left"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
/profile.html">Back to profile</a></div>
                </div>
            </div>
        </div>

       <?php elseif ($this->_tpl_vars['action'] == 'search'): ?>
        <div class="rightpart">
            <div class="title-block"><div>Search Results</div></div>
            <?php if ($this->_tpl_vars['ErrMessage']): ?><font color="red"><?php echo $this->_tpl_vars['ErrMessage']; ?>
</font><?php endif; ?>
            <div class="block">
                <div class="padd">
                    <div class="link linkpad"><?php if ('all' == $this->_tpl_vars['order']):  if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/search/?srh=<?php echo $this->_tpl_vars['srh']; ?>
&amp;do=1&amp;stype=<?php echo $this->_tpl_vars['stype']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/search/?srh=<?php echo $this->_tpl_vars['srh']; ?>
&amp;do=1&amp;stype=<?php echo $this->_tpl_vars['stype']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif;  endif; ?></div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="photo-l">

                    <?php unset($this->_sections['iiu']);
$this->_sections['iiu']['name'] = 'iiu';
$this->_sections['iiu']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iiu']['show'] = true;
$this->_sections['iiu']['max'] = $this->_sections['iiu']['loop'];
$this->_sections['iiu']['step'] = 1;
$this->_sections['iiu']['start'] = $this->_sections['iiu']['step'] > 0 ? 0 : $this->_sections['iiu']['loop']-1;
if ($this->_sections['iiu']['show']) {
    $this->_sections['iiu']['total'] = $this->_sections['iiu']['loop'];
    if ($this->_sections['iiu']['total'] == 0)
        $this->_sections['iiu']['show'] = false;
} else
    $this->_sections['iiu']['total'] = 0;
if ($this->_sections['iiu']['show']):

            for ($this->_sections['iiu']['index'] = $this->_sections['iiu']['start'], $this->_sections['iiu']['iteration'] = 1;
                 $this->_sections['iiu']['iteration'] <= $this->_sections['iiu']['total'];
                 $this->_sections['iiu']['index'] += $this->_sections['iiu']['step'], $this->_sections['iiu']['iteration']++):
$this->_sections['iiu']['rownum'] = $this->_sections['iiu']['iteration'];
$this->_sections['iiu']['index_prev'] = $this->_sections['iiu']['index'] - $this->_sections['iiu']['step'];
$this->_sections['iiu']['index_next'] = $this->_sections['iiu']['index'] + $this->_sections['iiu']['step'];
$this->_sections['iiu']['first']      = ($this->_sections['iiu']['iteration'] == 1);
$this->_sections['iiu']['last']       = ($this->_sections['iiu']['iteration'] == $this->_sections['iiu']['total']);
?>
                        <div class="p-item">
                            <div class="pic" style="height: 127px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
/profile.html"><img src="<?php echo $this->_tpl_vars['siteAdr'];  if ($this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['res_image']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['res_image'];  elseif ($this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['name']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['name'];  else: ?>includes/templates/images/nf.gif<?php endif; ?>" width="110" alt=""></a></div>
                            <div class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp));  if ('all' == $this->_tpl_vars['stype']): ?>, <?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['city_name']['city_name'];  endif; ?></a></div>
                        </div>
                        <?php if ($this->_sections['iiu']['rownum'] % 4 == 0 && ! $this->_sections['last']): ?>
                        <div class="spacer s6"><!-- --></div>
                        <?php endif; ?>
                    <?php endfor; endif; ?>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link linkpad"><?php if ('all' == $this->_tpl_vars['order']):  if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/search/?srh=<?php echo $this->_tpl_vars['srh']; ?>
&amp;do=1&amp;stype=<?php echo $this->_tpl_vars['stype']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/search/?srh=<?php echo $this->_tpl_vars['srh']; ?>
&amp;do=1&amp;stype=<?php echo $this->_tpl_vars['stype']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif;  endif; ?></div>
                </div>
            </div>

        </div>

       <?php else: ?>
        <div class="rightpart">
            <div class="title-block"><div>People in <?php echo $this->_tpl_vars['UserInfoCurrentCityName']; ?>
</div></div>
            <?php if ($this->_tpl_vars['ErrMessage']): ?><font color="red"><?php echo $this->_tpl_vars['ErrMessage']; ?>
</font><?php endif; ?>
            <div class="block">
                <div class="padd">
                    <div class="link linkpad"><div class="left"><?php if ('recently_added' == $this->_tpl_vars['order']): ?><div class="b">Recently Added</div><?php else: ?><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/?order=recently_added">Recently Added</a></div><?php endif;  if ('all' == $this->_tpl_vars['order']): ?><div class="b_">All</div><?php else: ?><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/?order=nickname">All</a></div><?php endif; ?></div><?php if ('all' == $this->_tpl_vars['order']):  if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/?order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/?order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif;  endif; ?></div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="photo-l">

                    <?php unset($this->_sections['iiu']);
$this->_sections['iiu']['name'] = 'iiu';
$this->_sections['iiu']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iiu']['show'] = true;
$this->_sections['iiu']['max'] = $this->_sections['iiu']['loop'];
$this->_sections['iiu']['step'] = 1;
$this->_sections['iiu']['start'] = $this->_sections['iiu']['step'] > 0 ? 0 : $this->_sections['iiu']['loop']-1;
if ($this->_sections['iiu']['show']) {
    $this->_sections['iiu']['total'] = $this->_sections['iiu']['loop'];
    if ($this->_sections['iiu']['total'] == 0)
        $this->_sections['iiu']['show'] = false;
} else
    $this->_sections['iiu']['total'] = 0;
if ($this->_sections['iiu']['show']):

            for ($this->_sections['iiu']['index'] = $this->_sections['iiu']['start'], $this->_sections['iiu']['iteration'] = 1;
                 $this->_sections['iiu']['iteration'] <= $this->_sections['iiu']['total'];
                 $this->_sections['iiu']['index'] += $this->_sections['iiu']['step'], $this->_sections['iiu']['iteration']++):
$this->_sections['iiu']['rownum'] = $this->_sections['iiu']['iteration'];
$this->_sections['iiu']['index_prev'] = $this->_sections['iiu']['index'] - $this->_sections['iiu']['step'];
$this->_sections['iiu']['index_next'] = $this->_sections['iiu']['index'] + $this->_sections['iiu']['step'];
$this->_sections['iiu']['first']      = ($this->_sections['iiu']['iteration'] == 1);
$this->_sections['iiu']['last']       = ($this->_sections['iiu']['iteration'] == $this->_sections['iiu']['total']);
?>
                        <div class="p-item">
                            <div class="pic" style="height: 127px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
/profile.html"><img src="<?php echo $this->_tpl_vars['siteAdr'];  if ($this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['res_image']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['res_image'];  elseif ($this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['name']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['name'];  else: ?>includes/templates/images/nf.gif<?php endif; ?>" width="110" alt=""></a></div>
                            <div class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</a></div>
                        </div>
                        <?php if ($this->_sections['iiu']['rownum'] % 4 == 0 && ! $this->_sections['last']): ?>
                        <div class="spacer s6"><!-- --></div>
                        <?php endif; ?>
                    <?php endfor; endif; ?>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link linkpad"><?php if ('all' == $this->_tpl_vars['order']):  if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/?order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/?order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif;  endif; ?></div>
                </div>
            </div>

        </div>
       <?php endif; ?>
   </div>