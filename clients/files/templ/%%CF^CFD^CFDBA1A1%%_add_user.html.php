<?php /* Smarty version 2.6.20, created on 2008-11-26 10:54:09
         compiled from mods/admin/_add_user.html */ ?>

<div class="container">
	<div class="container-c">
		<div class="wrap">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=admin">Administration</a> | <?php if ($this->_tpl_vars['id']): ?>Edit<?php else: ?>Add<?php endif; ?> user</h1>

			<div class="b-form">
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
							
                <form name="fma" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php" enctype="multipart/form-data">
				<input type="hidden" name="mod" value="add_user" />
	            <?php if (0 < $this->_tpl_vars['id']): ?>
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
				<?php endif; ?>

				<label>First Name</label>
				<input type="text" name="einfo[name]" value="<?php echo $this->_tpl_vars['einfo']['name']; ?>
" class="input w350" />
				<div class="spacer s20"><!-- --></div>
							
				<label>Last Name</label>
				<input type="text" name="einfo[lname]" value="<?php echo $this->_tpl_vars['einfo']['lname']; ?>
" class="input w350" />
				<div class="spacer s20"><!-- --></div>							
							
				<label>E-mail</label>
				<input type="text" name="einfo[email]" value="<?php echo $this->_tpl_vars['einfo']['email']; ?>
" class="input w430" />
				<div class="spacer s20"><!-- --></div>

				<label>User name</label>
				<input type="text" name="einfo[login]" value="<?php echo $this->_tpl_vars['einfo']['login']; ?>
" class="input w350"<?php if ($this->_tpl_vars['einfo']['login'] == 'admin'): ?> readonly="true"<?php endif; ?> />
				<div class="spacer s3"><!-- --></div>
				Use only letters and numbers. Must be<br />between 4 and 20 characters long.
				<div class="spacer s20"><!-- --></div>

				<?php if (! $this->_tpl_vars['id']): ?>		
				<label>Password</label>					
				<input type="password" name="einfo[pass]" value="<?php if (! $this->_tpl_vars['pass_err']): ?><?php echo $this->_tpl_vars['einfo']['pass']; ?>
<?php endif; ?>" class="input w350" />
				<div class="spacer s20"><!-- --></div>
				<label>Confirm Password</label>		
				<input type="password" name="einfo[pass2]" value="<?php if (! $this->_tpl_vars['pass_err']): ?><?php echo $this->_tpl_vars['einfo']['pass2']; ?>
<?php endif; ?>" class="input w350" />
                <div class="spacer s20"><!-- --></div>
				<?php else: ?>
				<label>Password</label>					
				<input type="password" name="einfo[pass]" value="" class="input w350" />
				<div class="spacer s20"><!-- --></div>
				<label>Confirm Password</label>		
				<input type="password" name="einfo[pass2]" value="" class="input w350" />
		        <div class="spacer s3"><!-- --></div>
				Do not change a field with the password if you don't want to change the password	
                <div class="spacer s20"><!-- --></div>						
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['einfo']['login'] == 'admin'): ?>
				<input type="hidden" name="einfo[status]" value="0" />
				<?php else: ?>
				<label>User Type</label>
				<select name="einfo[status]">
				    <?php $_from = $this->_tpl_vars['status_ar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
					<option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['einfo']['status']): ?> selected="selected"<?php elseif (( '' == $this->_tpl_vars['einfo']['status'] ) && 1 == $this->_tpl_vars['k']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
            	</select>
				<div class="spacer s20"><!-- --></div>	
				<?php endif; ?>
				<label>Assign to project</label>
				<?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
				<?php $this->assign('ov', $this->_tpl_vars['i']['id']); ?>
				<input type="checkbox" name="einfo[proj][<?php echo $this->_tpl_vars['ov']; ?>
]" value="1"<?php if ($this->_tpl_vars['einfo']['proj'][$this->_tpl_vars['ov']]): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_tpl_vars['i']['name']; ?>
<br />
				<?php endforeach; endif; unset($_from); ?>
				<div class="spacer s20"><!-- --></div>
                
				<label>User Photo</label>
				<input type="file" name="upl" /><?php if ($this->_tpl_vars['einfo']['image']): ?> <img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
/<?php echo $this->_tpl_vars['einfo']['image']; ?>
" /> <a href="javascript: if (confirm('Delete photo?'))Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_user&id=<?php echo $this->_tpl_vars['id']; ?>
&delp=1');">Delete</a><?php endif; ?>
				<div class="spacer s20"><!-- --></div>
				<a href="javascript: document.fma.submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
<?php if (! $this->_tpl_vars['id']): ?>b-create.gif<?php else: ?>b-update.gif<?php endif; ?>" alt="Submit" /></a>
				&nbsp;<a href="javascript: document.location='<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=users';"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-cancel.gif" alt="" /></a>
			    </form>
			</div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>