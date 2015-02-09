<?php /* Smarty version 2.6.12, created on 2006-05-02 01:40:41
         compiled from mods/_me_my_blog.tpl */ ?>
    <div class="maincontainer">
        <?php if ($this->_tpl_vars['is_user'] != 1 && $this->_tpl_vars['UserInfo']): ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/people/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php else: ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/blog/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
        
        <div class="rightpart">
           
            <div class="title-block"><div>My Recent Blog Entries:</div></div>
            <div class="block">
                <div class="pad">
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <div class="blog-l">
                        <div class="b-item">
                            <div class="date"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['pdate']; ?>
</div>
                            <div class="title"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['title']; ?>
</div>
                            <div class="text"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['descr']; ?>
</div>
                            <div class="link"><?php if ($this->_tpl_vars['is_user'] == 1): ?><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link_ed']; ?>
">Edit <?php echo $this->_config[0]['vars']['tmessage']; ?>
</a><span class="razd">|</span><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link_del']; ?>
"><?php echo $this->_config[0]['vars']['tdelete']; ?>
 <?php echo $this->_config[0]['vars']['tmessage']; ?>
</a><span class="razd">|</span><?php endif; ?><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link']; ?>
"><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['pcnt'] == 0):  echo $this->_config[0]['vars']['nocomments'];  else:  echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['pcnt']; ?>
 <?php echo $this->_config[0]['vars']['comments'];  endif; ?></a><span class="razd">|</span><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_config[0]['vars']['add_message']; ?>
</a></div>
                        </div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <?php endfor; endif; ?>
                    <div class="link"><?php echo $this->_tpl_vars['_pagging']; ?>
</div>
                </div>
            </div>
        </div>
        <div class="spacer"><!-- --></div>
    </div>