<?php /* Smarty version 2.6.12, created on 2006-05-03 13:47:37
         compiled from mods/necessities/_left_menu.tpl */ ?>
                <div class="leftpart">

                        <div class="rightmenu m-green">
                                <div class="bg-top">
                                        <div class="bg-bottom">
                                                <ul class="me-menu">
                                                        <li<?php if ($this->_tpl_vars['block'] == ''): ?> class="on"<?php endif; ?>><span class="overview"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
">Overview</a></span>

                                                        <li<?php if ($this->_tpl_vars['block'] == 'money'): ?> class="on"<?php endif; ?>><span class="money"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=money">Money</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'health'): ?> class="on"<?php endif; ?>><span class="health"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=health">Health and Safety</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'around'): ?> class="on"<?php endif; ?>><span class="getar"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=around">Getting Around</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'lingo'): ?> class="on"<?php endif; ?>><span class="locall"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=lingo">Local Lingo</a></span>
                                                        <li<?php if ($this->_tpl_vars['block'] == 'random'): ?> class="on"<?php endif; ?>><span class="random"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=random">Random</a></span>
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
&block=money&action=add">Add a money post</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=health&action=add">Add a health and safety post</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=around&action=add">Add a getting around post</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=lingo&action=add">Add a local lingo post</a>
                                                        <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&block=random&action=add">Add a random post</a>
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