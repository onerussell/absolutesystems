<?php /* Smarty version 2.6.12, created on 2006-05-09 16:49:35
         compiled from mods/me/_mc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'mods/me/_mc.tpl', 36, false),array('modifier', 'date_format', 'mods/me/_mc.tpl', 36, false),array('modifier', 'lower', 'mods/me/_mc.tpl', 36, false),array('modifier', 'ucfirst', 'mods/me/_mc.tpl', 36, false),array('modifier', 'nl2br', 'mods/me/_mc.tpl', 71, false),)), $this); ?>
    <script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/js/main.js">
    </script>
    <div class="maincontainer">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/me/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div class="rightpart">

            <?php if ($this->_tpl_vars['action'] == 'inbox' || $this->_tpl_vars['action'] == 'sent' || $this->_tpl_vars['action'] == 'deleted'): ?>
                 <?php if (! $this->_tpl_vars['add_action'] || $this->_tpl_vars['add_action'] == 'view'): ?>
                 <div class="title-block"><div><?php if ('inbox' == $this->_tpl_vars['action']): ?>My Inbox<?php elseif ('sent' == $this->_tpl_vars['action']): ?>Sent Items<?php elseif ('deleted' == $this->_tpl_vars['action']): ?>Deleted Items<?php endif; ?> <?php if ($this->_tpl_vars['mess_cnt'] > 0): ?> (<?php echo $this->_tpl_vars['mess_cnt'];  if ($this->_tpl_vars['action'] == 'inbox'): ?> new<?php endif; ?>)<?php endif; ?></div></div>
                 <div class="block">
                    <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" name="MessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="id"             value="-1" />
                    <input type="hidden" name="action"         value="<?php echo $this->_tpl_vars['action']; ?>
" />
                    <input type="hidden" name="add_action"     value="delete" />
                    <input type="hidden" name="pvstart"        value="<?php echo $this->_tpl_vars['pvstart']; ?>
" />
                    <input type="hidden" name="order"          value="<?php echo $this->_tpl_vars['order']; ?>
" />
                    <div class="pad">
                
                         <div class="link linkpad"><div class="left"><div class="checks"><div><input type="checkbox" name="checkall1" value="1" onClick="javascript:selControl(this);" /></div></div><div>Sorting:&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php if ($this->_tpl_vars['order'] == 1): ?>2<?php else: ?>1<?php endif; ?>" <?php if ($this->_tpl_vars['order'] == 1): ?>class="fh"<?php elseif ($this->_tpl_vars['order'] == 2): ?>class="f"<?php endif; ?>><?php if ($this->_tpl_vars['action'] == 'inbox'): ?>From<?php elseif ($this->_tpl_vars['action'] == 'sent'): ?>To<?php else: ?>From/To<?php endif;  if ($this->_tpl_vars['order'] == 1 || $this->_tpl_vars['order'] == 2): ?>&nbsp;&nbsp;<?php endif; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php if ($this->_tpl_vars['order'] == 4): ?>3<?php else: ?>4<?php endif; ?>" <?php if ($this->_tpl_vars['order'] == 3): ?>class="fh"<?php elseif ($this->_tpl_vars['order'] == 4): ?>class="f"<?php endif; ?>>Date<?php if ($this->_tpl_vars['order'] == 3 || $this->_tpl_vars['order'] == 4): ?>&nbsp;&nbsp;<?php endif; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php if ($this->_tpl_vars['order'] == 5): ?>6<?php else: ?>5<?php endif; ?>" <?php if ($this->_tpl_vars['order'] == 5): ?>class="fh"<?php elseif ($this->_tpl_vars['order'] == 6): ?>class="f"<?php endif; ?>>Subject<?php if ($this->_tpl_vars['order'] == 5 || $this->_tpl_vars['order'] == 6): ?>&nbsp;&nbsp;<?php endif; ?></a></div></div><?php if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif; ?></div>
                         <div class="spacer s9"><!-- --></div>
                         <?php if ($this->_tpl_vars['code']): ?>
                         <div class="post">
                             <div class="post-item">
                             <b><br />&nbsp;&nbsp;&nbsp;<font color="red"><?php echo $this->_tpl_vars['code']; ?>
</font></b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         <?php endif; ?>
                         <?php unset($this->_sections['iim']);
$this->_sections['iim']['name'] = 'iim';
$this->_sections['iim']['loop'] = is_array($_loop=$this->_tpl_vars['mess']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iim']['show'] = true;
$this->_sections['iim']['max'] = $this->_sections['iim']['loop'];
$this->_sections['iim']['step'] = 1;
$this->_sections['iim']['start'] = $this->_sections['iim']['step'] > 0 ? 0 : $this->_sections['iim']['loop']-1;
if ($this->_sections['iim']['show']) {
    $this->_sections['iim']['total'] = $this->_sections['iim']['loop'];
    if ($this->_sections['iim']['total'] == 0)
        $this->_sections['iim']['show'] = false;
} else
    $this->_sections['iim']['total'] = 0;
if ($this->_sections['iim']['show']):

            for ($this->_sections['iim']['index'] = $this->_sections['iim']['start'], $this->_sections['iim']['iteration'] = 1;
                 $this->_sections['iim']['iteration'] <= $this->_sections['iim']['total'];
                 $this->_sections['iim']['index'] += $this->_sections['iim']['step'], $this->_sections['iim']['iteration']++):
$this->_sections['iim']['rownum'] = $this->_sections['iim']['iteration'];
$this->_sections['iim']['index_prev'] = $this->_sections['iim']['index'] - $this->_sections['iim']['step'];
$this->_sections['iim']['index_next'] = $this->_sections['iim']['index'] + $this->_sections['iim']['step'];
$this->_sections['iim']['first']      = ($this->_sections['iim']['iteration'] == 1);
$this->_sections['iim']['last']       = ($this->_sections['iim']['iteration'] == $this->_sections['iim']['total']);
?>
                         <div class="post">
                             <div class="post-item">
                                 <div class="check"><div><input type="checkbox" id="check_<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" name="check[<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
]" /></div></div>
                                 <div class="pic"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['nickname']; ?>
/profile.html"><img src="<?php echo $this->_tpl_vars['siteAdr'];  if ($this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['res_image']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['res_image'];  elseif ($this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['name']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['name'];  else: ?>includes/templates/images/nf.gif<?php endif; ?>" width="110" alt=""></a></div>
                                 <div class="text mt-width"><span class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['nickname']; ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['nickname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a></span><span class="date"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['sendtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %e %b, %Y<br />%I:%M %p") : smarty_modifier_date_format($_tmp, "%A, %e %b, %Y<br />%I:%M %p")))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span><p class="small"><?php if ($this->_tpl_vars['action'] == 'inbox' && ! $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['readed']): ?><b><?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['subject']; ?>
</b><?php else:  echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['subject'];  endif; ?> <?php if ($this->_tpl_vars['action'] == 'deleted'): ?><br /><br /><b><?php if ($this->_tpl_vars['uinfo'][0] == $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['toid']): ?>[Incomming message]<?php else: ?>[Sent message]<?php endif; ?></b><?php endif; ?>
                                     <div class="e-link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=read&amp;id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" class="read">Read</a><?php if ($this->_tpl_vars['action'] == 'inbox'): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=reply&amp;id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" class="reply">Reply</a><?php endif; ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=delete&amp;id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" onClick="if (!confirmLink(this, 'You really want to delete selected message ?')) return false;" class="delete">Delete</a></div>
                                 </div>
                
                                 <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         <?php if (! $this->_sections['iim']['last']): ?><div class="spacer s7"><!-- --></div><?php endif; ?>
                         <?php endfor; else: ?>
                         <div class="post">
                             <div class="post-item">
                             <b>No messages</b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         <?php endif; ?>
                         <div class="spacer s13"><!-- --></div>
                
                         <div class="link linkpad"><div class="left"><a href="<?php if ($this->_sections['iim']['total'] == 0): ?>javascript:;<?php else:  echo $this->_tpl_vars['siteAdr'];  endif; ?>" class="d" <?php if ($this->_sections['iim']['total'] > 0): ?>onClick="javascript:if (confirmLink(this, 'You really want to delete selected messages ?')) <?php echo '{'; ?>
 document.MessagesForm.id.value='-1'; document.MessagesForm.add_action.value='delete'; document.MessagesForm.submit();<?php echo '}'; ?>
; return false;"<?php endif; ?> >Delete selected</a></div><?php if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif; ?></div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                         </form>
                 </div>
                 <?php elseif ($this->_tpl_vars['add_action'] == 'read'): ?>
                 <div class="title-block"><div><?php if ('inbox' == $this->_tpl_vars['action']): ?>My Inbox<?php elseif ('sent' == $this->_tpl_vars['action']): ?>Sent Items<?php elseif ('deleted' == $this->_tpl_vars['action']): ?>Deleted Items<?php endif; ?> <?php if ($this->_tpl_vars['mess_cnt'] > 0): ?> (<?php echo $this->_tpl_vars['mess_cnt'];  if ($this->_tpl_vars['action'] == 'inbox'): ?> new<?php endif; ?>)<?php endif; ?></div></div>
                 <div class="block">
                     <div class="pad">
                         <div class="post">
                             <div class="post-item">
                                 <div class="pic"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['message']['nickname']; ?>
/profile.html"><img src="<?php echo $this->_tpl_vars['siteAdr'];  if ($this->_tpl_vars['message']['user_images']['res_image']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['message']['user_images']['res_image'];  elseif ($this->_tpl_vars['message']['user_images']['name']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['message']['user_images']['name'];  else: ?>includes/templates/images/nf.gif<?php endif; ?>" width="110" alt=""></a></div>
                                 <div class="text"><span class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['message']['nickname']; ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</a></span><span class="date">Posted on <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['message']['sendtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %e, %Y at %I:%M %p") : smarty_modifier_date_format($_tmp, "%B %e, %Y at %I:%M %p")))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span><?php echo $this->_tpl_vars['message']['subject'];  if ($this->_tpl_vars['action'] == 'deleted'): ?><br /><br /><b><?php if ($this->_tpl_vars['message']['toid'] == $this->_tpl_vars['uinfo'][0]): ?>[Incomming message]<?php else: ?>[Sent message]<?php endif; ?></b><?php endif; ?></div>
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="text padt"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']['message'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
                
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="edit-link"><?php if ($this->_tpl_vars['action'] == 'inbox'): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=reply&amp;id=<?php echo $this->_tpl_vars['message']['id']; ?>
" class="reply">Reply</a><?php endif; ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=delete&amp;id=<?php echo $this->_tpl_vars['message']['id']; ?>
" onClick="if (!confirmLink(this, 'You really want to delete this message ?')) return false;" class="delete">Delete</a></div>
                                 <div class="spacer s9"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         <div class="spacer s13"><!-- --></div>
                         <div class="link linkpad"><?php if ($this->_tpl_vars['message']['prev_id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=<?php echo $this->_tpl_vars['add_action']; ?>
&amp;id=<?php echo $this->_tpl_vars['message']['prev_id']; ?>
" class="b" >Previous Message</a><?php else: ?><span>Previous Message</span><?php endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['message']['next_id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=<?php echo $this->_tpl_vars['add_action']; ?>
&amp;id=<?php echo $this->_tpl_vars['message']['next_id']; ?>
" class="b" >Next Message</a><?php else: ?><span>Next Message</span><?php endif; ?></div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                 </div>
                 <?php elseif ($this->_tpl_vars['add_action'] == 'reply' && $this->_tpl_vars['action'] == 'inbox'): ?>
                 <div class="title-block"><div>Message from <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</div></div>
                 <div class="block">
                     <div class="pad">
                         <div class="post">
                             <div class="post-item">
                                 <div class="pic"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['message']['nickname']; ?>
/profile.html"><img src="<?php echo $this->_tpl_vars['siteAdr'];  if ($this->_tpl_vars['message']['user_images']['res_image']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['message']['user_images']['res_image'];  elseif ($this->_tpl_vars['message']['user_images']['name']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['message']['user_images']['name'];  else: ?>includes/templates/images/nf.gif<?php endif; ?>" width="110" alt=""></a></div>
                                 <div class="text"><span class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['message']['nickname']; ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</a></span><span class="date">Posted on <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['message']['sendtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %e, %Y at %I:%M %p") : smarty_modifier_date_format($_tmp, "%B %e, %Y at %I:%M %p")))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span><?php echo $this->_tpl_vars['message']['subject'];  if ($this->_tpl_vars['action'] == 'deleted'): ?><br /><br /><b><?php if ($this->_tpl_vars['message']['toid'] == $this->_tpl_vars['uinfo'][0]): ?>[Incomming]<?php else: ?>[Sent]<?php endif; ?></b><?php endif; ?></div>
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="text padt"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']['message'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
                
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="edit-link"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=delete&amp;id=<?php echo $this->_tpl_vars['message']['id']; ?>
" onClick="if (!confirmLink(this, 'You really want to delete this message ?')) return false;" class="delete">Delete</a></div>
                                 <div class="spacer s9"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         <div class="spacer s13"><!-- --></div>
                         <div class="link linkpad"><?php if ($this->_tpl_vars['message']['prev_id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=<?php echo $this->_tpl_vars['add_action']; ?>
&amp;id=<?php echo $this->_tpl_vars['message']['prev_id']; ?>
" class="b" >Previous Message</a><?php else: ?><span>Previous Message</span><?php endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['message']['next_id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=<?php echo $this->_tpl_vars['add_action']; ?>
&amp;id=<?php echo $this->_tpl_vars['message']['next_id']; ?>
" class="b" >Next Message</a><?php else: ?><span>Next Message</span><?php endif; ?></div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                 </div>
                 <div class="spacer s15"><!-- --></div>
                
                 <div class="title-block"><div>Reply Message</div></div>
                 <div class="block">
                    <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" name="ReplyMessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="id"             value="<?php echo $this->_tpl_vars['message']['id']; ?>
" />
                    <input type="hidden" name="action"         value="<?php echo $this->_tpl_vars['action']; ?>
" />
                    <input type="hidden" name="add_action"     value="reply" />
                    <input type="hidden" name="do"             value="1" />
                    <input type="hidden" name="pvstart"        value="<?php echo $this->_tpl_vars['pvstart']; ?>
" />
                    <input type="hidden" name="order"          value="<?php echo $this->_tpl_vars['order']; ?>
" />
                     <div class="pad">
                         <div class="form">
                         <div class="pad">
                             <div class="spacer"><!-- --></div>
                             <div class="name"><div>To:</div></div><div class="inp"><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['nickname']; ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['message']['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</a></div></div>
                             <div class="spacer s9"><!-- --></div>
                             <div class="name"><div>Subject:</div></div><div class="inp"><input type="text" name="mess[subject]" value="Re: <?php echo $this->_tpl_vars['message']['subject']; ?>
"></div>
                             <div class="spacer s9"><!-- --></div>
                             <div class="name"><div><br>Message:</div></div><div class="inp"><textarea name="mess[message]"></textarea></div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         </div>
                
                         <div class="spacer s9"><!-- --></div>
                         <div class="link link-left"><a href="javascript:document.ReplyMessagesForm.submit();">Send</a></div>
                     </div>
                    </form>
                 </div>
                 <?php endif; ?>

           <?php elseif ($this->_tpl_vars['action'] == 'friends_req' || $this->_tpl_vars['action'] == 'pending_req'): ?>
                 <div class="title-block"><div><?php if ('friends_req' == $this->_tpl_vars['action']): ?>These people want to be friends with you<?php elseif ('pending_req' == $this->_tpl_vars['action']): ?>Rejects<?php endif;  if ($this->_tpl_vars['mess_cnt']): ?>(<?php echo $this->_tpl_vars['mess_cnt']; ?>
)<?php endif; ?></div></div>
                
                 <?php if (! $this->_tpl_vars['add_action'] || $this->_tpl_vars['add_action'] == 'view'): ?>
                 <div class="block">
                    <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" name="MessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="id"             value="-1" />
                    <input type="hidden" name="action"         value="<?php echo $this->_tpl_vars['action']; ?>
" />
                    <input type="hidden" name="add_action"     value="delete" />
                    <input type="hidden" name="pvstart"        value="<?php echo $this->_tpl_vars['pvstart']; ?>
" />
                    <input type="hidden" name="order"          value="<?php echo $this->_tpl_vars['order']; ?>
" />
                    <div class="pad">
                
                         <div class="link linkpad"><div class="left"><div class="checks"><div><input type="checkbox" name="checkall1" value="1" onClick="javascript:selControl(this);" /></div></div></div><?php if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif; ?></div>
                         <div class="spacer s9"><!-- --></div>
                         <?php if ($this->_tpl_vars['code']): ?>
                         <div class="post">
                             <div class="post-item">
                             <b><br />&nbsp;&nbsp;&nbsp;<font color="red"><?php echo $this->_tpl_vars['code']; ?>
</font></b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         <?php endif; ?>
                         <?php unset($this->_sections['iim']);
$this->_sections['iim']['name'] = 'iim';
$this->_sections['iim']['loop'] = is_array($_loop=$this->_tpl_vars['mess']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iim']['show'] = true;
$this->_sections['iim']['max'] = $this->_sections['iim']['loop'];
$this->_sections['iim']['step'] = 1;
$this->_sections['iim']['start'] = $this->_sections['iim']['step'] > 0 ? 0 : $this->_sections['iim']['loop']-1;
if ($this->_sections['iim']['show']) {
    $this->_sections['iim']['total'] = $this->_sections['iim']['loop'];
    if ($this->_sections['iim']['total'] == 0)
        $this->_sections['iim']['show'] = false;
} else
    $this->_sections['iim']['total'] = 0;
if ($this->_sections['iim']['show']):

            for ($this->_sections['iim']['index'] = $this->_sections['iim']['start'], $this->_sections['iim']['iteration'] = 1;
                 $this->_sections['iim']['iteration'] <= $this->_sections['iim']['total'];
                 $this->_sections['iim']['index'] += $this->_sections['iim']['step'], $this->_sections['iim']['iteration']++):
$this->_sections['iim']['rownum'] = $this->_sections['iim']['iteration'];
$this->_sections['iim']['index_prev'] = $this->_sections['iim']['index'] - $this->_sections['iim']['step'];
$this->_sections['iim']['index_next'] = $this->_sections['iim']['index'] + $this->_sections['iim']['step'];
$this->_sections['iim']['first']      = ($this->_sections['iim']['iteration'] == 1);
$this->_sections['iim']['last']       = ($this->_sections['iim']['iteration'] == $this->_sections['iim']['total']);
?>
                         <div class="post">
                             <div class="post-item">
                                 <div class="check"><div><input type="checkbox" id="check_<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" name="check[<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
]" /></div></div>
                                 <div class="pic"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['nickname']; ?>
/profile.html"><img src="<?php echo $this->_tpl_vars['siteAdr'];  if ($this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['res_image']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['res_image'];  elseif ($this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['name']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['user_images']['name'];  else: ?>includes/templates/images/nf.gif<?php endif; ?>" width="110" alt=""></a></div>
                                 <div class="text mt-width"><span class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['nickname']; ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['nickname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a></span><span class="date"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['sendtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %e %b, %Y<br />%I:%M %p") : smarty_modifier_date_format($_tmp, "%A, %e %b, %Y<br />%I:%M %p")))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span>
                                     <div class="e-link"><?php if ('friends_req' == $this->_tpl_vars['action']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=approve&amp;id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" class="reply">Approve</a><?php endif; ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;add_action=delete&amp;id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" onClick="if (!confirmLink(this, 'You really want to <?php if ('friends_req' == $this->_tpl_vars['action']): ?>disapprove<?php else: ?>delete<?php endif; ?> selected request ?')) return false;" class="delete"><?php if ('friends_req' == $this->_tpl_vars['action']): ?>Disapprove<?php else: ?>Delete<?php endif; ?></a></div>
                                 </div>
                
                                 <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         <?php if (! $this->_sections['iim']['last']): ?><div class="spacer s7"><!-- --></div><?php endif; ?>
                         <?php endfor; else: ?>
                         <div class="post">
                             <div class="post-item">
                             <b>No requests</b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         <?php endif; ?>
                         <div class="spacer s13"><!-- --></div>
                
                         <div class="link linkpad"><div class="left"><a href="<?php if ($this->_sections['iim']['total'] == 0): ?>javascript:;<?php else:  echo $this->_tpl_vars['siteAdr'];  endif; ?>" class="d" <?php if ($this->_sections['iim']['total'] > 0): ?>onClick="javascript:if (confirmLink(this, 'You really want to delete selected requests ?')) <?php echo '{'; ?>
 document.MessagesForm.id.value='-1'; document.MessagesForm.add_action.value='delete'; document.MessagesForm.submit();<?php echo '}'; ?>
 return false;"<?php endif; ?> >Delete selected</a></div><?php if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=<?php echo $this->_tpl_vars['action']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
&amp;order=<?php echo $this->_tpl_vars['order']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif; ?></div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                   </form>
                 </div>
                 <?php endif; ?>
           <?php elseif ('settings' == $this->_tpl_vars['action']): ?>
                 <div class="title-block"><div>Mail Settings</div></div>
                
                 <?php if (! $this->_tpl_vars['add_action'] || $this->_tpl_vars['add_action'] == 'view'): ?>
                 <div class="block">
                    <div class="pad">
                    <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" name="SettingsForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="action"         value="settings" />
                    <input type="hidden" name="add_action"     value="change" />
                
                         <div class="spacer s9"><!-- --></div>
                         <?php if ($this->_tpl_vars['code']): ?>
                         <div class="post">
                             <div class="post-item">
                             <b><br />&nbsp;&nbsp;&nbsp;<font color="red"><?php echo $this->_tpl_vars['code']; ?>
</font></b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         <?php endif; ?>
                         <div class="post">

                             
                             <div class="post-item">
                                 <div class="link linkpad">
                                    <div class="left">
                                        <div class="check">
                                            <input type="checkbox" name="Settings[Friends][Always]" value="1" <?php if ($this->_tpl_vars['settings']['Friends']['Always']): ?>checked="checked"<?php endif; ?> />
                                        </div>
                                        <div>&nbsp;&nbsp;&nbsp;Automatically accept all incoming friend requests</div>
                                    </div>
                                 </div>
                                 <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>

                         </div>
                         <div class="link link-left"><a href="javascript:document.SettingsForm.submit();">Submit</a></div>
                         </form>
                     </div>
                 </div>
                 <?php endif; ?>

           <?php endif; ?>
        </div>
    </div>