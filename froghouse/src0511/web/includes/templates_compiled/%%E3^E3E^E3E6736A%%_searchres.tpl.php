<?php /* Smarty version 2.6.12, created on 2006-05-04 03:01:16
         compiled from mods/culture/_searchres.tpl */ ?>
    <div class="maincontainer">
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/culture/_left_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  	    <div class="rightpart">

            <div class="title-block"><div>Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
					   <?php if ($this->_tpl_vars['_text'] <> ''): ?>
					   <?php echo $this->_tpl_vars['_text']; ?>

					   <?php endif; ?>
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
                       <div class="item"><a href="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['title']; ?>
</a></div>
                       <?php endfor; endif; ?>
                    </div>
					<div class="link linkpad"><div class="left"><div></div></div><?php echo $this->_tpl_vars['_pagging']; ?>
</div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

        </div>
    <div class="spacer"><!-- --></div>
    </div>		
		