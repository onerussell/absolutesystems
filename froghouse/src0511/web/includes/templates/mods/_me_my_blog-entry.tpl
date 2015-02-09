    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/blog/_left_menu.tpl"}
        {/if}

        <div class="rightpart">

            <div class="title-block"><div>{$author.nickname} {#wrote#} {$inf.pdate|lower}</div></div>
            <div class="block">
                <div class="pad">
                    <div class="blog-l">
                        <div class="b-item">
                            <div class="date">{$inf.pdate}</div>
                            <div class="title">{$inf.name}</div>
                            <div class="text">{$inf.descr}</div>
                        </div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    {if $is_user == 1}<div class="link link-left"><a href="{$inf.link_ed}">Edit {#tmessage#}</a>&nbsp;&nbsp;<a href="{$inf.link_del}">{#tdelete#} {#tmessage#}</a></div>{/if}
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>
           {if $list}
            <div class="title-block"><div>{#comment#}</div></div>
            <div class="block">
                <div class="pad">
        
                    {section name = i loop = $list}
                    <div class="post">
                        <div class="post-item">
                            <div class="pic"><a href="{$siteAdr}users/{$list[i].user.nickname}/profile.html">{if $list[i].user_pic.res_image <> ''}<img src="{$siteAdr}includes/data/gallery/{$list[i].user_pic.res_image}" alt="{$list[i].user.nickname}" />
                                            {elseif $list[i].user_pic.name <> ''}<img src="{$siteAdr}includes/data/gallery/{$list[i].user_pic.name}" alt="{$list[i].user.nickname}">{/if}</a></div>
                            <div class="text"><span class="name"><a href="{$siteAdr}users/{$list[i].user.nickname}/profile.html">{$list[i].user.nickname}</a></span><span class="date">{$list[i].pdate}</span>
                            {$list[i].descr}
                            {if $is_user == 1 || $list[i].uid == $uinfo[0]}<div class="links"><a href="{$list[i].link_ed}">Edit {#comment#}</a> <span class="razd">|</span> <a href="{$list[i].link_del}">{#tdelete#} {#comment#}</a></div>{/if}
                            </div> 
                        </div>
                        <div class="spacer"><!-- --></div>
                    </div>
                       <div class="spacer s9 bg-grey"><!-- --></div>    
                    {/section}
                    {*include file="mods/blog/post_comment_form.tpl"*}        
                    <div class="link linkpad"><div class="left"><div></div></div>{$_pagging}</div>
                </div>
            </div>
            <div class="spacer s15"><!-- --></div>
            {/if}
            {include file="mods/blog/_add_comment.tpl"}
        </div>

        <div class="spacer"><!-- --></div>
    </div>