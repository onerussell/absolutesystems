    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/blog/_left_menu.tpl"}
        {/if}
        
        <div class="rightpart">
           
            <div class="title-block"><div>My Recent Blog Entries:</div></div>
            <div class="block">
                <div class="pad">
                    {section name = i loop = $list}
                    <div class="blog-l">
                        <div class="b-item">
                            <div class="date">{$list[i].pdate}</div>
                            <div class="title">{$list[i].title}</div>
                            <div class="text">{$list[i].descr}</div>
                            <div class="link">{if $is_user == 1}<a href="{$list[i].link_ed}">Edit {#tmessage#}</a><span class="razd">|</span><a href="{$list[i].link_del}">{#tdelete#} {#tmessage#}</a><span class="razd">|</span>{/if}<a href="{$list[i].link}">{if $list[i].pcnt == 0}{#nocomments#}{else}{$list[i].pcnt} {#comments#}{/if}</a><span class="razd">|</span><a href="{$list[i].link}">{#add_message#}</a></div>
                        </div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                    {/section}
                    <div class="link">{$_pagging}</div>
                </div>
            </div>
        </div>
        <div class="spacer"><!-- --></div>
    </div>