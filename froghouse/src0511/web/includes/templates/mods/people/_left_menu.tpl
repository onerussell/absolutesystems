      <script type="text/javascript" language="JavaScript" src="{$siteAdr}includes/templates/js/main.js">
      </script>

        <div class="leftpart">
        {if $action || $UserInfo}
        {if ('overview' != $action && 'search' != $action)|| $UserInfo}
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li {if 'photo' == $mod}class="on"{/if}><span class="overview"><a href="{$siteAdr}page.php?mod=photo&amp;uid={$UserInfo.uid}">View All Photos</a></span>
                            <li {if 'send' == $action}class="on"{/if}><span class="sendm"><a href="{$siteAdr}people/{$UserInfo.nickname}/send.html">Send a Message</a></span>
                            <li><span class="kiss"><a href="{$siteAdr}people/{$UserInfo.nickname}/kiss.html">Give a Kiss</a></span>
                            <li><span class="makef"><a href="{$siteAdr}people/{$UserInfo.nickname}/friend.html">Make Friends</a></span>
                            <li {if 'blog' == $mod}class="on"{/if}><span class="readb"><a href="{$siteAdr}page.php?mod=blog&amp;uid={$UserInfo.uid}">Read Blog</a></span>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
        {else}
        {/if}
        {/if}

            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <form action="{$siteAdr}people/search/" method="get" name="QuickSearchForm" >
                        <input type="hidden" name="do" value="1" />
                        <input type="hidden" name="action" value="search" />
                        <input type="hidden" name="city_id" value="{$city_id}" />
                        <div class="left-search">Quick search
                            <div class="spacer s8"><!-- --></div>
                                <div class="inp"><input type="text" name="srh" maxlength="255" value=""  onKeyPress="filter(event,2,'@.-_0123456789, ',1)" /></div>
                                <div class="but"><a href="javascript:document.QuickSearchForm.submit();"><img src="{$siteAdr}includes/templates/images/b-search.gif" width="26" height="22" alt="Search"></a></div>
                            <div class="spacer s15"><!-- --></div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>