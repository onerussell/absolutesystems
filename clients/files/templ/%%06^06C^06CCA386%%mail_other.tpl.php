<?php /* Smarty version 2.6.20, created on 2008-11-25 10:16:26
         compiled from mails/mail_other.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'mails/mail_other.tpl', 8, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>e37 notification</title>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" /> 
<?php if ($this->_tpl_vars['link']): ?>Link: <a href="<?php echo $this->_tpl_vars['link']; ?>
"><?php echo $this->_tpl_vars['link']; ?>
</a><?php endif; ?></br>

<div style="background:#FAFAD2;width:500px">
<?php echo ((is_array($_tmp=$this->_tpl_vars['comment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

</div>