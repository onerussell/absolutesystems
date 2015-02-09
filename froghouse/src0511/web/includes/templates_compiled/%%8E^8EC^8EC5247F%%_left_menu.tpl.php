<?php /* Smarty version 2.6.12, created on 2006-05-02 01:40:41
         compiled from mods/me/_left_menu.tpl */ ?>
         <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li <?php if (empty ( $this->_tpl_vars['action'] )): ?>class="on"<?php endif; ?>><span class="overview"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
">Overview</a></span>
                            <li <?php if ($this->_tpl_vars['mod'] == 'registration' && $this->_tpl_vars['action'] == 'view' && $this->_tpl_vars['what'] == 'profile'): ?>class="on"<?php endif; ?>><span class="profile"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=view&amp;what=profile">My Profile</a></span>

                            <li <?php if ($this->_tpl_vars['mod'] == 'mc'): ?>class="on"<?php endif; ?>><span class="inbox"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=inbox">My Inbox</a></span>
                                <?php if ($this->_tpl_vars['mod'] == 'mc'): ?>
                                <ul class="s-menu">
                                    <li <?php if ($this->_tpl_vars['action'] == 'sent'): ?>class="on2"<?php endif; ?>        > <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=sent"        >Sent Items</a>
                                    <li <?php if ($this->_tpl_vars['action'] == 'deleted'): ?>class="on2"<?php endif; ?>     > <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=deleted"     >Deleted Items</a>
                                    <li <?php if ($this->_tpl_vars['action'] == 'friends_req'): ?>class="on2"<?php endif; ?> > <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=friends_req" >Friend Requests</a>
                                    <li <?php if ($this->_tpl_vars['action'] == 'pending_req'): ?>class="on2"<?php endif; ?> > <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=pending_req" >Pending Requests</a>
                                    <li <?php if ($this->_tpl_vars['action'] == 'settings'): ?>class="on2"<?php endif; ?>    > <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=mc&amp;action=settings"    >Mail Settings</a>
                                </ul>
                                <?php endif; ?>
                            <li <?php if ($this->_tpl_vars['mod'] == 'friends'): ?>class="on"<?php endif; ?>><span class="friends"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=friends">My Friends</a></span>
                            <li><span class="photos"><a href="<?php echo $this->_config[0]['vars']['lmyphoto']; ?>
">My Photos</a></span>
                            <li><span class="blog"><a href="<?php echo $this->_config[0]['vars']['lmyblog']; ?>
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
                            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=change&amp;what=profile">Edit my profile</a>
                            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=change&amp;what=photos" >Upload photo</a>
                            <li><a href="#">Add blog entry</a>
                        </ul>
                    </div>
                </div>
            </div>

        </div>