<?php /* Smarty version 2.6.12, created on 2006-05-02 15:56:53
         compiled from mods/nightlife/_add_comment.tpl */ ?>
            <div class="title-block"><div><?php echo $this->_tpl_vars['add_title']; ?>
</div></div>
                        <div class="block">
                                <div class="pad">
                                        <form <?php echo $this->_tpl_vars['fdata']['attributes']; ?>
>
                                        <div class="form">
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
                                                <div class="spacer"><!-- --></div>
                                                <div class="name"><div><?php echo $this->_config[0]['vars']['pfrom']; ?>
:</div></div><div class="inp"><div><a href="#"><?php echo $this->_tpl_vars['nickname']; ?>
</a></div></div>
                                                <div class="spacer s9"><!-- --></div>
                                                <div class="name"><div>Rate:</div></div><div class="inp"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/nightlife/_rate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
                                                <div class="spacer s9"><!-- --></div>
                                                <div class="name"><div><br><?php echo $this->_config[0]['vars']['pmessage']; ?>
:</div></div><div class="inp"> <?php unset($this->_sections['i']);
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
 if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'textarea'):  echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html'];  endif;  endfor; endif; ?></div>
                                                <div class="spacer"><!-- --></div>
                                        </div>
                                        </div>

                                        <div class="spacer s9"><!-- --></div>
                                        <div class="link link-left"><a href="#" onclick="document.eform.submit();return false;"><?php echo $this->_config[0]['vars']['post_it']; ?>
</a></div>
                                        </form>
                                </div>
                        </div>