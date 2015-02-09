<?php /* Smarty version 2.6.20, created on 2008-11-26 10:54:21
         compiled from mods/admin/_users.html */ ?>
<div class="container">
	<div class="container-c">
		<div class="wrap">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    		<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=admin">Administration</a> | Users</h1>
            <?php $_from = $this->_tpl_vars['ul']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?> 
			<div class="main-list <?php if (($this->_foreach['n']['iteration']-1) % 2 == 0): ?>main-list-bg<?php endif; ?> <?php if ($this->_tpl_vars['i']['image']): ?>main-list-img<?php endif; ?>">
				<div class="date"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_user&amp;id=<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_data.gif" alt="Edit user" />Edit</a> &nbsp; <?php if (1 != $this->_tpl_vars['i']['uid']): ?> <a name="bb"> </a> <a href="javascript: if (confirm('Delete user?')) <?php echo '{'; ?>
 document.location = '<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=users&amp;del=<?php echo $this->_tpl_vars['i']['uid']; ?>
';<?php echo '}'; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-deletes.gif" alt="Delete user" />Delete</a><?php endif; ?></div>
				<div class="fio"><?php if ($this->_tpl_vars['ov'] != $this->_tpl_vars['i']['status']): ?><?php $this->assign('ov', $this->_tpl_vars['i']['status']); ?><?php echo $this->_tpl_vars['status_ar'][$this->_tpl_vars['ov']]; ?>
s<?php endif; ?></div>
				<div class="avatar"><?php if ($this->_tpl_vars['i']['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_user&amp;id=<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['i']['image']; ?>
"/></a><?php endif; ?></div>
				<div class="fio-info"><b>[<?php echo $this->_tpl_vars['i']['login']; ?>
]</b> <?php echo $this->_tpl_vars['i']['name']; ?>
 <?php echo $this->_tpl_vars['i']['lname']; ?>
</div>
			</div>
			<?php endforeach; endif; unset($_from); ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>