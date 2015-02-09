<?php /* Smarty version 2.6.12, created on 2006-05-02 01:40:41
         compiled from mods/blog/_left_menu.tpl */ ?>
        <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li><span class="overview"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
">Overview</a></span>
                            <li><span class="profile"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&action=view&what=profile">My Profile</a></span>
                            <li><span class="inbox"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&action=inbox">My Inbox</a></span>
                            <li><span class="friends"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends">My Friends</a></span>
                            <li><span class="photos"><a href="<?php echo $this->_config[0]['vars']['lmyphoto']; ?>
">My Photos</a></span>
                            <li class="on"><span class="blog"><a href="<?php echo $this->_config[0]['vars']['lmyblog']; ?>
">My Blog</a></span>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul>
                            <li><a href="page.php?mod=blog&action=add">Add a blog entry</a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Quick search
                            <form name="f1" method="get">
                            <input type="hidden" name="mod" value="<?php echo $this->_tpl_vars['mod']; ?>
" />
                            <input type="hidden" name="action" value="search" />                            
                            <div class="spacer s8"><!-- --></div>
                                <div class="inp"><input type="text" name="sstr" value="<?php echo $this->_tpl_vars['sstr']; ?>
" /></div>
                                <div class="but"><a href="#" onclick="document.f1.submit();return false;"><img src="includes/templates/images/b-search.gif" width="26" height="22" alt="Search"></a></div>
                            <div class="spacer s15"><!-- --></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>