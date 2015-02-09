<?php /* Smarty version 2.6.12, created on 2006-05-02 14:38:45
         compiled from mods/_culture_overview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'mods/_culture_overview.tpl', 20, false),)), $this); ?>
	<div class="maincontainer">
       
	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/culture/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		<div class="rightpart">
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			<div class="title-block"><div>Recent <?php echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['title']; ?>
 Reviews</div></div>
			<div class="block">
				<div class="pad">
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list'][$this->_sections['j']['index']]['pd']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
					<div class="item">
						<div class="name"><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['pd'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['pd'][$this->_sections['i']['index']]['title']; ?>
</a></div>
						<div class="frog"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-<?php echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['pd'][$this->_sections['i']['index']]['rate']; ?>
.gif" alt=""></div>
						<div class="comm"><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['pd'][$this->_sections['i']['index']]['link']; ?>
"><?php if ($this->_tpl_vars['list'][$this->_sections['j']['index']]['pd'][$this->_sections['i']['index']]['pcnt'] == 0):  echo $this->_config[0]['vars']['nocomments'];  else:  echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['pd'][$this->_sections['i']['index']]['pcnt']; ?>
 <?php echo $this->_config[0]['vars']['comments'];  endif; ?></a></div>
						<div class="spacer"><!-- --></div>
					</div>
					<div class="spacer s9"><!-- --></div>
                    <?php endfor; endif; ?>

					<div class="link"><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['link']; ?>
">View all <?php echo ((is_array($_tmp=$this->_tpl_vars['list'][$this->_sections['j']['index']]['title'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 reviews (<?php echo $this->_tpl_vars['list'][$this->_sections['j']['index']]['cnt']; ?>
)</a></div>
				</div>
			</div>

			<div class="spacer s8"><!-- --></div>
            <?php endfor; endif; ?>
		</div>

	<div class="spacer"><!-- --></div>
	</div>