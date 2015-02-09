<?php /* Smarty version 2.6.12, created on 2006-05-04 21:16:41
         compiled from mods/_lodging.tpl */ ?>
	<div class="maincontainer">

	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/lodging/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

   	    <div class="rightpart">
			<div class="title-block"><div><?php echo $this->_tpl_vars['bl_inf']['c1']; ?>
 Reviews</div></div>
			<div class="block">
				<div class="padd">
					<div class="link linkpad"><div class="left"><div class="b"><a href="<?php echo $this->_tpl_vars['lsort'][0]; ?>
" <?php if ($this->_tpl_vars['psort'] == '1a' || $this->_tpl_vars['psort'] == '1b'): ?>style="color:#677569"<?php endif; ?>>Recent</a></div>
					                                            <div class="bs"><a href="<?php echo $this->_tpl_vars['lsort'][1]; ?>
"<?php if ($this->_tpl_vars['psort'] == '2a' || $this->_tpl_vars['psort'] == '2b'): ?>style="color:#677569"<?php endif; ?>>By Rank</a></div>
																<div><a href="<?php echo $this->_tpl_vars['lsort'][2]; ?>
"<?php if ($this->_tpl_vars['psort'] == '3a' || $this->_tpl_vars['psort'] == '3b'): ?>style="color:#677569"<?php endif; ?>>All</a></div></div><?php echo $this->_tpl_vars['_pagging']; ?>
</div>
					<div class="spacer s9"><!-- --></div>
				<div class="paddl">
                   <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<div class="name"><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['title']; ?>
</a></div>
						<div class="frog"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/frog-<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['rate']; ?>
.gif" alt=""></div>
						<div class="comm"><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link']; ?>
"><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['pcnt'] == 0):  echo $this->_config[0]['vars']['nocomments'];  else:  echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['pcnt']; ?>
 <?php echo $this->_config[0]['vars']['comments'];  endif; ?></a></div>
						<div class="spacer"><!-- --></div>
					</div>
					<div class="spacer s9"><!-- --></div>
				   <?php endfor; endif; ?>
				</div>
					<div class="link linkpad"><?php echo $this->_tpl_vars['_pagging']; ?>
</div>
				</div>
			</div>

		</div>

	<div class="spacer"><!-- --></div>
	</div>