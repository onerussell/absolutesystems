<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<title>INDEX || FROGHOUSE.NET</title>
<link rel="stylesheet" type="text/css" href="main.css">
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="for_ie.css">
<![endif]-->
<script type="text/javascript" language="JavaScript" src="{$siteAdr}includes/templates/js/main.js">
</script>
</head>
<body bgcolor="#ABDE81">
<div class="container">

    <div class="headerpart"><!-- --></div>

    <div class="headercontent">
        <div class="wrap">
            <div class="w298 bg-logo"><img src="{$siteAdr}includes/templates/images/sp.gif" width="210" height="120" alt="FROGHOUSE.NET"></div>
            <div class="w423">
                <div class="wrap index">
                    <div class="lh"><img src="{$siteAdr}includes/templates/images/lh.gif" alt=""></div>
                    <div class="login">
                        <div class="lpad">
                            <div class="wrap">
                              <form name="AuthForm" action="{$siteAdr}" method="post" enctype="application/x-www-form-urlencoded">
                              <input type="hidden" name="mod" value="registration" />
                              <input type="hidden" name="action" value="auth" />
                              <input type="hidden" name="redirectLocation" value="{$redirectLocation|escape:"quotes"}" />

                                <div class="w186s">
                                    <div class="wrap">
                                        <label for="login">E-mail:</label>
                                        <div class="spacer"><!-- --></div>
                                        <input type="text" name="UserInfo[email]" maxlength="96" class="w192" id="login" value="{$custom_email}" onKeyPress="filter(event,2,'@.-_0123456789',1)" />
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
                                <div class="submit">{if $UserLastError != ''}<font color="red"><b>{$UserLastError}</b></font>{/if}&nbsp;&nbsp;<input type="submit" value="Login" class="sub" /></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="login-more"><div><a href="{$siteAdr}?mod=registration&amp;action=restore_password" class="gr">Forgot your password?</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteAdr}?mod=registration&amp;action=reg"><b>New User? Register here!</b></a></div></div>
                    <div class="welcome w-top"><!-- --></div>
                    <div class="welcome w-con">
                        <div class="cpad">{$pinf.pagetext}</div>
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
                    <div class="title"><img src="{$siteAdr}includes/templates/images/t-people.gif" width="256" height="42" alt=""></div>
                    
                    <div class="block">
                        {section name=iiu loop=$usersMain}
                         <div class="item">
                            <div class="pad">
                                <div class="name"><a href="{$siteAdr}?mod=registration&amp;action=main">{$usersMain[iiu].nickname}</a></div>
                                <div class="img" style="background: url('{if $usersMain[iiu].user_pic.res_image2 <> ''}{$siteAdr}includes/data/gallery/{$usersMain[iiu].user_pic.res_image2}{elseif $usersMain[iiu].user_pic.res_image <> ''}{$siteAdr}includes/data/gallery/{$usersMain[iiu].user_pic.res_image}{/if}') no-repeat;"><a href="{$siteAdr}?mod=registration&amp;action=main"><img src="{$siteAdr}includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="{$siteAdr}?mod=registration&amp;action=main" style="font-size:11px">{$usersMain[iiu].city_name}</a></div> 
                            </div>
                        </div>
                       {/section}
                    </div>
                    
                    <div class="spacer s19"><!-- --></div>
                    
                    <div class="title"><img src="{$siteAdr}includes/templates/images/t-place.gif" width="266" height="42" alt="" ></div>
                    <div class="blocks">
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('{$siteAdr}includes/templates/images/england.jpg') no-repeat;"><a href="{$siteAdr}?mod=registration&amp;action=main"><img src="{$siteAdr}includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="{$siteAdr}?mod=registration&amp;ction=main">England</a></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('{$siteAdr}includes/templates/images/poland.jpg') no-repeat;"><a href="{$siteAdr}?mod=registration&amp;action=main"><img src="{$siteAdr}includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="{$siteAdr}?mod=registration&amp;action=main">Poland</a></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('{$siteAdr}includes/templates/images/russia.jpg') no-repeat;"><a href="{$siteAdr}?mod=registration&amp;action=main"><img src="{$siteAdr}includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="{$siteAdr}?mod=registration&amp;action=main">Russia</a></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="pad">
                                <div class="img" style="background: url('{$siteAdr}includes/templates/images/germany.jpg') no-repeat;"><a href="{$siteAdr}?mod=registration&amp;action=main"><img src="{$siteAdr}includes/templates/images/bg-girl.gif" alt=""></a></div>
                                <div class="city"><a href="{$siteAdr}?mod=registration&amp;action=main">Germany</a></div>
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
                                <div style="background: url('{$siteAdr}{$imagedir}{$mpi.image}') 13px 0 no-repeat;"><a href="{$siteAdr}?mod=registration&amp;action=main"><img src="{$siteAdr}includes/templates/images/bg-big.gif" width="196" height="235" alt=""></a></div>
                            </div>
                        </div>
                        <div class="m-next">
                            <div class="t">{$mpi.name}</div>
                            <div class="a"><a href="{$siteAdr}?mod=registration&amp;action=main"><!-- --></a></div>
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
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=about">About us</a>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=faq">FAQ</a>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=terms">User agreement</a>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=privacy">Safety Policy</a>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=advertise">Advertise</a>
                <li><a href="http://www.engine37.com">Powered by engine37</a>
            </ul>
        </div>
    </div>
</div>
</body>
</html>