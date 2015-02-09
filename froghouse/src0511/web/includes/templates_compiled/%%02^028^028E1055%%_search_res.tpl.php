<?php /* Smarty version 2.6.12, created on 2006-05-07 14:57:32
         compiled from mods/_search_res.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'mods/_search_res.tpl', 30, false),)), $this); ?>
    <div class="maincontainer">
        <div class="leftpart">

            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Search result
                            <div class="spacer s8"><!-- --></div>
                            <span>&nbsp;</span>
                            <div class="spacer s15"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        
        <div class="rightpart">

           <?php if ($this->_tpl_vars['users']): ?>
            <div class="title-block"><div>People / Search Result</div></div>
            <div class="block">
                <div class="padd">
                    <div class="photo-l">

                    <?php unset($this->_sections['iiu']);
$this->_sections['iiu']['name'] = 'iiu';
$this->_sections['iiu']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iiu']['show'] = true;
$this->_sections['iiu']['max'] = $this->_sections['iiu']['loop'];
$this->_sections['iiu']['step'] = 1;
$this->_sections['iiu']['start'] = $this->_sections['iiu']['step'] > 0 ? 0 : $this->_sections['iiu']['loop']-1;
if ($this->_sections['iiu']['show']) {
    $this->_sections['iiu']['total'] = $this->_sections['iiu']['loop'];
    if ($this->_sections['iiu']['total'] == 0)
        $this->_sections['iiu']['show'] = false;
} else
    $this->_sections['iiu']['total'] = 0;
if ($this->_sections['iiu']['show']):

            for ($this->_sections['iiu']['index'] = $this->_sections['iiu']['start'], $this->_sections['iiu']['iteration'] = 1;
                 $this->_sections['iiu']['iteration'] <= $this->_sections['iiu']['total'];
                 $this->_sections['iiu']['index'] += $this->_sections['iiu']['step'], $this->_sections['iiu']['iteration']++):
$this->_sections['iiu']['rownum'] = $this->_sections['iiu']['iteration'];
$this->_sections['iiu']['index_prev'] = $this->_sections['iiu']['index'] - $this->_sections['iiu']['step'];
$this->_sections['iiu']['index_next'] = $this->_sections['iiu']['index'] + $this->_sections['iiu']['step'];
$this->_sections['iiu']['first']      = ($this->_sections['iiu']['iteration'] == 1);
$this->_sections['iiu']['last']       = ($this->_sections['iiu']['iteration'] == $this->_sections['iiu']['total']);
?>
                        <div class="p-item">
                            <div class="pic" style="height: 127px;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
/profile.html"><img src="<?php echo $this->_tpl_vars['siteAdr'];  if ($this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['res_image']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['res_image'];  elseif ($this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['name']): ?>includes/data/gallery/<?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['user_images']['name'];  else: ?>includes/templates/images/nf.gif<?php endif; ?>" width="110" alt=""></a></div>
                            <div class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
/profile.html"><?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['iiu']['index']]['nickname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp));  if ('all' == $this->_tpl_vars['stype']): ?>, <?php echo $this->_tpl_vars['users'][$this->_sections['iiu']['index']]['city_name']['city_name'];  endif; ?></a></div>
                        </div>
                    <?php endfor; endif; ?>
                    </div>
                                        <div class="link linkpad"><div class="left"><div></div></div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/search/?do=1&srh=<?php echo $this->_tpl_vars['sstr']; ?>
&stype=all">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           <?php endif; ?>

           <?php if ($this->_tpl_vars['list']['nightlife']): ?>
            <div class="title-block"><div>Nightlife / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']['nightlife']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                       <div class="item"><a href="<?php echo $this->_tpl_vars['list']['nightlife'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list']['nightlife'][$this->_sections['i']['index']]['title']; ?>
</a></div>
                       <?php endfor; endif; ?>
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=nightlife&action=search&sstr=<?php echo $this->_tpl_vars['sstr']; ?>
&stype=<?php echo $this->_tpl_vars['stype']; ?>
">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           <?php endif; ?>

           <?php if ($this->_tpl_vars['list']['culture']): ?>
            <div class="title-block"><div>Culture / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']['culture']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                       <div class="item"><a href="<?php echo $this->_tpl_vars['list']['culture'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list']['culture'][$this->_sections['i']['index']]['title']; ?>
</a></div>
                       <?php endfor; endif; ?>
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=culture&action=search&sstr=<?php echo $this->_tpl_vars['sstr']; ?>
&stype=<?php echo $this->_tpl_vars['stype']; ?>
">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           <?php endif; ?>

           <?php if ($this->_tpl_vars['list']['food']): ?>
            <div class="title-block"><div>Food / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']['food']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                       <div class="item"><a href="<?php echo $this->_tpl_vars['list']['food'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list']['food'][$this->_sections['i']['index']]['title']; ?>
</a></div>
                       <?php endfor; endif; ?>
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=food&action=search&sstr=<?php echo $this->_tpl_vars['sstr']; ?>
&stype=<?php echo $this->_tpl_vars['stype']; ?>
">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
            <?php endif; ?>

           <?php if ($this->_tpl_vars['list']['lodging']): ?>
            <div class="title-block"><div>Lodging / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']['lodging']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                       <div class="item"><a href="<?php echo $this->_tpl_vars['list']['lodging'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list']['lodging'][$this->_sections['i']['index']]['title']; ?>
</a></div>
                       <?php endfor; endif; ?>
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=lodging&action=search&sstr=<?php echo $this->_tpl_vars['sstr']; ?>
&stype=<?php echo $this->_tpl_vars['stype']; ?>
">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
            <?php endif; ?>

           <?php if ($this->_tpl_vars['list']['necessities']): ?>
            <div class="title-block"><div>Necessities / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']['necessities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                       <div class="item"><a href="<?php echo $this->_tpl_vars['list']['necessities'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['list']['necessities'][$this->_sections['i']['index']]['title']; ?>
</a></div>
                       <?php endfor; endif; ?>
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=necessities&action=search&sstr=<?php echo $this->_tpl_vars['sstr']; ?>
&stype=<?php echo $this->_tpl_vars['stype']; ?>
">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           <?php endif; ?>


        </div>

    <div class="spacer"><!-- --></div>
    </div>