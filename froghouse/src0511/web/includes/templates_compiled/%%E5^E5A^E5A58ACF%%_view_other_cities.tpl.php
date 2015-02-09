<?php /* Smarty version 2.6.12, created on 2006-05-09 09:58:52
         compiled from mods/_view_other_cities.tpl */ ?>
    <div class="maincontainer">
        <div class="leftpart">

            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Here you can choose other city
                            <div class="spacer s15"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="rightpart">

            <?php if ($this->_tpl_vars['iso2_cntr'] != ''): ?>
            <div class="title-block"><div>Choose City</div></div>
            <div class="block">
                <div class="pad">
                    <div class="city-list">
                    <?php unset($this->_sections['iic']);
$this->_sections['iic']['name'] = 'iic';
$this->_sections['iic']['loop'] = is_array($_loop=$this->_tpl_vars['cities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/industry.png" alt="" width="32" height="32" border="0" /> &nbsp;<?php if ($this->_tpl_vars['UserInfoCurrentCity'] != $this->_tpl_vars['cities'][$this->_sections['iic']['index']]['city_id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=<?php echo $this->_tpl_vars['mod']; ?>
&amp;iso2_cntr=<?php echo $this->_tpl_vars['iso2_cntr']; ?>
&amp;city_id=<?php echo $this->_tpl_vars['cities'][$this->_sections['iic']['index']]['city_id']; ?>
"><?php echo $this->_tpl_vars['cities'][$this->_sections['iic']['index']]['name']; ?>
</a><?php else: ?><b><?php echo $this->_tpl_vars['cities'][$this->_sections['iic']['index']]['name']; ?>
</b><?php endif; ?><br />
                    <?php endfor; endif; ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="title-block"><div>Choose Country</div></div>
            <div class="block">
                <div class="pad">
                    <div class="city-list">
                    <?php unset($this->_sections['iic']);
$this->_sections['iic']['name'] = 'iic';
$this->_sections['iic']['loop'] = is_array($_loop=$this->_tpl_vars['countries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/world.png" alt="" width="16" height="16" border="0" /> &nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=<?php echo $this->_tpl_vars['mod']; ?>
&amp;iso2_cntr=<?php echo $this->_tpl_vars['countries'][$this->_sections['iic']['index']]['iso2']; ?>
"><?php echo $this->_tpl_vars['countries'][$this->_sections['iic']['index']]['name']; ?>
</a><br />
                    <?php endfor; endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>


        </div>
    </div>