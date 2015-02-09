<?php /* Smarty version 2.6.12, created on 2006-05-06 04:58:33
         compiled from main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'main.tpl', 30, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<title>INDEX || FROGHOUSE.NET</title>
<link rel="stylesheet" type="text/css" href="main.css">
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="for_ie.css">
<![endif]-->
<script type="text/javascript" language="JavaScript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/js/main.js">
</script>
</head>
<body bgcolor="#ABDE81">
<div class="container">

    <div class="headerpart"><!-- --></div>

    <div class="headercontent">
        <div class="wrap">
            <div class="w298 bg-logo"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/sp.gif" width="210" height="120" alt="FROGHOUSE.NET"></div>
            <div class="w423">
                <div class="wrap index">
                    <div class="lh"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/lh.gif" alt=""></div>
                    <div class="login">
                        <div class="lpad">
                            <div class="wrap">
                              <form name="AuthForm" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" method="post" enctype="application/x-www-form-urlencoded">
                              <input type="hidden" name="mod" value="registration" />
                              <input type="hidden" name="action" value="auth" />
                              <input type="hidden" name="redirectLocation" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['redirectLocation'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
" />

                                <div class="w186s">
                                    <div class="wrap">
                                        <label for="login">E-mail:</label>
                                        <div class="spacer"><!-- --></div>
                                        <input type="text" name="UserInfo[email]" maxlength="96" class="w192" id="login" value="<?php echo $this->_tpl_vars['custom_email']; ?>
" onKeyPress="filter(event,2,'@.-_0123456789',1)" />
                                    </div>
                                </div>
                                <div class="w192f">
                                    <div class="wrap">
                                        <label for="pass">Password:</label>
                                        <div class="spacer"><!-- --></div>
                                        <input type="password" name="UserInfo[pass]" maxlength="21" class="w192" id="pass" />
                                    </div>
                                </div>
                                <div class="spacer s2"><!-- --></div>
                                <div class="submit"><?php if ($this->_tpl_vars['UserLastError'] != ''): ?><font color="red"><b><?php echo $this->_tpl_vars['UserLastError']; ?>
</b></font><?php endif; ?>&nbsp;&nbsp;<input type="submit" value="Login" class="sub" /></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="login-more"><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=restore_password" class="gr">Forgot your password?</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=reg"><b>New User? Register here!</b></a></div></div>
                    <div class="welcome w-top"><!-- --></div>
                    <div class="welcome w-con">
                        <div class="cpad"><?php echo $this->_tpl_vars['pinf']['pagetext']; ?>
</div>
                        <div class="spacer"><!-- --></div>
                    </div>
                </div>
            </div>
            <div class="spacer"><!-- --></div>
        </div>
    </div>

    <div class="contentpart">
        <div class="padding">
            <div class="w490">
                <div class="wrap">
                    <div class="title"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/t-people.gif" width="256" height="42" alt=""></div>
                    
                    <div class="block">
                        <?php unset($this->_sections['iiu']);
$this->_sections['iiu']['name'] = 'iiu';
$this->_sections['iiu']['loop'] = is_array($_loop=$this->_tpl_vars['usersMain']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                         <div class="item">
                            <div class="pad">
                                <div class="name"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><?php echo $this->_tpl_vars['usersMain'][$this->_sections['iiu']['index']]['nickname']; ?>
</a></div>
                                <div class="img" style="background: url('<?php if ($this->_tpl_vars['usersMain'][$this->_sections['iiu']['index']]['user_pic']['res_image2'] <> ''):  echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['usersMain'][$this->_sections['iiu']['index']]['user_pic']['res_image2'];  elseif ($this->_tpl_vars['usersMain'][$this->_sections['iiu']['index']]['user_pic']['res_image'] <> ''):  echo $this->_tpl_vars['siteAdr']; ?>
includes/data/gallery/<?php echo $this->_tpl_vars['usersMain'][$this->_sections['iiu']['index']]['user_pic']['res_image'];  endif; ?>') no-repeat;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main" style="font-size:11px"><?php echo $this->_tpl_vars['usersMain'][$this->_sections['iiu']['index']]['city_name']; ?>
</a></div> 
                            </div>
                        </div>
                       <?php endfor; endif; ?>
                    </div>
                    
                    <div class="spacer s19"><!-- --></div>
                    
                    <div class="title"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/t-place.gif" width="266" height="42" alt="" ></div>
                    <div class="blocks">
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/england.jpg') no-repeat;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;ction=main">England</a></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/poland.jpg') no-repeat;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main">Poland</a></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/russia.jpg') no-repeat;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main">Russia</a></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/germany.jpg') no-repeat;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main">Germany</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w222">
                <div class="tpad">
                    <div class="wrap">
                        <div class="m-photo">
                            <div class="wrap">
                                <div style="background: url('<?php echo $this->_tpl_vars['siteAdr'];  echo $this->_tpl_vars['imagedir'];  echo $this->_tpl_vars['mpi']['image']; ?>
') 13px 0 no-repeat;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/bg-big.gif" width="196" height="235" alt=""></a></div>
                            </div>
                        </div>
                        <div class="m-next">
                            <div class="t"><?php echo $this->_tpl_vars['mpi']['name']; ?>
</div>
                            <div class="a"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=main"><!-- --></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="spacer footerspacer"><!-- --></div>
    <div class="footer">
        <div class="b-menu">
            <ul>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=about">About us</a>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=faq">FAQ</a>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=terms">User agreement</a>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=privacy">Safety Policy</a>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=advertise">Advertise</a>
                <li><a href="http://www.engine37.com">Powered by engine37</a>
            </ul>
        </div>
    </div>
</div>
</body>
</html>