    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/photo/_left_menu.tpl"}
        {/if}
        <div class="rightpart">

            <div class="title-block"><div>{#my_photo#}</div></div>
            <div class="block">
                <div class="pad">
                    <div class="link linkpad">{$_pagging}</div>
                    <div class="spacer s9"><!-- --></div>

                    <div class="photos-l">
                        {section name = i loop = $list}
                        {if $smarty.section.i.index mod 3 == 0}
                        <div class="pitem">
                            <div class="pic picv">{if $list[i].image <> ''}<a href="{$list[i].link}"><img src="{$siteAdr}{$imagedir}{if $list[i].cached == 1}{$cachedir}{/if}{$list[i].image}" border="0" /></a>{/if}</div>
                            <div class="name"><a href="{$list[i].link}">{if $list[i].pcnt == 0}{#nocomments#}{else}{$list[i].pcnt} {#comments#}{/if}</a></div>
                        </div>
                        {elseif $smarty.section.i.index_next mod 3 <> 0}
                        <div class="pitem">
                            <div class="pic picv">{if $list[i].image <> ''}<a href="{$list[i].link}"><img src="{$siteAdr}{$imagedir}{if $list[i].cached == 1}{$cachedir}{/if}{$list[i].image}" border="0" /></a>{/if}</div>
                            <div class="name"><a href="{$list[i].link}">{if $list[i].pcnt == 0}{#nocomments#}{else}{$list[i].pcnt} {#comments#}{/if}</a></div>
                        </div>
                        {else}
                        <div class="pitem pitem-last">
                            <div class="pic picv">{if $list[i].image <> ''}<a href="{$list[i].link}"><img src="{$siteAdr}{$imagedir}{if $list[i].cached == 1}{$cachedir}{/if}{$list[i].image}" border="0" /></a>{/if}</div>
                            <div class="name"><a href="{$list[i].link}">{if $list[i].pcnt == 0}{#nocomments#}{else}{$list[i].pcnt} {#comments#}{/if}</a></div>
                        </div>
                        {/if}
                        {/section}

                        <div class="spacer s15"><!-- --></div>


                    </div>

                    <div class="spacer s9"><!-- --></div>
                    <div class="link linkpad">{$_pagging}</div>
                </div>
            </div>

        </div>

    <div class="spacer"><!-- --></div>
    </div>
