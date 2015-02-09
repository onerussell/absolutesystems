<?php /* Smarty version 2.6.12, created on 2006-05-08 11:37:42
         compiled from mods/History.tpl */ ?>
<?php echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2" height="3"><img height="3" border="0" /></td></tr><tr><td colspan="2" height="450" align="left" valign="top" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="5"></td></tr><tr><td><br />';  if ($this->_tpl_vars['action'] == 'view' && $this->_tpl_vars['what'] == 'list'):  echo '<h2>History</h2><a href="';  echo $this->_tpl_vars['curScriptName'];  echo '?action=delete&what=all&start_date=';  echo $this->_tpl_vars['start_date'];  echo '&end_date=';  echo $this->_tpl_vars['end_date'];  echo '&pvstart=';  echo $this->_tpl_vars['pvstart'];  echo '" onClick="return confirmLink(this, \'';  echo $this->_config[0]['vars']['confirm'];  echo ' clear history?\');" ><b>Clear history</b></a><br /><br /><table cellSpacing="2" cellPadding="0" border="0" width="100%" bgcolor="#FFFFFF" ><tr bgcolor="#DDDEDF" align="center" vAlign="middle" height="20"><td>&nbsp;<b>Date</b>&nbsp;</td><td>&nbsp;<b>Action type</b>&nbsp;</td><td>&nbsp;<b>What</b>&nbsp;</td><td>&nbsp;<b>User</b>&nbsp;</td><td>&nbsp;<b>IP</b>&nbsp;</td><td><b>&nbsp;Actions&nbsp;</b></td></tr>';  unset($this->_sections['iif']);
$this->_sections['iif']['name'] = 'iif';
$this->_sections['iif']['loop'] = is_array($_loop=$this->_tpl_vars['HA']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iif']['show'] = true;
$this->_sections['iif']['max'] = $this->_sections['iif']['loop'];
$this->_sections['iif']['step'] = 1;
$this->_sections['iif']['start'] = $this->_sections['iif']['step'] > 0 ? 0 : $this->_sections['iif']['loop']-1;
if ($this->_sections['iif']['show']) {
    $this->_sections['iif']['total'] = $this->_sections['iif']['loop'];
    if ($this->_sections['iif']['total'] == 0)
        $this->_sections['iif']['show'] = false;
} else
    $this->_sections['iif']['total'] = 0;
if ($this->_sections['iif']['show']):

            for ($this->_sections['iif']['index'] = $this->_sections['iif']['start'], $this->_sections['iif']['iteration'] = 1;
                 $this->_sections['iif']['iteration'] <= $this->_sections['iif']['total'];
                 $this->_sections['iif']['index'] += $this->_sections['iif']['step'], $this->_sections['iif']['iteration']++):
$this->_sections['iif']['rownum'] = $this->_sections['iif']['iteration'];
$this->_sections['iif']['index_prev'] = $this->_sections['iif']['index'] - $this->_sections['iif']['step'];
$this->_sections['iif']['index_next'] = $this->_sections['iif']['index'] + $this->_sections['iif']['step'];
$this->_sections['iif']['first']      = ($this->_sections['iif']['iteration'] == 1);
$this->_sections['iif']['last']       = ($this->_sections['iif']['iteration'] == $this->_sections['iif']['total']);
 echo '<tr align="center" vAlign="middle" height="35" bgColor="#ECEEF1"><td>&nbsp;';  echo $this->_tpl_vars['HA'][$this->_sections['iif']['index']]['date_f'];  echo '&nbsp;</td><td>&nbsp;';  echo $this->_tpl_vars['HA'][$this->_sections['iif']['index']]['action'];  echo '&nbsp;</td><td>&nbsp;';  echo $this->_tpl_vars['HA'][$this->_sections['iif']['index']]['what'];  echo '&nbsp;</td><td>&nbsp;<b>';  echo $this->_tpl_vars['HA'][$this->_sections['iif']['index']]['login'];  echo '</b>&nbsp;</td><td>&nbsp;';  echo $this->_tpl_vars['HA'][$this->_sections['iif']['index']]['ip'];  echo '&nbsp;</td><td width="70"><a href="';  echo $this->_tpl_vars['curScriptName'];  echo '?action=delete&what=record&id=';  echo $this->_tpl_vars['HA'][$this->_sections['iif']['index']]['id'];  echo '&start_date=';  echo $this->_tpl_vars['start_date'];  echo '&end_date=';  echo $this->_tpl_vars['end_date'];  echo '&pvstart=';  echo $this->_tpl_vars['pvstart'];  echo '" onClick="return confirmLink(this, \'';  echo $this->_config[0]['vars']['confirm'];  echo ' delete this record?\');" ><img alt="Delete" src="';  echo $this->_tpl_vars['siteAdmin'];  echo 'templates/images/b_drop.png" border="0" width="16" height="16" /></a></td></tr>';  endfor; endif;  echo '';  if ($this->_tpl_vars['pages'] > 1):  echo '<tr><td colSpan="8" align="right">';  if ($this->_tpl_vars['curPage'] > 0):  echo '<a href="';  echo $this->_tpl_vars['curScriptName'];  echo '?action=view&what=list&start_date=';  echo $this->_tpl_vars['start_date'];  echo '&end_date=';  echo $this->_tpl_vars['end_date'];  echo '&pvstart=';  echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage'];  echo '">&lt;&lt;&lt;</a>';  endif;  echo '&nbsp;Page <select name="pvstart" style="font-size:8.5px" onChange="self.location=\'';  echo $this->_tpl_vars['curScriptName'];  echo '?action=view&what=list&start_date=';  echo $this->_tpl_vars['start_date'];  echo '&end_date=';  echo $this->_tpl_vars['end_date'];  echo '&pvstart=\'+ this.options[this.selectedIndex].value">';  unset($this->_sections['pg']);
$this->_sections['pg']['name'] = 'pg';
$this->_sections['pg']['loop'] = is_array($_loop=$this->_tpl_vars['pgArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pg']['show'] = true;
$this->_sections['pg']['max'] = $this->_sections['pg']['loop'];
$this->_sections['pg']['step'] = 1;
$this->_sections['pg']['start'] = $this->_sections['pg']['step'] > 0 ? 0 : $this->_sections['pg']['loop']-1;
if ($this->_sections['pg']['show']) {
    $this->_sections['pg']['total'] = $this->_sections['pg']['loop'];
    if ($this->_sections['pg']['total'] == 0)
        $this->_sections['pg']['show'] = false;
} else
    $this->_sections['pg']['total'] = 0;
if ($this->_sections['pg']['show']):

            for ($this->_sections['pg']['index'] = $this->_sections['pg']['start'], $this->_sections['pg']['iteration'] = 1;
                 $this->_sections['pg']['iteration'] <= $this->_sections['pg']['total'];
                 $this->_sections['pg']['index'] += $this->_sections['pg']['step'], $this->_sections['pg']['iteration']++):
$this->_sections['pg']['rownum'] = $this->_sections['pg']['iteration'];
$this->_sections['pg']['index_prev'] = $this->_sections['pg']['index'] - $this->_sections['pg']['step'];
$this->_sections['pg']['index_next'] = $this->_sections['pg']['index'] + $this->_sections['pg']['step'];
$this->_sections['pg']['first']      = ($this->_sections['pg']['iteration'] == 1);
$this->_sections['pg']['last']       = ($this->_sections['pg']['iteration'] == $this->_sections['pg']['total']);
 echo '<option value="';  echo $this->_tpl_vars['pgArr'][$this->_sections['pg']['index']];  echo '" ';  if ($this->_tpl_vars['pgArr'][$this->_sections['pg']['index']] == $this->_tpl_vars['pvstart']):  echo 'selected="selected"';  endif;  echo '>';  echo $this->_sections['pg']['rownum'];  echo '</option>';  endfor; endif;  echo '</select> from ';  echo $this->_tpl_vars['pages'];  echo '';  if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1):  echo '&nbsp;<a href="';  echo $this->_tpl_vars['curScriptName'];  echo '?action=view&what=list&start_date=';  echo $this->_tpl_vars['start_date'];  echo '&end_date=';  echo $this->_tpl_vars['end_date'];  echo '&pvstart=';  echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage'];  echo '">&gt;&gt;&gt;</a>';  endif;  echo '</td></tr>';  endif;  echo '</table>';  endif;  echo '</td></tr></table></td><td width="250"></td></tr></table></td></tr></table>'; ?>