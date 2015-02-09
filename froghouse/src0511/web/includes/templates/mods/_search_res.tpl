    <div class="maincontainer">
        <div class="leftpart">

            <div class="rightmenu m-grey">
                <div class="bg-top">
                    <div class="bg-bottom">
                        <div class="left-search">Search result
                            <div class="spacer s8"><!-- --></div>
                            <span>&nbsp;</span>
                            <div class="spacer s15"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        
        <div class="rightpart">

           {if $users}
            <div class="title-block"><div>People / Search Result</div></div>
            <div class="block">
                <div class="padd">
                    <div class="photo-l">

                    {section name=iiu loop=$users}
                        <div class="p-item">
                            <div class="pic" style="height: 127px;"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html"><img src="{$siteAdr}{if $users[iiu].user_images.res_image}includes/data/gallery/{$users[iiu].user_images.res_image}{elseif $users[iiu].user_images.name}includes/data/gallery/{$users[iiu].user_images.name}{else}includes/templates/images/nf.gif{/if}" width="110" alt=""></a></div>
                            <div class="name"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html">{$users[iiu].nickname|ucfirst}{if 'all' == $stype}, {$users[iiu].city_name.city_name}{/if}</a></div>
                        </div>
                    {/section}
                    </div>
                    {*<div class="list">
                       {section name = iiu loop = $users}
                       <div class="item"><a href="{$siteAdr}people/{$users[iiu].nickname|ucfirst}/profile.html">{$users[iiu].nickname|ucfirst}, {$users[iiu].city_name.city_name}</a></div>
                       {/section}
                    </div>*}
                    <div class="link linkpad"><div class="left"><div></div></div><a href="{$siteAdr}people/search/?do=1&srh={$sstr}&stype=all">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           {/if}

           {if $list.nightlife}
            <div class="title-block"><div>Nightlife / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       {section name = i loop = $list.nightlife}
                       <div class="item"><a href="{$list.nightlife[i].link}">{$list.nightlife[i].title}</a></div>
                       {/section}
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="{$siteAdr}page.php?mod=nightlife&action=search&sstr={$sstr}&stype={$stype}">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           {/if}

           {if $list.culture}
            <div class="title-block"><div>Culture / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       {section name = i loop = $list.culture}
                       <div class="item"><a href="{$list.culture[i].link}">{$list.culture[i].title}</a></div>
                       {/section}
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="{$siteAdr}page.php?mod=culture&action=search&sstr={$sstr}&stype={$stype}">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           {/if}

           {if $list.food}
            <div class="title-block"><div>Food / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       {section name = i loop = $list.food}
                       <div class="item"><a href="{$list.food[i].link}">{$list.food[i].title}</a></div>
                       {/section}
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="{$siteAdr}page.php?mod=food&action=search&sstr={$sstr}&stype={$stype}">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
            {/if}

           {if $list.lodging}
            <div class="title-block"><div>Lodging / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       {section name = i loop = $list.lodging}
                       <div class="item"><a href="{$list.lodging[i].link}">{$list.lodging[i].title}</a></div>
                       {/section}
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="{$siteAdr}page.php?mod=lodging&action=search&sstr={$sstr}&stype={$stype}">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
            {/if}

           {if $list.necessities}
            <div class="title-block"><div>Necessities / Search Result</div></div>
            <div class="block">
                <div class="pad">
                    <div class="list">
                       {section name = i loop = $list.necessities}
                       <div class="item"><a href="{$list.necessities[i].link}">{$list.necessities[i].title}</a></div>
                       {/section}
                    </div>
                    <div class="link linkpad"><div class="left"><div></div></div><a href="{$siteAdr}page.php?mod=necessities&action=search&sstr={$sstr}&stype={$stype}">Show more</a></div>
                </div>
            </div>
            <div class="spacer s8"><!-- --></div>
           {/if}


        </div>

    <div class="spacer"><!-- --></div>
    </div>