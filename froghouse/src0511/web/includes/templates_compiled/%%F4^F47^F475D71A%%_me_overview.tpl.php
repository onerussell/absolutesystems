<?php /* Smarty version 2.6.12, created on 2006-05-09 17:51:23
         compiled from mods/_me_overview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'mods/_me_overview.tpl', 51, false),)), $this); ?>
    <div class="maincontainer">
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/me/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <div class="rightpart">

            <div class="title-block"><div>Latest Activity</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                        <?php if ($this->_tpl_vars['people_cnt']): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/?city_id=<?php echo $this->_tpl_vars['UserInfoCity']; ?>
">People in <?php echo $this->_tpl_vars['UserInfoCityName']; ?>
 (<?php echo $this->_tpl_vars['people_cnt']; ?>
 new)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['nightlife_cnt']): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=nightlife">Nightlife in <?php echo $this->_tpl_vars['UserInfoCityName']; ?>
 (<?php echo $this->_tpl_vars['nightlife_cnt']; ?>
 new reviews)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['culture_cnt']): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=culture">Culture in <?php echo $this->_tpl_vars['UserInfoCityName']; ?>
 (<?php echo $this->_tpl_vars['culture_cnt']; ?>
 new reviews)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['food_cnt']): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=food">Food in <?php echo $this->_tpl_vars['UserInfoCityName']; ?>
 (<?php echo $this->_tpl_vars['food_cnt']; ?>
 new reviews)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['lodging_cnt']): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=lodging">Lodging in <?php echo $this->_tpl_vars['UserInfoCityName']; ?>
 (<?php echo $this->_tpl_vars['lodging_cnt']; ?>
 new reviews)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['necessities_cnt']): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=necessities">Necessities in <?php echo $this->_tpl_vars['UserInfoCityName']; ?>
 (<?php echo $this->_tpl_vars['nec_cnt']; ?>
 new post)</a></div><?php endif; ?>
                        <?php if (! ( $this->_tpl_vars['people_cnt'] || $this->_tpl_vars['nigthlife_cnt'] || $this->_tpl_vars['culture_cnt'] || $this->_tpl_vars['food_cnt'] || $this->_tpl_vars['lodging_cnt'] || $this->_tpl_vars['necessities_cnt'] )): ?>
                        <div class="item">&nbsp;&nbsp;No events</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Inbox</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                        <?php if ($this->_tpl_vars['mc_inbox_cnt'] > 0): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=inbox">Messages (<?php echo $this->_tpl_vars['mc_inbox_cnt']; ?>
 new)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['mc_friend_requests_cnt'] > 0): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=friends_req">Friend Requests (<?php echo $this->_tpl_vars['mc_friend_requests_cnt']; ?>
 new)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['mc_pending_requests_cnt'] > 0): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=pending_req">Pending Requests (<?php echo $this->_tpl_vars['mc_pending_requests_cnt']; ?>
)</a></div><?php endif; ?>
                        <?php if ($this->_tpl_vars['mc_last_kiss']): ?><div class="item"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=inbox&amp;add_action=read&amp;id=<?php echo $this->_tpl_vars['mc_last_kiss']['id']; ?>
"><?php echo $this->_tpl_vars['mc_last_kiss']['subject']; ?>
</a></div><?php endif; ?>

                        <?php if (! ( $this->_tpl_vars['mc_inbox_cnt'] || $this->_tpl_vars['mc_friend_requests_cnt'] || $this->_tpl_vars['mc_pending_requests_cnt'] || $this->_tpl_vars['mc_last_kiss'] )): ?>
                        <div class="item">&nbsp;&nbsp;No events</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Friends</div></div>
            <div class="block">
                <div class="pad">
                    <div class="photo">
                        <div class="pads">
       
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
, <?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['city_name']['city_name']; ?>
</a></div>
                               </div>
                           <?php endfor; else: ?>
                           <div class="list">
                           <div class="item">
                           &nbsp;No friends
                           </div>
                           </div>
                           <?php endif; ?>


                        </div>
                        <div class="spacer"><!-- --></div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends">View all friends<?php if ($this->_tpl_vars['friends_cnt'] > 0): ?> (<?php echo $this->_tpl_vars['friends_cnt']; ?>
)<?php endif; ?></a></div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Photos</div></div>
            <div class="block">
                <div class="pad">
                    <div class="photos-l">
                        <?php unset($this->_sections['iiphl']);
$this->_sections['iiphl']['name'] = 'iiphl';
$this->_sections['iiphl']['loop'] = is_array($_loop=$this->_tpl_vars['photoList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iiphl']['show'] = true;
$this->_sections['iiphl']['max'] = $this->_sections['iiphl']['loop'];
$this->_sections['iiphl']['step'] = 1;
$this->_sections['iiphl']['start'] = $this->_sections['iiphl']['step'] > 0 ? 0 : $this->_sections['iiphl']['loop']-1;
if ($this->_sections['iiphl']['show']) {
    $this->_sections['iiphl']['total'] = $this->_sections['iiphl']['loop'];
    if ($this->_sections['iiphl']['total'] == 0)
        $this->_sections['iiphl']['show'] = false;
} else
    $this->_sections['iiphl']['total'] = 0;
if ($this->_sections['iiphl']['show']):

            for ($this->_sections['iiphl']['index'] = $this->_sections['iiphl']['start'], $this->_sections['iiphl']['iteration'] = 1;
                 $this->_sections['iiphl']['iteration'] <= $this->_sections['iiphl']['total'];
                 $this->_sections['iiphl']['index'] += $this->_sections['iiphl']['step'], $this->_sections['iiphl']['iteration']++):
$this->_sections['iiphl']['rownum'] = $this->_sections['iiphl']['iteration'];
$this->_sections['iiphl']['index_prev'] = $this->_sections['iiphl']['index'] - $this->_sections['iiphl']['step'];
$this->_sections['iiphl']['index_next'] = $this->_sections['iiphl']['index'] + $this->_sections['iiphl']['step'];
$this->_sections['iiphl']['first']      = ($this->_sections['iiphl']['iteration'] == 1);
$this->_sections['iiphl']['last']       = ($this->_sections['iiphl']['iteration'] == $this->_sections['iiphl']['total']);
?>
                        <div class="pitem<?php if ($this->_sections['iiphl']['rownum'] == 3): ?> pitem-last<?php endif; ?>">
                            <div class="pic pic<?php if ($this->_sections['iiphl']['rownum'] == 2): ?>v<?php else: ?>h<?php endif; ?>"><?php if ($this->_tpl_vars['photoList'][$this->_sections['iiphl']['index']]['image'] <> ''): ?><a href="<?php echo $this->_tpl_vars['photoList'][$this->_sections['iiphl']['index']]['link']; ?>
"><img src="<?php echo $this->_tpl_vars['siteAdr'];  echo $this->_tpl_vars['imagedir'];  if ($this->_tpl_vars['photoList'][$this->_sections['iiphl']['index']]['cached'] == 1):  echo $this->_tpl_vars['cachedir'];  endif;  echo $this->_tpl_vars['photoList'][$this->_sections['iiphl']['index']]['image']; ?>
" border="0" /></a><?php endif; ?></div>
                            <div class="name"><a href="<?php echo $this->_tpl_vars['photoList'][$this->_sections['iiphl']['index']]['link']; ?>
"><?php if ($this->_tpl_vars['photoList'][$this->_sections['iiphl']['index']]['pcnt'] == 0):  echo $this->_config[0]['vars']['nocomments'];  else:  echo $this->_tpl_vars['photoList'][$this->_sections['iiphl']['index']]['pcnt']; ?>
 <?php echo $this->_config[0]['vars']['comments'];  endif; ?></a></div>
                        </div>
                        <?php endfor; endif; ?>

                        <div class="spacer s15"><!-- --></div>


                    </div>

                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=photo">View all photos (<?php echo $this->_tpl_vars['photo_cnt']; ?>
)</a></div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Blog's Latest Entry</div></div>
            <div class="block">
                <div class="pad">
                    <div class="blog-l">
                        <div class="b-item">
                            <div class="date"><?php echo $this->_tpl_vars['blogItem']['pdate']; ?>
</div>
                            <div class="title"><?php echo $this->_tpl_vars['blogItem']['title']; ?>
</div>
                            <div class="text"><?php echo $this->_tpl_vars['blogItem']['descr']; ?>
</div>
                            <div class="link"><?php if ($this->_tpl_vars['blogItem']['pcnt'] == 0):  echo $this->_config[0]['vars']['nocomments'];  else:  echo $this->_tpl_vars['blogItem']['pcnt']; ?>
 <?php echo $this->_config[0]['vars']['comments'];  endif; ?></a></div>
                        </div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=blog">View all entries</a></div>
                </div>
            </div>
        </div>
    <div class="spacer"><!-- --></div>
    </div>      
        