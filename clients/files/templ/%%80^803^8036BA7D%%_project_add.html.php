<?php /* Smarty version 2.6.20, created on 2008-11-26 10:54:55
         compiled from mods/admin/_project_add.html */ ?>
<div class="container">
	<div class="container-c">
		<div class="wrap">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=admin">Administration</a> | Add project</h1>
				
				<?php if ($this->_tpl_vars['errs']): ?>
				    <font color="#990000">
					<b>Errors:</b><br />
					<?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					    - <?php echo $this->_tpl_vars['item']; ?>
<br />
					<?php endforeach; endif; unset($_from); ?>
					</font>
					<div class="spacer s15"><!-- --></div>
				<?php endif; ?>
				
            <form method="post" name="fmx" id="fmx" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php">
			<input type="hidden" name="mod" value="add_proj" />
			<div class="b-form">
				<label>Project name</label>
				<input type="text" name="eform[name]" class="input w350" />
				<div class="spacer s20"><!-- --></div>
			</div>	
			<div class="b-form">
				<div class="spacer s5"><!-- --></div>
				<a href="javascript: document.fmx.submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-create.gif" alt="" /></a>
				&nbsp;<a href="javascript: document.location='<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=projects';"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-cancel.gif" alt="" /></a>
			</div>
            </form>
			<br />
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>