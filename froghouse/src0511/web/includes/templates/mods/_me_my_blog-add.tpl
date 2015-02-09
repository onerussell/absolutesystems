    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/blog/_left_menu.tpl"}
        {/if}

        <div class="rightpart">

            {include file="mods/blog/_add_comment.tpl"}
        
        </div>

        <div class="spacer"><!-- --></div>
    </div>