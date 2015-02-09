<?php /* Smarty version 2.6.12, created on 2006-05-08 11:37:33
         compiled from mods/AdminPanelAuthentication.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mods/AdminPanelAuthentication.tpl', 3, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?php echo ((is_array($_tmp=$this->_tpl_vars['supportSiteName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - Administration Panel - Authentication</title>
<meta http-equiv="Content-Type" content="text/HTML; charset=<?php echo $this->_tpl_vars['charset']; ?>
" /> 
<style>input <?php echo '{
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
select {
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
textarea {
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
a {
    color: #4f76b3; text-decoration: none
}
a:hover {
    color: #4f76b3; text-decoration: none
}
a:active {
    color: #4f76b3; text-decoration: none
}
a:visited {
    color: #4f76b3; text-decoration: none
}
body {
    font: 11px verdana
}
td {
    font: 11px verdana
}'; ?>

</style>
</head>
<body bgColor="#ffffff" leftMargin="50" rightMargin="50" marginwidth="50" marginheight="50" onLoad="window.defaultStatus='Authentification'">
<br /><br /><br /><br /><br /><br /><br />
<center>
<?php if ($this->_tpl_vars['authMessage']): ?>
<p><font color="red">
<?php echo $this->_tpl_vars['authMessage']; ?>

</font></p>
<?php endif; ?>
<form action="<?php echo $this->_tpl_vars['curScriptName']; ?>
" method="post" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="redirectLocation" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['redirectLocation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
" />
<table cellSpacing="1" cellPadding="6" align="center" bgColor="#c0c0c0" border="0">
  <tbody><tr bgColor="#ffffff">
    <td width="40%">Login:</td>
    <td align="center" width="60%"><input maxLength="21" name="system_login" value="<?php echo $this->_tpl_vars['systemLogin']; ?>
" /></td></tr>
  <tr bgColor="#ffffff">
    <td width="40%">Password:</td>
    <td align="center" width="60%"><input type="password" maxLength="21" name="system_pass" value="" /></td></tr>
  <tr bgColor="#ffffff">
    <td align="center" colSpan="2"><br /><input type="submit" value=" enter " /><br /><br /></td></tr></tbody></table></form>

</center><br /><br /></body></html>