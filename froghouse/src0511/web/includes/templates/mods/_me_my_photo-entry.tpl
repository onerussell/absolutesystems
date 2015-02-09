    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/photo/_left_menu.tpl"}
        {/if}
            
        <div class="rightpart">

            <div class="title-block"><div>{$author.nickname} {#fpost#} {$inf.pdate|lower}</div></div>
            <div class="block">
                <div class="pad">
                    <div class="blog-l">
                        <div class="b-item">
                            <div class="date">{$inf.pdate}</div>
                            <div class="title">{$inf.title}</div>
                            <div class="text">
                                <a href="{$siteAdr}showimg.php?img={$inf.image}"  onClick="window.open('{$siteAdr}showimg.php?img={$inf.image}','popup','resizable=1,left=0,top=0, width=50, height=50, scrollbars=yes'); return false;"><img src="{$siteAdr}{$imagedir}{if $inf.cached == 1}{$cachedir2}{/if}{$inf.image}" /></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="spacer s9"><!-- --></div>
                    {if $is_user == 1}<div class="link link-left"><a href="{$inf.link_del}">{#tdelete#} {#image#}</a></div>{/if}
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>
            {if $list}
            <div class="title-block"><div>{#comments#}</div></div>
            <div class="block">
                <div class="pad">
                  {*comment*}           
                    {section name = i loop = $list}
                    <div class="post">
                        <div class="post-item">
                            <div class="pic"><a href="{$siteAdr}users/{$list[i].user.nickname}/profile.html">{if $list[i].user_pic.res_image <> ''}<img src="{$siteAdr}includes/data/gallery/{$list[i].user_pic.res_image}" alt="{$list[i].user.nickname}" />
                                            {elseif $list[i].user_pic.name <> ''}<img src="{$siteAdr}includes/data/gallery/{$list[i].user_pic.name}" alt="{$list[i].user.nickname}">{/if}</a></div>
                            <div class="text"><span class="name"><a href="{$siteAdr}users/{$list[i].user.nickname}/profile.html">{$list[i].user.nickname}</a></span><span class="date">{$list[i].pdate}</span>
                            {$list[i].descr}
                            {if $is_user == 1 || $list[i].uid == $uinfo[0]}<div class="links"><a href="{$list[i].link_ed}">Edit {#comment#}</a>&nbsp;&nbsp;<a href="{$list[i].link_del}">{#tdelete#} {#comment#}</a></div>{/if}
                            </div>
                        </div>
                        <div class="spacer"><!-- --></div>
                    </div>  
                        <div class="spacer s9 bg-grey"><!-- --></div>
                    {/section}
                    <div class="link linkpad"><div class="left"><div></div></div>{$_pagging}</div>
                </div>
            </div>
            {/if}
            <div class="spacer s15"><!-- --></div>
            {include file="mods/photo/_add_comment.tpl"}
        </div>

        <div class="spacer"><!-- --></div>
    </div>