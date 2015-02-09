    <div class="maincontainer">
      {include file="mods/me/_left_menu.tpl"}

        <div class="rightpart">

            <div class="title-block"><div>Latest Activity</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                        {if $people_cnt}<div class="item"><a href="{$siteAdr}people/?city_id={$UserInfoCity}">People in {$UserInfoCityName} ({$people_cnt} new)</a></div>{/if}
                        {if $nightlife_cnt}<div class="item"><a href="{$siteAdr}page.php?mod=nightlife">Nightlife in {$UserInfoCityName} ({$nightlife_cnt} new reviews)</a></div>{/if}
                        {if $culture_cnt}<div class="item"><a href="{$siteAdr}page.php?mod=culture">Culture in {$UserInfoCityName} ({$culture_cnt} new reviews)</a></div>{/if}
                        {if $food_cnt}<div class="item"><a href="{$siteAdr}page.php?mod=food">Food in {$UserInfoCityName} ({$food_cnt} new reviews)</a></div>{/if}
                        {if $lodging_cnt}<div class="item"><a href="{$siteAdr}page.php?mod=lodging">Lodging in {$UserInfoCityName} ({$lodging_cnt} new reviews)</a></div>{/if}
                        {if $necessities_cnt}<div class="item"><a href="{$siteAdr}page.php?mod=necessities">Necessities in {$UserInfoCityName} ({$nec_cnt} new post)</a></div>{/if}
                        {if !($people_cnt||$nigthlife_cnt||$culture_cnt||$food_cnt||$lodging_cnt||$necessities_cnt)}
                        <div class="item">&nbsp;&nbsp;No events</div>
                        {/if}
                    </div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Inbox</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                        {if $mc_inbox_cnt > 0}<div class="item"><a href="{$siteAdr}?mod=mc&amp;action=inbox">Messages ({$mc_inbox_cnt} new)</a></div>{/if}
                        {if $mc_friend_requests_cnt > 0}<div class="item"><a href="{$siteAdr}?mod=mc&amp;action=friends_req">Friend Requests ({$mc_friend_requests_cnt} new)</a></div>{/if}
                        {if $mc_pending_requests_cnt > 0}<div class="item"><a href="{$siteAdr}?mod=mc&amp;action=pending_req">Pending Requests ({$mc_pending_requests_cnt})</a></div>{/if}
                        {if $mc_last_kiss}<div class="item"><a href="{$siteAdr}?mod=mc&amp;action=inbox&amp;add_action=read&amp;id={$mc_last_kiss.id}">{$mc_last_kiss.subject}</a></div>{/if}

                        {if !($mc_inbox_cnt||$mc_friend_requests_cnt||$mc_pending_requests_cnt||$mc_last_kiss)}
                        <div class="item">&nbsp;&nbsp;No events</div>
                        {/if}
                    </div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Friends</div></div>
            <div class="block">
                <div class="pad">
                    <div class="photo">
                        <div class="pads">
       
                           {section name=iiu loop=$users}
                               <div class="p-item">
                                   <div class="pic" style="height: 127px;"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html"><img src="{$siteAdr}{if $users[iiu].user_images.res_image}includes/data/gallery/{$users[iiu].user_images.res_image}{elseif $users[iiu].user_images.name}includes/data/gallery/{$users[iiu].user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                                   <div class="name"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html">{$users[iiu].nickname|ucfirst}, {$users[iiu].city_name.city_name}</a></div>
                               </div>
                           {sectionelse}
                           <div class="list">
                           <div class="item">
                           &nbsp;No friends
                           </div>
                           </div>
                           {/section}


                        </div>
                        <div class="spacer"><!-- --></div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="{$siteAdr}?mod=friends">View all friends{if $friends_cnt > 0} ({$friends_cnt}){/if}</a></div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Photos</div></div>
            <div class="block">
                <div class="pad">
                    <div class="photos-l">
                        {section name = iiphl loop = $photoList}
                        <div class="pitem{if $smarty.section.iiphl.rownum == 3} pitem-last{/if}">
                            <div class="pic pic{if $smarty.section.iiphl.rownum == 2}v{else}h{/if}">{if $photoList[iiphl].image <> ''}<a href="{$photoList[iiphl].link}"><img src="{$siteAdr}{$imagedir}{if $photoList[iiphl].cached == 1}{$cachedir}{/if}{$photoList[iiphl].image}" border="0" /></a>{/if}</div>
                            <div class="name"><a href="{$photoList[iiphl].link}">{if $photoList[iiphl].pcnt == 0}{#nocomments#}{else}{$photoList[iiphl].pcnt} {#comments#}{/if}</a></div>
                        </div>
                        {/section}

                        <div class="spacer s15"><!-- --></div>


                    </div>

                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="{$siteAdr}page.php?mod=photo">View all photos ({$photo_cnt})</a></div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

            <div class="title-block"><div>My Blog's Latest Entry</div></div>
            <div class="block">
                <div class="pad">
                    <div class="blog-l">
                        <div class="b-item">
                            <div class="date">{$blogItem.pdate}</div>
                            <div class="title">{$blogItem.title}</div>
                            <div class="text">{$blogItem.descr}</div>
                            <div class="link">{if $blogItem.pcnt == 0}{#nocomments#}{else}{$blogItem.pcnt} {#comments#}{/if}</a></div>
                        </div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link"><a href="{$siteAdr}page.php?mod=blog">View all entries</a></div>
                </div>
            </div>
        </div>
    <div class="spacer"><!-- --></div>
    </div>      
        
