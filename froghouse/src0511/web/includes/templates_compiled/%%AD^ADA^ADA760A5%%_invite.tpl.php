<?php /* Smarty version 2.6.12, created on 2006-05-03 12:37:12
         compiled from mods/_invite.tpl */ ?>
    <script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/js/main.js">
    </script>

    <div class="maincontainer">
        <div class="leftpart">

            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Recommend our site to your friend
                            <div class="spacer s15"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="rightpart">

            <div class="title-block"><div>Invite</div></div>
            <div class="block">
               <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" name="InviteForm" method="post" enctype="application/x-www-form-urlencoded">
               <input type="hidden" name="mod"            value="invite" />
               <input type="hidden" name="do"             value="1" />
                <div class="pad">
                    <div class="form">
                    <div class="pad">
                        <?php if ($this->_tpl_vars['UserLastErr'] != ''): ?>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;<font color="red"><b><i><?php echo $this->_tpl_vars['UserLastErr']; ?>
</i></b></font></div>
                        <?php elseif ($this->_tpl_vars['UserLastMess'] != ''): ?>
                            <div>&nbsp;&nbsp;&nbsp;&nbsp;<font color="green"><b><?php echo $this->_tpl_vars['UserLastMess']; ?>
</b></font></div>
                        <?php endif; ?>
                        <div class="spacer s9"><!-- --></div>
                        <div class="spacer"><!-- --></div>
                        <div class="name"><div>Friend Name:</div></div><div class="inp"><input type="text" name="mess[friend_name]" value="<?php echo $this->_tpl_vars['mess']['friend_name']; ?>
" maxlength="70" /></div>
                        <div class="spacer s9"><!-- --></div>
                        <div class="name"><div>Friend E-mail:</div></div><div class="inp"><input type="text" name="mess[friend_email]" value="<?php echo $this->_tpl_vars['mess']['friend_email']; ?>
" maxlength="40" onKeyPress="filter(event,2,'@.-_0123456789',1)"  /></div>
                        <div class="spacer s9"><!-- --></div>
                        <div class="name"><div>Secure Code:</div></div><div class="inp"><input name="mess[code]" type="text" value="" maxlength="100" />&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
turing.php?id=<?php echo $this->_tpl_vars['rand_number']; ?>
" width="40" height="15" alt="secure code" /></div>

                        <div class="spacer s9"><!-- --></div>
                        <div class="name"><div><br>Invite Message:</div></div><div class="inp"><textarea name="mess[message]"><?php echo $this->_tpl_vars['mess']['message']; ?>
</textarea></div>
                        <div class="spacer"><!-- --></div>
                    </div>
                    </div>
            
                    <div class="spacer s9"><!-- --></div>
                    <div class="link link-left"><a href="javascript:document.InviteForm.submit();">Send</a></div>
                </div>
               </form>
            </div>
        </div>
    </div>