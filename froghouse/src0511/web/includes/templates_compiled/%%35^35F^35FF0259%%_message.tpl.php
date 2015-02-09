<?php /* Smarty version 2.6.12, created on 2006-05-03 14:24:46
         compiled from mods/photo/_message.tpl */ ?>
    <div class="maincontainer">
        <?php if ($this->_tpl_vars['is_user'] != 1 && $this->_tpl_vars['UserInfo']): ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/people/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php else: ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/photo/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>

        <div class="rightpart">

            <div class="title-block"><div><?php echo $this->_tpl_vars['dtext']; ?>
</div></div>
            <div class="block">
                 <div class="pad">
                      <div class="link link-left"><a href="<?php echo $this->_tpl_vars['back_link']; ?>
"><?php echo $this->_tpl_vars['btext']; ?>
</a></div>
                </div>
            </div>
        </div>
        <div class="spacer"><!-- --></div>
    </div>