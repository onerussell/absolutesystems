<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset={$charset}" http-equiv="Content-Type" />
<title>Thefroghouse.net</title>
<link rel="stylesheet" type="text/css" href="{$siteAdr}default.css" />
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="{$siteAdr}for_ie.css">
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
                        <div class="logos"><a href="/"><img src="{$siteAdr}includes/templates/images/logo.gif" width="301" height="81" alt="Thefroghouse.net"></a></div>
                        <div class="t-menu">
                            <ul>
                                <li class="last"><a href="{$siteAdr}?mod=registration&amp;action=logout">Logout</a>
                                <li {if $mod == 'invite'}class="on"{/if}><a href="{$siteAdr}?mod=invite">Invite</a>
                                <li {if $mod == 'view_other_cities'}class="on"{/if}><a href="{$siteAdr}?mod=view_other_cities">View Other Cities</a>
                                <li {if $mod == 'search'}class="on"{/if}><a href="{$siteAdr}page.php?mod=search">Search</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="spacer s9"><!-- --></div>
    <div class="google"><a href="#"><img src="{$siteAdr}includes/templates/images/google.gif" width="728" height="90" alt=""></a></div>
    <div class="spacer s9"><!-- --></div>

    <div class="user">
        <div class="t-l">
            <div class="t-r">
                <div class="b-l">
                    <div class="b-r">
                        <div class="status"><div><a href="{$siteAdr}?mod=registration&amp;action=view&amp;what=profile" class="u">{$nickname}</a>&nbsp;&nbsp;&nbsp;{$UserInfoStatus}&nbsp;&nbsp;(&nbsp;<a href="{$siteAdr}?mod=registration&amp;action=change&amp;what=profile">change status</a>&nbsp;)</div></div>
                        <div class="city"><div><a href="{$siteAdr}?mod=view_other_cities&amp;city_id={$UserInfoCurrentCity}" class="u">{$UserInfoCurrentCityName} </a>({$UserInfoCurrentCntrName})</div></div>
                        <div class="mm">
                            <ul>
                                <li{if (!$mod 
                                            || $mod == 'registration' 
                                            || ($mod == 'blog' && $is_user == 1)
                                            || ($mod == 'photo' && $is_user == 1))} class="on"{/if}><a href="{$siteAdr}"><img src="{$siteAdr}includes/templates/images/m-me{if !$mod || $mod == 'registration' || ($is_user == 1 && ($mod == 'blog' || $mod == 'photo')) }-on{/if}.gif" alt=""></a>
                                <li{if ($is_user != 1 && ($mod == 'blog' 
                                                            || $mod == 'photo')) 
                                                      || $mod == 'people'} class="on"{/if}><a href="{$siteAdr}people/"><img src="{$siteAdr}includes/templates/images/m-people{if ($is_user != 1 && ($mod == 'blog' || $mod =='photo')) 
                                                                                                                                                                                                || $mod == 'people'}-on{/if}.gif" alt=""></a>
                                <li{if $mod == 'nightlife'} class="on"{/if}><a href="{$siteAdr}page.php?mod=nightlife"><img src="{$siteAdr}includes/templates/images/m-nightlife{if $mod == 'nightlife'}-on{/if}.gif" alt=""></a>
                                <li{if $mod == 'culture'} class="on"{/if}><a href="{$siteAdr}page.php?mod=culture"><img src="{$siteAdr}includes/templates/images/m-culture{if $mod == 'culture'}-on{/if}.gif" alt=""></a>
                                <li{if $mod == 'food'} class="on"{/if}><a href="{$siteAdr}page.php?mod=food"><img src="{$siteAdr}includes/templates/images/m-food{if $mod == 'food'}-on{/if}.gif" alt=""></a>
                                <li{if $mod == 'lodging'} class="on"{/if}><a href="{$siteAdr}page.php?mod=lodging"><img src="{$siteAdr}includes/templates/images/m-lodging{if $mod == 'lodging'}-on{/if}.gif" alt=""></a>
                                <li{if $mod == 'necessities'} class="on"{/if}><a href="{$siteAdr}page.php?mod=necessities"><img src="{$siteAdr}includes/templates/images/m-necessities{if $mod == 'necessities'}-on{/if}.gif" alt=""></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {if $bc}
    <div class="path"><div>
    {section loop=$bc name=iip}
    {if !$smarty.section.iip.last}
    <a href="{$bc[iip].link|escape:"html"}">{$bc[iip].name}</a> / 
    {else}
    <span>{$bc[iip].name}</span>
    {/if}
    {/section}
    </div>
    </div>
    {else}
    <div class="spacer s13"><!-- --></div>
    {/if}

    {$_content}

    <div class="spacer footerspacer"><!-- --></div>

    <div class="footer">
        <div class="b-menu">
            <ul>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=about">About</a>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=faq">FAQ</a>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=terms">Terms</a>
                <li><a href="{$siteAdr}index.php?mod=page&amp;pn=privacy">Privacy</a>
                <li class="last"><a href="{$siteAdr}index.php?mod=page&amp;pn=advertise">Advertise</a>
            </ul>
        </div>
    </div>

</div>
</body>
</html>