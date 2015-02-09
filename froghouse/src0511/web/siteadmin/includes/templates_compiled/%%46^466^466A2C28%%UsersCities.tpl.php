<?php /* Smarty version 2.6.11, created on 2006-03-30 13:40:48
         compiled from mods/UsersCities.tpl */ ?>
<select name="UserInfo[<?php echo $this->_tpl_vars['field']; ?>
]" style="font-size:12px;width:150px;" /> 
<?php unset($this->_sections['iic']);
$this->_sections['iic']['name'] = 'iic';
$this->_sections['iic']['loop'] = is_array($_loop=$this->_tpl_vars['st_ar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iic']['show'] = true;
$this->_sections['iic']['max'] = $this->_sections['iic']['loop'];
$this->_sections['iic']['step'] = 1;
$this->_sections['iic']['start'] = $this->_sections['iic']['step'] > 0 ? 0 : $this->_sections['iic']['loop']-1;
if ($this->_sections['iic']['show']) {
    $this->_sections['iic']['total'] = $this->_sections['iic']['loop'];
    if ($this->_sections['iic']['total'] == 0)
        $this->_sections['iic']['show'] = false;
} else
    $this->_sections['iic']['total'] = 0;
if ($this->_sections['iic']['show']):

            for ($this->_sections['iic']['index'] = $this->_sections['iic']['start'], $this->_sections['iic']['iteration'] = 1;
                 $this->_sections['iic']['iteration'] <= $this->_sections['iic']['total'];
                 $this->_sections['iic']['index'] += $this->_sections['iic']['step'], $this->_sections['iic']['iteration']++):
$this->_sections['iic']['rownum'] = $this->_sections['iic']['iteration'];
$this->_sections['iic']['index_prev'] = $this->_sections['iic']['index'] - $this->_sections['iic']['step'];
$this->_sections['iic']['index_next'] = $this->_sections['iic']['index'] + $this->_sections['iic']['step'];
$this->_sections['iic']['first']      = ($this->_sections['iic']['iteration'] == 1);
$this->_sections['iic']['last']       = ($this->_sections['iic']['iteration'] == $this->_sections['iic']['total']);
?>
<option value="<?php echo $this->_tpl_vars['st_ar'][$this->_sections['iic']['index']]['city_id']; ?>
" <?php if ($this->_tpl_vars['st_ar'][$this->_sections['iic']['index']]['city_id'] == $this->_tpl_vars['city_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['st_ar'][$this->_sections['iic']['index']]['name']; ?>
</option>
<?php endfor; else: ?>
<option value="0"><?php echo $this->_config[0]['vars']['notinlist']; ?>
</option>
<?php endif; ?>
</select>