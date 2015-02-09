<?php /* Smarty version 2.6.12, created on 2006-05-02 01:40:41
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'index.tpl', 71, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" http-equiv="Content-Type" />
<title>Thefroghouse.net</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
default.css" />
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
for_ie.css">
<![endif]-->
</head>
<body bgcolor="#ffffff">
<div class="container">
    <div class="spacer s13"><!-- --></div>
    <div class="logo">
        <div class="t-l">
            <div class="t-r">
                <div class="b-l">
                    <div class="b-r">
                        <div class="logos"><a href="/"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/logo.gif" width="301" height="81" alt="Thefroghouse.net"></a></div>
                        <div class="t-menu">
                            <ul>
                                <li class="last"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=logout">Logout</a>
                                <li <?php if ($this->_tpl_vars['mod'] == 'invite'): ?>class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=invite">Invite</a>
                                <li <?php if ($this->_tpl_vars['mod'] == 'view_other_cities'): ?>class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=view_other_cities">View Other Cities</a>
                                <li <?php if ($this->_tpl_vars['mod'] == 'search'): ?>class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=search">Search</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="spacer s9"><!-- --></div>
    <div class="google"><a href="#"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/google.gif" width="728" height="90" alt=""></a></div>
    <div class="spacer s9"><!-- --></div>

    <div class="user">
        <div class="t-l">
            <div class="t-r">
                <div class="b-l">
                    <div class="b-r">
                        <div class="status"><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=view&amp;what=profile" class="u"><?php echo $this->_tpl_vars['nickname']; ?>
</a>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['UserInfoStatus']; ?>
&nbsp;&nbsp;(&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=registration&amp;action=change&amp;what=profile">change status</a>&nbsp;)</div></div>
                        <div class="city"><div><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=view_other_cities&amp;city_id=<?php echo $this->_tpl_vars['UserInfoCurrentCity']; ?>
" class="u"><?php echo $this->_tpl_vars['UserInfoCurrentCityName']; ?>
 </a>(<?php echo $this->_tpl_vars['UserInfoCurrentCntrName']; ?>
)</div></div>
                        <div class="mm">
                            <ul>
                                <li<?php if (( ! $this->_tpl_vars['mod'] || $this->_tpl_vars['mod'] == 'registration' || ( $this->_tpl_vars['mod'] == 'blog' && $this->_tpl_vars['is_user'] == 1 ) || ( $this->_tpl_vars['mod'] == 'photo' && $this->_tpl_vars['is_user'] == 1 ) )): ?> class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/m-me<?php if (! $this->_tpl_vars['mod'] || $this->_tpl_vars['mod'] == 'registration' || ( $this->_tpl_vars['is_user'] == 1 && ( $this->_tpl_vars['mod'] == 'blog' || $this->_tpl_vars['mod'] == 'photo' ) )): ?>-on<?php endif; ?>.gif" alt=""></a>
                                <li<?php if (( $this->_tpl_vars['is_user'] != 1 && ( $this->_tpl_vars['mod'] == 'blog' || $this->_tpl_vars['mod'] == 'photo' ) ) || $this->_tpl_vars['mod'] == 'people'): ?> class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
people/"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/m-people<?php if (( $this->_tpl_vars['is_user'] != 1 && ( $this->_tpl_vars['mod'] == 'blog' || $this->_tpl_vars['mod'] == 'photo' ) ) || $this->_tpl_vars['mod'] == 'people'): ?>-on<?php endif; ?>.gif" alt=""></a>
                                <li<?php if ($this->_tpl_vars['mod'] == 'nightlife'): ?> class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=nightlife"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/m-nightlife<?php if ($this->_tpl_vars['mod'] == 'nightlife'): ?>-on<?php endif; ?>.gif" alt=""></a>
                                <li<?php if ($this->_tpl_vars['mod'] == 'culture'): ?> class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=culture"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/m-culture<?php if ($this->_tpl_vars['mod'] == 'culture'): ?>-on<?php endif; ?>.gif" alt=""></a>
                                <li<?php if ($this->_tpl_vars['mod'] == 'food'): ?> class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=food"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/m-food<?php if ($this->_tpl_vars['mod'] == 'food'): ?>-on<?php endif; ?>.gif" alt=""></a>
                                <li<?php if ($this->_tpl_vars['mod'] == 'lodging'): ?> class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=lodging"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/m-lodging<?php if ($this->_tpl_vars['mod'] == 'lodging'): ?>-on<?php endif; ?>.gif" alt=""></a>
                                <li<?php if ($this->_tpl_vars['mod'] == 'necessities'): ?> class="on"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
page.php?mod=necessities"><img src="<?php echo $this->_tpl_vars['siteAdr']; ?>
includes/templates/images/m-necessities<?php if ($this->_tpl_vars['mod'] == 'necessities'): ?>-on<?php endif; ?>.gif" alt=""></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($this->_tpl_vars['bc']): ?>
    <div class="path"><div>
    <?php unset($this->_sections['iip']);
$this->_sections['iip']['loop'] = is_array($_loop=$this->_tpl_vars['bc']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iip']['name'] = 'iip';
$this->_sections['iip']['show'] = true;
$this->_sections['iip']['max'] = $this->_sections['iip']['loop'];
$this->_sections['iip']['step'] = 1;
$this->_sections['iip']['start'] = $this->_sections['iip']['step'] > 0 ? 0 : $this->_sections['iip']['loop']-1;
if ($this->_sections['iip']['show']) {
    $this->_sections['iip']['total'] = $this->_sections['iip']['loop'];
    if ($this->_sections['iip']['total'] == 0)
        $this->_sections['iip']['show'] = false;
} else
    $this->_sections['iip']['total'] = 0;
if ($this->_sections['iip']['show']):

            for ($this->_sections['iip']['index'] = $this->_sections['iip']['start'], $this->_sections['iip']['iteration'] = 1;
                 $this->_sections['iip']['iteration'] <= $this->_sections['iip']['total'];
                 $this->_sections['iip']['index'] += $this->_sections['iip']['step'], $this->_sections['iip']['iteration']++):
$this->_sections['iip']['rownum'] = $this->_sections['iip']['iteration'];
$this->_sections['iip']['index_prev'] = $this->_sections['iip']['index'] - $this->_sections['iip']['step'];
$this->_sections['iip']['index_next'] = $this->_sections['iip']['index'] + $this->_sections['iip']['step'];
$this->_sections['iip']['first']      = ($this->_sections['iip']['iteration'] == 1);
$this->_sections['iip']['last']       = ($this->_sections['iip']['iteration'] == $this->_sections['iip']['total']);
?>
    <?php if (! $this->_sections['iip']['last']): ?>
    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['bc'][$this->_sections['iip']['index']]['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo $this->_tpl_vars['bc'][$this->_sections['iip']['index']]['name']; ?>
</a> / 
    <?php else: ?>
    <span><?php echo $this->_tpl_vars['bc'][$this->_sections['iip']['index']]['name']; ?>
</span>
    <?php endif; ?>
    <?php endfor; endif; ?>
    </div>
    </div>
    <?php else: ?>
    <div class="spacer s13"><!-- --></div>
    <?php endif; ?>

    <?php echo $this->_tpl_vars['_content']; ?>


    <div class="spacer footerspacer"><!-- --></div>

    <div class="footer">
        <div class="b-menu">
            <ul>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=about">About</a>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=faq">FAQ</a>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=terms">Terms</a>
                <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=privacy">Privacy</a>
                <li class="last"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=advertise">Advertise</a>
            </ul>
        </div>
    </div>

</div>
</body>
</html>