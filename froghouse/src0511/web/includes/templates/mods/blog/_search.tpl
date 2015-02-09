    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/blog/_left_menu.tpl"}
        {/if}

        <div class="rightpart">

            <div class="title-block"><div>Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       {if $_text <> ''}
                       {$_text}
                       {/if}
                       {section name = i loop = $list} 
                       <div class="item"><a href="{$list[i].link}">{$list[i].title}</a></div>
                       {/section}
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div>{$_pagging}</div>
                </div>
            </div>

            <div class="spacer s8"><!-- --></div>

        </div>
    <div class="spacer"><!-- --></div>
    </div>      
        
