<?php /* Smarty version 2.6.12, created on 2006-05-02 14:38:45
         compiled from mods/culture/_left_menu.tpl */ ?>
                <div class="leftpart">

                        <div class="rightmenu m-green">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul class="me-menu">
                                                        <li<?php if ($this->_tpl_vars['block'] == ''): ?> class="on"<?php endif; ?>><span class="overview"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
">Overview</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'museums'): ?> class="on"<?php endif; ?>><span class="museums"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=museums">Museums</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'parks'): ?> class="on"<?php endif; ?>><span class="parks"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=parks">Parks</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'fests'): ?> class="on"<?php endif; ?>><span class="fest"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=fests">Festivals</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'trips'): ?> class="on"<?php endif; ?>><span class="dayt"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=trips">Day Trips</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'live'): ?> class="on"<?php endif; ?>><span class="livep"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=live">Live Performances</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'churches'): ?> class="on"<?php endif; ?>><span class="church"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=churches">Churches</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'interest'): ?> class="on"<?php endif; ?>><span class="palcei"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=interest">Places of Interest</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'shops'): ?> class="on"<?php endif; ?>><span class="shops"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=shops">Shops</a></span>
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
&block=museums&action=add">Add a museum review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=parks&action=add">Add a park review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=fests&action=add">Add a festival review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=trips&action=add">Add a day trip review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=live&action=add#">Add a live performance review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=churches&action=add">Add a church review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=interest&action=add">Add a place of interest review</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=shops&action=add">Add a shop review</a>
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