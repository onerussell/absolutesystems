<?php /* Smarty version 2.6.20, created on 2008-11-25 10:10:43
         compiled from login.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'login.html', 23, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<title>engine37</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
default.css" />
<!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
for_ie.css" /><![endif]-->
</head>
<body onload="document.fmx.system_login.focus()">
<br>
<div class="container">
	<div class="container-c">
		<div class="wrap">
			<h1>Projects</h1>

			<div class="b-form">
			    <?php if ($this->_tpl_vars['authMessage']): ?>
                   <p><font color="red">
                   <?php echo $this->_tpl_vars['authMessage']; ?>

                   </font></p>
                <?php endif; ?>
                <form name="fmx" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php" method="post" enctype="application/x-www-form-urlencoded">
                <input type="hidden" name="redirectLocation" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['redirectLocation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
" />
				<label>Login</label>
				<input maxLength="21" name="system_login" value="<?php echo $this->_tpl_vars['systemLogin']; ?>
" class="input w205" />
				<div class="spacer s20"><!-- --></div>

				<label>Password</label>
				<input type="password" maxLength="21" name="system_pass"  class="input w205" value="" />
				<div class="spacer s20"><!-- --></div>
                <input type="checkbox" name="remember" value="1" /> Remember me
                <div class="spacer s20"><!-- --></div>
				<input type="image" onClick="javascript:document.fmx.submit();" src="<?php echo $this->_tpl_vars['imgDir']; ?>
b-sign.gif" value="Submit" alt="" />
				</form>
			</div>

			<div class="spacer footerspacer"><!-- --></div>
			<div class="footer"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-37.gif" alt="" /><a href="http://engine37.com">powered by engine37</a></div>
		</div>
	</div>
</div>
</body>
</html>