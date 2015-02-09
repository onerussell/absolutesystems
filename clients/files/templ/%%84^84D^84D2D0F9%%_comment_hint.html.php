<?php /* Smarty version 2.6.20, created on 2008-11-26 07:03:45
         compiled from mods/_comment_hint.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'mods/_comment_hint.html', 7, false),array('modifier', 'truncate', 'mods/_comment_hint.html', 7, false),)), $this); ?>
<table>
<tr>
<td valign=top>
<img src="files/images/resize/m_<?php echo $this->_tpl_vars['eform']['image']; ?>
">
</td>
<td align=left valign=top>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['eform']['descr'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 450, "...") : smarty_modifier_truncate($_tmp, 450, "...")); ?>

</td>
</table>