    <div class="maincontainer">

    {include file="mods/people/_left_menu.tpl"}

    {if $action == 'view'}

        <div class="rightpart">

            <div class="title-block"><div>{$UserInfo.nickname|ucfirst}'s Profile</div></div>
            <div class="block">
                <div class="pad">
                    <div>
                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="100%" height="400">
                          <param name="movie" value="{$siteAdr}includes/templates/swf/e37zoom.swf?server=imageLoader.php&amp;thumbnail=70,60&amp;images={$UserInfo.photos_list}&amp;bgcolor=FFFFFF&amp;control=6&amp;preview=2&amp;rgb=18,156,53" />
                          <param name="quality" value="high" />
                          <param name="bgcolor" value="#FFFFFF" />
                          <param name="scale" value="noscale" />
                          <param name="salign" value="lt" />
                          <embed src="{$siteAdr}includes/templates/swf/e37zoom.swf?server=imageLoader.php&amp;thumbnail=70,60&amp;images={$UserInfo.photos_list}&amp;bgcolor=FFFFFF&amp;control=6&amp;preview=2&amp;rgb=18,156,53" bgcolor="#FFFFFF" scale="noscale" salign="lt" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="400" />
                        </object>
                    </div>

                    <div class="spacer s9"><!-- --></div>

                    <div class="profile-info">
                        <div class="pad">
                            {if $UserInfo.quote}<b>"{$UserInfo.quote}"</b>{/if}<p><b>{$UserInfo.age} years, currently abroad, {$UserInfo.city_name} ({$UserInfo.country_name})</b>
                            {if $UserInfo.about_me}<p><br><span>About Me:</span> {$UserInfo.about_me}{/if}
                            {if $UserInfo.best_travel_story}<p><br><span>Best Travel Story:</span> {$UserInfo.best_travel_story}{/if}
                            {if $UserInfo.originally_from}<p><br><span>Originally from:</span> {$UserInfo.originally_from}{/if}
                            {if $UserInfo.here_for}<p><span>Here for:</span> {$UserInfo.here_for}{/if}
                            {if $UserInfo.uni_host}<p><span>Host University:</span> {$UserInfo.uni_host}{/if}
                            {if $UserInfo.uni_home}<p><span>Home University:</span> {$UserInfo.uni_home}{/if}
                            {if $UserInfo.languages}<p><span>Languages:</span> {$UserInfo.languages}{/if}
                            {if $UserInfo.travel_advice}<p><span>Travel Advice:</span> {$UserInfo.travel_advice}{/if}
                            {if $UserInfo.birthday}<p><span>Birthday:</span> {$UserInfo.birthday|date_format:"%d %B %Y"}{/if}
                            {if $UserInfo.visited_cities}<p><span>Cities Visited:</span> {$UserInfo.visited_cities}{/if}
                            {if $UserInfo.like_visit}<p><span>Places I'd Like to Visit:</span> {$UserInfo.like_visit}{/if}
                            <p><span>Relationship Status:</span> {$UserInfo.relation_status}
                            <p><span>Sexual Orientation:</span> {$UserInfo.sexual_orientation}
                            {if $UserInfo.turn_ons}<p><span>Turn Ons:</span> {$UserInfo.turn_ons}{/if}
                            {if $UserInfo.turn_offs}<p><span>Turn Offs:</span> {$UserInfo.turn_offs}{/if}
                            {if $UserInfo.interested_in}<p><span>Intersted In:</span> {$UserInfo.interested_in}{/if}

                        </div>
                    </div>
                </div>
            </div>

        </div>
       {elseif $action == 'send'}
        <div class="rightpart">
            <div class="title-block"><div>Send Message</div></div>

            <div class="block">
              <div class="pad">
                 <form action="{$siteAdr}people/{$UserInfo.nickname}/send.html" name="SendMessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                 <input type="hidden" name="do"             value="1" />
                    <div class="form">
                      <div class="pad">
                         <div class="spacer"><!-- --></div>
                         <div class="name"><div>To:</div></div><div class="inp"><div><a href="{$siteAdr}people/{$nickname}/profile.html">{$whom|ucfirst}</a></div></div>
                         <div class="spacer s9"><!-- --></div>
                         <div class="name"><div>Subject:</div></div><div class="inp"><input type="text" name="mess[subject]" value=""></div>
                         <div class="spacer s9"><!-- --></div>
                         <div class="name"><div><br>Message:</div></div><div class="inp"><textarea name="mess[message]"></textarea></div>
                         <div class="spacer"><!-- --></div>
                      </div>
                    </div>

                    <div class="spacer s9"><!-- --></div>
                    <div class="link link-left"><a href="javascript:document.SendMessagesForm.submit();">Send</a></div>
                 </form>
                 </div>
            </div>
        </div>
       {elseif $action == 'mess'}
        <div class="rightpart">

            <div class="title-block"><div>{$Message}</div></div>
            <div class="block">
                 <div class="pad">
                      <div class="link link-left"><a href="{$siteAdr}people/{$UserInfo.nickname}/profile.html">Back to profile</a></div>
                </div>
            </div>
        </div>

       {elseif $action == 'search'}
        <div class="rightpart">
            <div class="title-block"><div>Search Results</div></div>
            {if $ErrMessage}<font color="red">{$ErrMessage}</font>{/if}
            <div class="block">
                <div class="padd">
                    <div class="link linkpad">{*<div class="left">{if 'recently_added' == $order}<div class="b">Recently Added</div>{else}<div><a href="{$siteAdr}people/search/?srh={$srh}&amp;do=1&amp;stype={$stype}&amp;order=recently_added">Recently Added</a></div>{/if}{if 'all' == $order}<div class="b_">All</div>{else}<div><a href="{$siteAdr}people/search/?srh={$srh}&amp;do=1&amp;stype={$stype}&amp;order=nickname">All</a></div>{/if}</div>*}{if 'all' == $order}{if $curPage>0}<a href="{$siteAdr}people/search/?srh={$srh}&amp;do=1&amp;stype={$stype}&amp;order={$order}&amp;pvstart={$pvstart-$ResOnPage}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}people/search/?srh={$srh}&amp;do=1&amp;stype={$stype}&amp;order={$order}&amp;pvstart={$pvstart+$ResOnPage}" class="b">Next</a>{else}<span>Next</span>{/if}{/if}</div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="photo-l">

                    {section name=iiu loop=$users}
                        <div class="p-item">
                            <div class="pic" style="height: 127px;"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html"><img src="{$siteAdr}{if $users[iiu].user_images.res_image}includes/data/gallery/{$users[iiu].user_images.res_image}{elseif $users[iiu].user_images.name}includes/data/gallery/{$users[iiu].user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                            <div class="name"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html">{$users[iiu].nickname|ucfirst}{if 'all' == $stype}, {$users[iiu].city_name.city_name}{/if}</a></div>
                        </div>
                        {if $smarty.section.iiu.rownum % 4 == 0 
                            && !$smarty.section.last}
                        <div class="spacer s6"><!-- --></div>
                        {/if}
                    {/section}
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link linkpad">{if 'all' == $order}{if $curPage>0}<a href="{$siteAdr}people/search/?srh={$srh}&amp;do=1&amp;stype={$stype}&amp;order={$order}&amp;pvstart={$pvstart-$ResOnPage}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}people/search/?srh={$srh}&amp;do=1&amp;stype={$stype}&amp;order={$order}&amp;pvstart={$pvstart+$ResOnPage}" class="b">Next</a>{else}<span>Next</span>{/if}{/if}</div>
                </div>
            </div>

        </div>

       {else}
        <div class="rightpart">
            <div class="title-block"><div>People in {$UserInfoCurrentCityName}</div></div>
            {if $ErrMessage}<font color="red">{$ErrMessage}</font>{/if}
            <div class="block">
                <div class="padd">
                    <div class="link linkpad"><div class="left">{if 'recently_added' == $order}<div class="b">Recently Added</div>{else}<div><a href="{$siteAdr}people/?order=recently_added">Recently Added</a></div>{/if}{if 'all' == $order}<div class="b_">All</div>{else}<div><a href="{$siteAdr}people/?order=nickname">All</a></div>{/if}</div>{if 'all' == $order}{if $curPage>0}<a href="{$siteAdr}people/?order={$order}&amp;pvstart={$pvstart-$ResOnPage}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}people/?order={$order}&amp;pvstart={$pvstart+$ResOnPage}" class="b">Next</a>{else}<span>Next</span>{/if}{/if}</div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="photo-l">

                    {section name=iiu loop=$users}
                        <div class="p-item">
                            <div class="pic" style="height: 127px;"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html"><img src="{$siteAdr}{if $users[iiu].user_images.res_image}includes/data/gallery/{$users[iiu].user_images.res_image}{elseif $users[iiu].user_images.name}includes/data/gallery/{$users[iiu].user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                            <div class="name"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html">{$users[iiu].nickname|ucfirst}</a></div>
                        </div>
                        {if $smarty.section.iiu.rownum % 4 == 0 
                            && !$smarty.section.last}
                        <div class="spacer s6"><!-- --></div>
                        {/if}
                    {/section}
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    <div class="link linkpad">{if 'all' == $order}{if $curPage>0}<a href="{$siteAdr}people/?order={$order}&amp;pvstart={$pvstart-$ResOnPage}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}people/?order={$order}&amp;pvstart={$pvstart+$ResOnPage}" class="b">Next</a>{else}<span>Next</span>{/if}{/if}</div>
                </div>
            </div>

        </div>
       {/if}
   </div>