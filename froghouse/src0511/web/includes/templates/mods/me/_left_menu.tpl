         <div class="leftpart">
            <div class="rightmenu m-green">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul class="me-menu">
                            <li {if empty($action)}class="on"{/if}><span class="overview"><a href="{$siteAdr}">Overview</a></span>
                            <li {if $mod == 'registration'
                                    && $action == 'view' 
                                    && $what == 'profile'}class="on"{/if}><span class="profile"><a href="{$siteAdr}?mod=registration&amp;action=view&amp;what=profile">My Profile</a></span>

                            <li {if $mod == 'mc'}class="on"{/if}><span class="inbox"><a href="{$siteAdr}?mod=mc&amp;action=inbox">My Inbox</a></span>
                                {if $mod == 'mc'}
                                <ul class="s-menu">
                                    <li {if $action == 'sent'}class="on2"{/if}        > <a href="{$siteAdr}?mod=mc&amp;action=sent"        >Sent Items</a>
                                    <li {if $action == 'deleted'}class="on2"{/if}     > <a href="{$siteAdr}?mod=mc&amp;action=deleted"     >Deleted Items</a>
                                    <li {if $action == 'friends_req'}class="on2"{/if} > <a href="{$siteAdr}?mod=mc&amp;action=friends_req" >Friend Requests</a>
                                    <li {if $action == 'pending_req'}class="on2"{/if} > <a href="{$siteAdr}?mod=mc&amp;action=pending_req" >Pending Requests</a>
                                    <li {if $action == 'settings'}class="on2"{/if}    > <a href="{$siteAdr}?mod=mc&amp;action=settings"    >Mail Settings</a>
                                </ul>
                                {/if}
                            <li {if $mod == 'friends'}class="on"{/if}><span class="friends"><a href="{$siteAdr}?mod=friends">My Friends</a></span>
                            <li><span class="photos"><a href="{#lmyphoto#}">My Photos</a></span>
                            <li><span class="blog"><a href="{#lmyblog#}">My Blog</a></span>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <ul>
                            <li><a href="{$siteAdr}?mod=registration&amp;action=change&amp;what=profile">Edit my profile</a>
                            <li><a href="{$siteAdr}?mod=registration&amp;action=change&amp;what=photos" >Upload photo</a>
                            <li><a href="#">Add blog entry</a>
                        </ul>
                    </div>
                </div>
            </div>

        </div>