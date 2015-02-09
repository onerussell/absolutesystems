    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/blog/_left_menu.tpl"}
        {/if}

        <div class="rightpart">
            <div class="title-block"><div>{$add_title}</div></div>
                        <div class="block">
                                <div class="pad">
                                        <form {$fdata.attributes}>
                                        <div class="form">
                                        {if $fdata.errors}
                                        {foreach from=$fdata.errors item=err}
                                        <p style="color:red">&nbsp;&nbsp;{$err}</p>
                                        {/foreach}
                                        {/if}
                                        {section name=i loop=$fdata.elements}
                                        {if $fdata.elements[i].type=='hidden'}{$fdata.elements[i].html}{/if}
                                        {/section}
                                        <div class="pad">
                                                <div class="spacer"><!-- --></div>
                                                <div class="name"><div>{#pfrom#}:</div></div><div class="inp"><div><a href="#">{$nickname}</a></div></div>
                                                <div class="spacer s9"><!-- --></div>
                                                {*
                                                <div class="name"><div>{#psubject#}:</div></div><div class="inp"> {section name=i loop=$fdata.elements}{if $fdata.elements[i].type=='text'}{$fdata.elements[i].html}{/if}{/section}</div>
                                                <div class="spacer s9"><!-- --></div>
                                                *}
                                                <div class="spacer s9"><!-- --></div>
                                                <div class="name"><div><br>{#pmessage#}:</div></div><div class="inp"> {section name=i loop=$fdata.elements}{if $fdata.elements[i].type=='textarea'}{$fdata.elements[i].html}{/if}{/section}</div>
                                                <div class="spacer"><!-- --></div>
                                        </div>
                                        </div>

                                        <div class="spacer s9"><!-- --></div>
                                        <div class="link link-left"><a href="#" onclick="document.eform.submit();return false;">{#post_it#}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$blink}">{#cancel#}</a></div>
                                        </form>
                                </div>
                        </div>
        </div>
        <div class="spacer"><!-- --></div>
    </div>                      