<?php /* Smarty version 2.6.12, created on 2006-05-03 14:24:43
         compiled from mods/photo/_delete.tpl */ ?>
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
                      <div class="link link-left"><a href="<?php echo $this->_tpl_vars['submit_link']; ?>
"><?php echo $this->_config[0]['vars']['bsubmit']; ?>
</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['cancel_link']; ?>
"><?php echo $this->_config[0]['vars']['bcancel']; ?>
</a></div>
                </div>
            </div>
        </div>
        <div class="spacer"><!-- --></div>
    </div>