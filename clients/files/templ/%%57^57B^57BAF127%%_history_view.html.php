<?php /* Smarty version 2.6.20, created on 2008-11-25 10:33:39
         compiled from mods/project/_history_view.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'mods/project/_history_view.html', 27, false),)), $this); ?>
<div class="container">
	<div class="container-c">
		<div class="wrap">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_logout.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	    	<div class="menu-right">
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
">work view</a>
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/history" class="on">history view</a>
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/map">sitemap view</a>
			</div>
			<h1><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
">Projects</a> | <?php echo $this->_tpl_vars['pg']['name']; ?>
</h1>
  
			<div class="admin-list-func">
				<div class="w205"><?php if ($this->_tpl_vars['UserInfo']['status'] != 1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php?mod=add_screen&id=<?php echo $this->_tpl_vars['pg']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-plus.gif" alt="" />Add Screen</a><?php endif; ?></div>
			</div>	

			<div class="spacer s20"><!-- --></div>
			<?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
			<?php if ($this->_tpl_vars['i']['first'] == 1): ?>
			<?php $this->assign('ov', 0); ?>
			<?php if (! ($this->_foreach['n']['iteration'] <= 1)): ?>
			<div class="spacer s15"><!-- --></div>
			<div class="spacer line"><!-- --></div>
			<div class="spacer s15"><!-- --></div>
			<?php endif; ?>
			<h3><?php if ($this->_tpl_vars['sc_id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
">Overview</a> / <?php endif; ?><?php echo $this->_tpl_vars['i']['name']; ?>
</h3>
			<?php endif; ?>
			<?php echo smarty_function_math(array('assign' => 'ov','equation' => "x + 1",'x' => $this->_tpl_vars['ov']), $this);?>

			<div class="screen-list<?php if ($this->_tpl_vars['ov'] % 4 == 0): ?> screen-list-l<?php endif; ?>">
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['pg']['link']; ?>
/<?php echo $this->_tpl_vars['i']['link']; ?>
"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
<?php echo $this->_tpl_vars['image_dir']; ?>
<?php if ($this->_tpl_vars['i']['is_approve']): ?><?php echo $this->_tpl_vars['resize_dir_ok']; ?>
<?php elseif ($this->_tpl_vars['i']['is_new']): ?><?php echo $this->_tpl_vars['resize_dir_new']; ?>
<?php else: ?><?php echo $this->_tpl_vars['resize_dir']; ?>
<?php endif; ?>/m_<?php echo $this->_tpl_vars['i']['image']; ?>
" alt="" /></a>
				<div class="comm"><?php echo $this->_tpl_vars['i']['pdate']; ?>
<br /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php<?php if ($this->_tpl_vars['can_edit']): ?>?sid=<?php echo $this->_tpl_vars['i']['id']; ?>
#com<?php endif; ?>"><?php if ($this->_tpl_vars['can_edit'] && 1 != $this->_tpl_vars['UserInfo']['status']): ?><?php echo $this->_tpl_vars['i']['comcnt']; ?>
 comment<?php if (1 != $this->_tpl_vars['i']['comcnt']): ?>s<?php endif; ?><?php else: ?><?php echo $this->_tpl_vars['i']['clmcnt']; ?>
 comment<?php if (1 != $this->_tpl_vars['i']['clmcnt']): ?>s<?php endif; ?><?php endif; ?></a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
account.php<?php if ($this->_tpl_vars['can_edit']): ?>?sid=<?php echo $this->_tpl_vars['i']['id']; ?>
#new<?php endif; ?>">Add comment</a></div>
			</div>
			
			<?php if ($this->_tpl_vars['ov'] % 4 == 0): ?>
			<div class="spacer s10"><!-- --></div>
			<?php endif; ?>
			<?php endforeach; else: ?>
			no updates yet
			<div class="spacer s15"><!-- --></div>
			<div class="spacer line"><!-- --></div>
			<?php endif; unset($_from); ?>
			

			<div class="spacer s15"><!-- --></div>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>