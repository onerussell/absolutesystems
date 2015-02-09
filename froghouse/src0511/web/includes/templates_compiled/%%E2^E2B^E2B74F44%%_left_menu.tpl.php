<?php /* Smarty version 2.6.12, created on 2006-05-02 01:40:47
         compiled from mods/people/_left_menu.tpl */ ?>
      <script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/js/main.js">
      </script>

        <div class="leftpart">
        <?php if ($this->_tpl_vars['action'] || $this->_tpl_vars['UserInfo']): ?>
        <?php if (( 'overview' != $this->_tpl_vars['action'] && 'search' != $this->_tpl_vars['action'] ) || $this->_tpl_vars['UserInfo']): ?>
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li <?php if ('photo' == $this->_tpl_vars['mod']): ?>class="on"<?php endif; ?>><span class="overview"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=photo&amp;uid=<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
">View All Photos</a></span>
                            <li <?php if ('send' == $this->_tpl_vars['action']): ?>class="on"<?php endif; ?>><span class="sendm"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
/send.html">Send a Message</a></span>
                            <li><span class="kiss"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
/kiss.html">Give a Kiss</a></span>
                            <li><span class="makef"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/<?php echo $this->_tpl_vars['UserInfo']['nickname']; ?>
/friend.html">Make Friends</a></span>
                            <li <?php if ('blog' == $this->_tpl_vars['mod']): ?>class="on"<?php endif; ?>><span class="readb"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=blog&amp;uid=<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
">Read Blog</a></span>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
        <?php else: ?>
        <?php endif; ?>
        <?php endif; ?>

            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/search/" method="get" name="QuickSearchForm" >
                        <input type="hidden" name="do" value="1" />
                        <input type="hidden" name="action" value="search" />
                        <input type="hidden" name="city_id" value="<?php echo $this->_tpl_vars['city_id']; ?>
" />
                        <div class="left-search">Quick search
                            <div class="spacer s8"><!-- --></div>
                                <div class="inp"><input type="text" name="srh" maxlength="255" value=""  onKeyPress="filter(event,2,'@.-_0123456789, ',1)" /></div>
                                <div class="but"><a href="javascript:document.QuickSearchForm.submit();"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/b-search.gif" width="26" height="22" alt="Search"></a></div>
                            <div class="spacer s15"><!-- --></div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>