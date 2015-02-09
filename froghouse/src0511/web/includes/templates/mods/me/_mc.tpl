    <script type="text/javascript" language="JavaScript" src="{$siteAdr}includes/templates/js/main.js">
    </script>
    <div class="maincontainer">
    {include file="mods/me/_left_menu.tpl"}
        <div class="rightpart">

            {if $action == 'inbox' || $action == 'sent' || $action == 'deleted'}
                 {if !$add_action || $add_action=='view'}
                 <div class="title-block"><div>{if 'inbox' == $action}My Inbox{elseif 'sent' == $action}Sent Items{elseif 'deleted' == $action}Deleted Items{/if} {if $mess_cnt > 0} ({$mess_cnt}{if $action == 'inbox'} new{/if}){/if}</div></div>
                 <div class="block">
                    <form action="{$siteAdr}" name="MessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="id"             value="-1" />
                    <input type="hidden" name="action"         value="{$action}" />
                    <input type="hidden" name="add_action"     value="delete" />
                    <input type="hidden" name="pvstart"        value="{$pvstart}" />
                    <input type="hidden" name="order"          value="{$order}" />
                    <div class="pad">
                
                         <div class="link linkpad"><div class="left"><div class="checks"><div><input type="checkbox" name="checkall1" value="1" onClick="javascript:selControl(this);" /></div></div><div>Sorting:&nbsp;&nbsp;<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={if $order == 1}2{else}1{/if}" {if $order == 1}class="fh"{elseif $order == 2}class="f"{/if}>{if $action == 'inbox'}From{elseif $action == 'sent'}To{else}From/To{/if}{if $order == 1 || $order == 2}&nbsp;&nbsp;{/if}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={if $order == 4}3{else}4{/if}" {if $order == 3}class="fh"{elseif $order == 4}class="f"{/if}>Date{if $order == 3 || $order == 4}&nbsp;&nbsp;{/if}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={if $order == 5}6{else}5{/if}" {if $order == 5}class="fh"{elseif $order == 6}class="f"{/if}>Subject{if $order == 5 || $order == 6}&nbsp;&nbsp;{/if}</a></div></div>{if $curPage>0}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart-$ResOnPage}&amp;order={$order}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart+$ResOnPage}&amp;order={$order}" class="b">Next</a>{else}<span>Next</span>{/if}</div>
                         <div class="spacer s9"><!-- --></div>
                         {if $code}
                         <div class="post">
                             <div class="post-item">
                             <b><br />&nbsp;&nbsp;&nbsp;<font color="red">{$code}</font></b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         {/if}
                         {section name=iim loop=$mess}
                         <div class="post">
                             <div class="post-item">
                                 <div class="check"><div><input type="checkbox" id="check_{$mess[iim].id}" name="check[{$mess[iim].id}]" /></div></div>
                                 <div class="pic"><a href="{$siteAdr}people/{$mess[iim].nickname}/profile.html"><img src="{$siteAdr}{if $mess[iim].user_images.res_image}includes/data/gallery/{$mess[iim].user_images.res_image}{elseif $mess[iim].user_images.name}includes/data/gallery/{$mess[iim].user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                                 <div class="text mt-width"><span class="name"><a href="{$siteAdr}people/{$mess[iim].nickname}/profile.html">{$mess[iim].nickname|capitalize}</a></span><span class="date">{$mess[iim].sendtime|date_format:"%A, %e %b, %Y<br />%I:%M %p"|lower|ucfirst}</span><p class="small">{if $action == 'inbox' && !$mess[iim].readed}<b>{$mess[iim].subject}</b>{else}{$mess[iim].subject}{/if} {if $action =='deleted'}<br /><br /><b>{if $uinfo[0]==$mess[iim].toid}[Incomming message]{else}[Sent message]{/if}</b>{/if}
                                     <div class="e-link"><a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=read&amp;id={$mess[iim].id}" class="read">Read</a>{if $action == 'inbox'}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=reply&amp;id={$mess[iim].id}" class="reply">Reply</a>{/if}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=delete&amp;id={$mess[iim].id}" onClick="if (!confirmLink(this, 'You really want to delete selected message ?')) return false;" class="delete">Delete</a></div>
                                 </div>
                
                                 <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         {if !$smarty.section.iim.last}<div class="spacer s7"><!-- --></div>{/if}
                         {sectionelse}
                         <div class="post">
                             <div class="post-item">
                             <b>No messages</b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         {/section}
                         <div class="spacer s13"><!-- --></div>
                
                         <div class="link linkpad"><div class="left"><a href="{if $smarty.section.iim.total == 0}javascript:;{else}{$siteAdr}{/if}" class="d" {if $smarty.section.iim.total > 0}onClick="javascript:if (confirmLink(this, 'You really want to delete selected messages ?')) {literal}{{/literal} document.MessagesForm.id.value='-1'; document.MessagesForm.add_action.value='delete'; document.MessagesForm.submit();{literal}}{/literal}; return false;"{/if} >Delete selected</a></div>{if $curPage>0}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart-$ResOnPage}&amp;order={$order}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart+$ResOnPage}&amp;order={$order}" class="b">Next</a>{else}<span>Next</span>{/if}</div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                         </form>
                 </div>
                 {elseif $add_action == 'read'}
                 <div class="title-block"><div>{if 'inbox' == $action}My Inbox{elseif 'sent' == $action}Sent Items{elseif 'deleted' == $action}Deleted Items{/if} {if $mess_cnt > 0} ({$mess_cnt}{if $action == 'inbox'} new{/if}){/if}</div></div>
                 <div class="block">
                     <div class="pad">
                         <div class="post">
                             <div class="post-item">
                                 <div class="pic"><a href="{$siteAdr}people/{$message.nickname}/profile.html"><img src="{$siteAdr}{if $message.user_images.res_image}includes/data/gallery/{$message.user_images.res_image}{elseif $message.user_images.name}includes/data/gallery/{$message.user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                                 <div class="text"><span class="name"><a href="{$siteAdr}people/{$message.nickname}/profile.html">{$message.nickname|ucfirst}</a></span><span class="date">Posted on {$message.sendtime|date_format:"%B %e, %Y at %I:%M %p"|lower|ucfirst}</span>{$message.subject}{if $action=='deleted'}<br /><br /><b>{if $message.toid == $uinfo[0]}[Incomming message]{else}[Sent message]{/if}</b>{/if}</div>
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="text padt">{$message.message|nl2br}</div>
                
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="edit-link">{if $action == 'inbox'}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=reply&amp;id={$message.id}" class="reply">Reply</a>{/if}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=delete&amp;id={$message.id}" onClick="if (!confirmLink(this, 'You really want to delete this message ?')) return false;" class="delete">Delete</a></div>
                                 <div class="spacer s9"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         <div class="spacer s13"><!-- --></div>
                         <div class="link linkpad">{if $message.prev_id}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action={$add_action}&amp;id={$message.prev_id}" class="b" >Previous Message</a>{else}<span>Previous Message</span>{/if}&nbsp;&nbsp;&nbsp;{if $message.next_id}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action={$add_action}&amp;id={$message.next_id}" class="b" >Next Message</a>{else}<span>Next Message</span>{/if}</div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                 </div>
                 {elseif $add_action == 'reply' && $action =='inbox'}
                 <div class="title-block"><div>Message from {$message.nickname|ucfirst}</div></div>
                 <div class="block">
                     <div class="pad">
                         <div class="post">
                             <div class="post-item">
                                 <div class="pic"><a href="{$siteAdr}people/{$message.nickname}/profile.html"><img src="{$siteAdr}{if $message.user_images.res_image}includes/data/gallery/{$message.user_images.res_image}{elseif $message.user_images.name}includes/data/gallery/{$message.user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                                 <div class="text"><span class="name"><a href="{$siteAdr}people/{$message.nickname}/profile.html">{$message.nickname|ucfirst}</a></span><span class="date">Posted on {$message.sendtime|date_format:"%B %e, %Y at %I:%M %p"|lower|ucfirst}</span>{$message.subject}{if $action=='deleted'}<br /><br /><b>{if $message.toid == $uinfo[0]}[Incomming]{else}[Sent]{/if}</b>{/if}</div>
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="text padt">{$message.message|nl2br}</div>
                
                                 <div class="spacer s9"><!-- --></div>
                                 <div class="edit-link"><a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=delete&amp;id={$message.id}" onClick="if (!confirmLink(this, 'You really want to delete this message ?')) return false;" class="delete">Delete</a></div>
                                 <div class="spacer s9"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         <div class="spacer s13"><!-- --></div>
                         <div class="link linkpad">{if $message.prev_id}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action={$add_action}&amp;id={$message.prev_id}" class="b" >Previous Message</a>{else}<span>Previous Message</span>{/if}&nbsp;&nbsp;&nbsp;{if $message.next_id}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action={$add_action}&amp;id={$message.next_id}" class="b" >Next Message</a>{else}<span>Next Message</span>{/if}</div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                 </div>
                 <div class="spacer s15"><!-- --></div>
                
                 <div class="title-block"><div>Reply Message</div></div>
                 <div class="block">
                    <form action="{$siteAdr}" name="ReplyMessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="id"             value="{$message.id}" />
                    <input type="hidden" name="action"         value="{$action}" />
                    <input type="hidden" name="add_action"     value="reply" />
                    <input type="hidden" name="do"             value="1" />
                    <input type="hidden" name="pvstart"        value="{$pvstart}" />
                    <input type="hidden" name="order"          value="{$order}" />
                     <div class="pad">
                         <div class="form">
                         <div class="pad">
                             <div class="spacer"><!-- --></div>
                             <div class="name"><div>To:</div></div><div class="inp"><div><a href="{$siteAdr}people/{$mess[iim].nickname}/profile.html">{$message.nickname|ucfirst}</a></div></div>
                             <div class="spacer s9"><!-- --></div>
                             <div class="name"><div>Subject:</div></div><div class="inp"><input type="text" name="mess[subject]" value="Re: {$message.subject}"></div>
                             <div class="spacer s9"><!-- --></div>
                             <div class="name"><div><br>Message:</div></div><div class="inp"><textarea name="mess[message]"></textarea></div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         </div>
                
                         <div class="spacer s9"><!-- --></div>
                         <div class="link link-left"><a href="javascript:document.ReplyMessagesForm.submit();">Send</a></div>
                     </div>
                    </form>
                 </div>
                 {/if}

           {elseif $action == 'friends_req' || $action == 'pending_req'}
                 <div class="title-block"><div>{if 'friends_req' == $action}These people want to be friends with you{elseif 'pending_req' == $action}Rejects{/if}{if $mess_cnt}({$mess_cnt}){/if}</div></div>
                
                 {if !$add_action || $add_action=='view'}
                 <div class="block">
                    <form action="{$siteAdr}" name="MessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="id"             value="-1" />
                    <input type="hidden" name="action"         value="{$action}" />
                    <input type="hidden" name="add_action"     value="delete" />
                    <input type="hidden" name="pvstart"        value="{$pvstart}" />
                    <input type="hidden" name="order"          value="{$order}" />
                    <div class="pad">
                
                         <div class="link linkpad"><div class="left"><div class="checks"><div><input type="checkbox" name="checkall1" value="1" onClick="javascript:selControl(this);" /></div></div></div>{if $curPage>0}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart-$ResOnPage}&amp;order={$order}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart+$ResOnPage}&amp;order={$order}" class="b">Next</a>{else}<span>Next</span>{/if}</div>
                         <div class="spacer s9"><!-- --></div>
                         {if $code}
                         <div class="post">
                             <div class="post-item">
                             <b><br />&nbsp;&nbsp;&nbsp;<font color="red">{$code}</font></b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         {/if}
                         {section name=iim loop=$mess}
                         <div class="post">
                             <div class="post-item">
                                 <div class="check"><div><input type="checkbox" id="check_{$mess[iim].id}" name="check[{$mess[iim].id}]" /></div></div>
                                 <div class="pic"><a href="{$siteAdr}people/{$mess[iim].nickname}/profile.html"><img src="{$siteAdr}{if $mess[iim].user_images.res_image}includes/data/gallery/{$mess[iim].user_images.res_image}{elseif $mess[iim].user_images.name}includes/data/gallery/{$mess[iim].user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                                 <div class="text mt-width"><span class="name"><a href="{$siteAdr}people/{$mess[iim].nickname}/profile.html">{$mess[iim].nickname|capitalize}</a></span><span class="date">{$mess[iim].sendtime|date_format:"%A, %e %b, %Y<br />%I:%M %p"|lower|ucfirst}</span>
                                     <div class="e-link">{if 'friends_req' == $action}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=approve&amp;id={$mess[iim].id}" class="reply">Approve</a>{/if}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart}&amp;order={$order}&amp;add_action=delete&amp;id={$mess[iim].id}" onClick="if (!confirmLink(this, 'You really want to {if 'friends_req' == $action}disapprove{else}delete{/if} selected request ?')) return false;" class="delete">{if 'friends_req' == $action}Disapprove{else}Delete{/if}</a></div>
                                 </div>
                
                                 <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                
                         {if !$smarty.section.iim.last}<div class="spacer s7"><!-- --></div>{/if}
                         {sectionelse}
                         <div class="post">
                             <div class="post-item">
                             <b>No requests</b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         {/section}
                         <div class="spacer s13"><!-- --></div>
                
                         <div class="link linkpad"><div class="left"><a href="{if $smarty.section.iim.total == 0}javascript:;{else}{$siteAdr}{/if}" class="d" {if $smarty.section.iim.total > 0}onClick="javascript:if (confirmLink(this, 'You really want to delete selected requests ?')) {literal}{{/literal} document.MessagesForm.id.value='-1'; document.MessagesForm.add_action.value='delete'; document.MessagesForm.submit();{literal}}{/literal} return false;"{/if} >Delete selected</a></div>{if $curPage>0}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart-$ResOnPage}&amp;order={$order}" class="b">Previous</a>{else}<span>Previous</span>{/if}&nbsp;&nbsp;&nbsp;Page {$curPage+1} of {if $pages == 0}1{else}{$pages}{/if}&nbsp;&nbsp;&nbsp;{if $curPage < $pages-1}<a href="{$siteAdr}?mod=mc&amp;action={$action}&amp;pvstart={$pvstart+$ResOnPage}&amp;order={$order}" class="b">Next</a>{else}<span>Next</span>{/if}</div>
                         <div class="spacer s6"><!-- --></div>
                     </div>
                   </form>
                 </div>
                 {/if}
           {elseif 'settings' == $action}
                 <div class="title-block"><div>Mail Settings</div></div>
                
                 {if !$add_action || $add_action=='view'}
                 <div class="block">
                    <div class="pad">
                    <form action="{$siteAdr}" name="SettingsForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="action"         value="settings" />
                    <input type="hidden" name="add_action"     value="change" />
                
                         <div class="spacer s9"><!-- --></div>
                         {if $code}
                         <div class="post">
                             <div class="post-item">
                             <b><br />&nbsp;&nbsp;&nbsp;<font color="red">{$code}</font></b>
                             <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>
                         </div>
                         {/if}
                         <div class="post">

                             {*<div class="post-item">
                                 <div class="link linkpad">
                                    <div class="left">
                                        <div class="check">
                                            <input type="checkbox" name="checkall1" value="1" />
                                        </div>
                                        <div>&nbsp;&nbsp;&nbsp;Always ask friend requests</div>
                                    </div>
                                 </div>
                                 <div class="spacer"><!-- --></div>
                             </div>*}

                             <div class="post-item">
                                 <div class="link linkpad">
                                    <div class="left">
                                        <div class="check">
                                            <input type="checkbox" name="Settings[Friends][Always]" value="1" {if $settings.Friends.Always}checked="checked"{/if} />
                                        </div>
                                        <div>&nbsp;&nbsp;&nbsp;Automatically accept all incoming friend requests</div>
                                    </div>
                                 </div>
                                 <div class="spacer"><!-- --></div>
                             </div>
                             <div class="spacer"><!-- --></div>

                         </div>
                         <div class="link link-left"><a href="javascript:document.SettingsForm.submit();">Submit</a></div>
                         </form>
                     </div>
                 </div>
                 {/if}

           {/if}
        </div>
    </div>