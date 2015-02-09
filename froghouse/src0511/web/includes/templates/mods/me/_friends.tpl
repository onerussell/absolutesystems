    <div class="maincontainer">
    {include file="mods/me/_left_menu.tpl"}
        <div class="rightpart">

           {if !$action || $action == 'overview'}
               <div class="rightpart">
                   <div class="title-block"><div>My Friends{if $users_cnt} ({$users_cnt}){/if}</div></div>
                   {if $ErrMessage}<font color="red">{$ErrMessage}</font>{/if}
                   <div class="block">
                       <div class="padd">
                           <div class="link linkpad"><div class="left">{if 'recently_added' == $order}<div class="b">Recently Added</div>{else}<div><a href="{$siteAdr}?mod=friends&amp;order=recently_added">Recently Added</a></div>{/if}{if 'all' == $order}<div class="b_">All</div>{else}<div><a href="{$siteAdr}?mod=friends&amp;order=nickname">All</a></div>{/if}</div>{if 'all' == $order}{if $curPage>0}<a href="{$siteAdr}?mod=friends&amp;order={$order}&amp;pvstart={$pvstart-$ResOnPage}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}?mod=friends&amp;order={$order}&amp;pvstart={$pvstart+$ResOnPage}" class="b">Next</a>{else}<span>Next</span>{/if}{/if}</div>
                           <div class="spacer s9"><!-- --></div>
                           <div class="photo-l">
        
                           {section name=iiu loop=$users}
                               <div class="p-item">
                                   <div class="pic" style="height: 127px;"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html"><img src="{$siteAdr}{if $users[iiu].user_images.res_image}includes/data/gallery/{$users[iiu].user_images.res_image}{elseif $users[iiu].user_images.name}includes/data/gallery/{$users[iiu].user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                                   <div class="name"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html">{$users[iiu].nickname|ucfirst}, {$users[iiu].city_name.city_name}</a></div>
                               </div>
                               {if $smarty.section.iiu.rownum % 4 == 0 
                                   && !$smarty.section.last}
                               <div class="spacer s6"><!-- --></div>
                               {/if}
                           {/section}
                           </div>
                           <div class="spacer s9"><!-- --></div>
                           <div class="link linkpad">{if 'all' == $order}{if $curPage>0}<a href="{$siteAdr}?mod=friends&amp;order={$order}&amp;pvstart={$pvstart-$ResOnPage}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}?mod=friends&amp;order={$order}&amp;pvstart={$pvstart+$ResOnPage}" class="b">Next</a>{else}<span>Next</span>{/if}{/if}</div>
                       </div>
                   </div>
        
               </div>
           {/if}
        </div>
    </div>