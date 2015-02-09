<?php /* Smarty version 2.6.12, created on 2006-05-09 10:05:21
         compiled from mods/_necessities-add.tpl */ ?>
	<div class="maincontainer">

	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/necessities/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	   
  	    <div class="rightpart">
			<div class="title-block"><div><?php if (! $this->_tpl_vars['mid'] || $this->_tpl_vars['mid'] == 0): ?>Add new<?php else: ?>Edit<?php endif; ?> <?php echo $this->_tpl_vars['bl_inf']['c2']; ?>
</div></div>
			<div class="block">
				<div class="pad">
					<div class="form">
					<form <?php echo $this->_tpl_vars['fdata']['attributes']; ?>
>
					<?php if ($this->_tpl_vars['fdata']['errors']): ?>
                    <?php $_from = $this->_tpl_vars['fdata']['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['err']):
?>
                        <p style="color:red">&nbsp;&nbsp;<?php echo $this->_tpl_vars['err']; ?>
</p>
                    <?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>										
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['fdata']['elements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'hidden'):  echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html'];  endif; ?> 
					<?php endfor; endif; ?>
					<div class="pad">
						<div class="field">
							<div class="name">Title:</div>
							<div class="inp"><?php echo $this->_tpl_vars['fdata']['el']['title']['html']; ?>
</div>
						</div>
						<div class="spacer s9"><!-- --></div>
						<input type="hidden" name="descr" value=" " />
                                                <div class="spacer s9"><!-- --></div>

						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['fdata']['elements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['label'] <> ''): ?>
						<div class="field">
							<div class="name"><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['label']; ?>
:</div>
							<div class="inp"><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>
</div>
						</div>
						<div class="spacer s9"><!-- --></div>
						<?php endif; ?>
						<?php endfor; endif; ?>
                        <input type="hidden" name="rate" value="" />
                                                <input type="hidden" name="image" value="" />
                        
						<?php if (! $this->_tpl_vars['uadmin'] || ( ! $this->_tpl_vars['mid'] || $this->_tpl_vars['mid'] == 0 )): ?>
						<p><b class="note">Description:</b> (this description will appear as a first post)<br>
						<div class="spacer s5"><!-- --></div>
							<div class="field">
							<div class="name"><!-- --></div>
							<div class="inp"><?php echo $this->_tpl_vars['fdata']['el']['comment']['html']; ?>
</div>
						</div>
						<?php endif; ?>
						<div class="spacer"><!-- --></div>
					</div>
					</form>
					</div>
					<div class="spacer s9"><!-- --></div>
					<div class="link link-left"><a href="#" onClick="document.eform.submit(); return false;">Post it</a>
					<?php if ($this->_tpl_vars['uadmin'] && $this->_tpl_vars['mid'] > 0): ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=<?php echo $this->_tpl_vars['block']; ?>
&mid=<?php echo $this->_tpl_vars['mid']; ?>
">Cancel</a><?php endif; ?>
					</div>
				</div>
			</div>

		</div>

	<div class="spacer"><!-- --></div>
	</div>