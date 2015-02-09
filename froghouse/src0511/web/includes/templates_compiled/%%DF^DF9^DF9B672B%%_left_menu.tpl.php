<?php /* Smarty version 2.6.12, created on 2006-05-02 16:12:56
         compiled from mods/lodging/_left_menu.tpl */ ?>
                <div class="leftpart">

                        <div class="rightmenu m-green">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul class="me-menu">
                                                        <li<?php if ($this->_tpl_vars['block'] == ''): ?> class="on"<?php endif; ?>><span class="overview"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
">Overview</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'hostels'): ?> class="on"<?php endif; ?>><span class="hostels"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=hostels">Hostels</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'hotels'): ?> class="on"<?php endif; ?>><span class="hotels"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=hotels">Hotels</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'apartments'): ?> class="on"<?php endif; ?>><span class="appart"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=apartments">Apartments</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'campings'): ?> class="on"<?php endif; ?>><span class="camp"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=campings">Camping</a></span>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <div class="spacer s8"><!-- --></div>
                        <div class="rightmenu m-grey">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=hostels&action=add">Add a hostel review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=hotels&action=add">Add a hotel review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=apartments&action=add">Add an apartment review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=campings&action=add">Add a camping review</a>
                                                </ul>
                                        </div>
                                </div>
                        </div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/nightlife/_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>