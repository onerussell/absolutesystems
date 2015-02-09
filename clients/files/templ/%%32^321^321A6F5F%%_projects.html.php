<?php /* Smarty version 2.6.20, created on 2008-11-25 10:24:00
         compiled from mods/admin/_projects.html */ ?>
<div class="container">
	<div class="container-c">
		<div class="wrap">
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=admin">Administration</a> | Projects</h1>

			<table width="100%" cellpadding="5">
			 <tr>
			  <td align="right">
			   <b><a <?php if (0 == $this->_tpl_vars['prj_status']): ?>class="on"<?php endif; ?> href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects&prj_status=0">All</a> | <a <?php if (1 == $this->_tpl_vars['prj_status']): ?>class="on"<?php endif; ?> href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects&prj_status=1">Active</a> | <a <?php if (2 == $this->_tpl_vars['prj_status']): ?>class="on"<?php endif; ?> href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects&prj_status=2">Archive</a></b>	
			  </td>
			 </tr>
			</table>

            <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?> 
			<div class="main-list<?php if (($this->_foreach['n']['iteration']-1) % 2 == 0): ?> main-list-bg<?php endif; ?>">
				<div class="date"><?php echo $this->_tpl_vars['i']['last_upd']; ?>
&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_proj&amp;id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_data.gif" alt="Edit user" /> Edit</a> <a name="bb">|</a> <a href="javascript: if (confirm('Delete project?')) document.location='<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects&amp;del=<?php echo $this->_tpl_vars['i']['id']; ?>
';"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-deletes.gif" alt="Delete user" />Delete</a></div>
				<div class="info"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a></div>
			</div>
			<?php endforeach; else: ?>
			No projects
			<?php endif; unset($_from); ?>
			<div class="spacer"><!-- --></div>

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>