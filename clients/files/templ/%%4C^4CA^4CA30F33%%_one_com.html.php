<?php /* Smarty version 2.6.20, created on 2008-11-26 08:41:04
         compiled from mods/project/_one_com.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'mods/project/_one_com.html', 2, false),)), $this); ?>
                <div class="comment-text" >
					<?php echo ((is_array($_tmp=$this->_tpl_vars['eform']['descr'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

					<?php if ($this->_tpl_vars['eform']['attach']): ?><br /><br /><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
i-attach.gif" alt="" />&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
files/images/<?php echo $this->_tpl_vars['eform']['attach']; ?>
" target="_blank"><?php echo $this->_tpl_vars['eform']['attach']; ?>
</a><?php endif; ?>
					<div class="spacer s10"><!-- --></div>
									</div>