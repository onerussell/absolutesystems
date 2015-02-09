<?php /* Smarty version 2.6.12, created on 2006-05-02 02:48:32
         compiled from mods/me/_friends.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'mods/me/_friends.tpl', 17, false),)), $this); ?>
    <div class="maincontainer">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/me/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div class="rightpart">

           <?php if (! $this->_tpl_vars['action'] || $this->_tpl_vars['action'] == 'overview'): ?>
               <div class="rightpart">
                   <div class="title-block"><div>My Friends<?php if ($this->_tpl_vars['users_cnt']): ?> (<?php echo $this->_tpl_vars['users_cnt']; ?>
)<?php endif; ?></div></div>
                   <?php if ($this->_tpl_vars['ErrMessage']): ?><font color="red"><?php echo $this->_tpl_vars['ErrMessage']; ?>
</font><?php endif; ?>
                   <div class="block">
                       <div class="padd">
                           <div class="link linkpad"><div class="left"><?php if ('recently_added' == $this->_tpl_vars['order']): ?><div class="b">Recently Added</div><?php else: ?><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends&amp;order=recently_added">Recently Added</a></div><?php endif;  if ('all' == $this->_tpl_vars['order']): ?><div class="b_">All</div><?php else: ?><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends&amp;order=nickname">All</a></div><?php endif; ?></div><?php if ('all' == $this->_tpl_vars['order']):  if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends&amp;order=<?php echo $this->_tpl_vars['order']; ?>
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
, <?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['city_name']['city_name']; ?>
</a></div>
                               </div>
                               <?php if ($this->_sections['iiu']['rownum'] % 4 == 0 && ! $this->_sections['last']): ?>
                               <div class="spacer s6"><!-- --></div>
                               <?php endif; ?>
                           <?php endfor; endif; ?>
                           </div>
                           <div class="spacer s9"><!-- --></div>
                           <div class="link linkpad"><?php if ('all' == $this->_tpl_vars['order']):  if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
" class="b">Previous</a><?php else: ?><span>Previous</span><?php endif; ?>&nbsp;&nbsp;&nbsp;Page <?php echo $this->_tpl_vars['curPage']+1; ?>
 of <?php if ($this->_tpl_vars['pages'] == 0): ?>1<?php else:  echo $this->_tpl_vars['pages'];  endif; ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends&amp;order=<?php echo $this->_tpl_vars['order']; ?>
&amp;pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
" class="b">Next</a><?php else: ?><span>Next</span><?php endif;  endif; ?></div>
                       </div>
                   </div>
        
               </div>
           <?php endif; ?>
        </div>
    </div>