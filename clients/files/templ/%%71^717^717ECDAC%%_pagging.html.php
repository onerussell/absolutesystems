<?php /* Smarty version 2.6.20, created on 2008-11-25 10:10:51
         compiled from mods/_pagging.html */ ?>

<table border="0" cellpadding="5" cellspacing="5">
<tr>

<td class="black" align="center" bgcolor="#edeef0" width="15"><?php if ($this->_tpl_vars['lfirst']): ?><a href="<?php echo $this->_tpl_vars['lfirst']; ?>
">First</a><?php else: ?>First<?php endif; ?></td>


<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['pages'][$this->_sections['i']['index']]['page']): ?>
 <td align="center" bgcolor="#6EB4EE" width="15"><font color="#ffffff"><b><?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]['page']; ?>
</b></font></td>
<?php else: ?>
<td class="black" align="center" bgcolor="#edeef0" width="15"><a href="<?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]['page']; ?>
</a></td>
<?php endif; ?>
<?php endfor; endif; ?>


<td class="black" align="center" bgcolor="#edeef0" width="15"><?php if ($this->_tpl_vars['llast']): ?><a href="<?php echo $this->_tpl_vars['llast']; ?>
">Last:<?php else: ?>Last<?php endif; ?></a></td>



</tr>
</table>