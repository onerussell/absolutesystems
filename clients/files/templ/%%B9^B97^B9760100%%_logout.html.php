<?php /* Smarty version 2.6.20, created on 2008-11-25 10:08:51
         compiled from mods/_logout.html */ ?>
<?php if ($this->_tpl_vars['system_login']): ?>
<div style="float: right; padding-top: 5px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?logout=1"><b>Log Out</b></a></div>
<?php else: ?>
<div style="float: right; padding-top: 5px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php"><b>Sign In</b></a></div>
<?php endif; ?>