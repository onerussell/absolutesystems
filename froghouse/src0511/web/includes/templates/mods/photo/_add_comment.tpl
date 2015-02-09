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
                                                <div class="name"><div>{#pfrom#}:</div></div><div class="inp"><div><a href="{$siteAdr}users/{$nickname}/profile.html">{$nickname}</a></div></div>
                                                {*
												<div class="spacer s9"><!-- --></div>
                                                <div class="name"><div>{#psubject#}:</div></div><div class="inp"> {section name=i loop=$fdata.elements}{if $fdata.elements[i].type=='text'}{$fdata.elements[i].html}{/if}{/section}</div>
                                                *}
												<div class="spacer s9"><!-- --></div>
                                                <div class="name"><div><br>{#pmessage#}:</div></div><div class="inp"> {section name=i loop=$fdata.elements}{if $fdata.elements[i].type=='textarea'}{$fdata.elements[i].html}{/if}{/section}</div>
                                                <div class="spacer"><!-- --></div>
                                        </div>
                                        </div>

                                        <div class="spacer s9"><!-- --></div>
                                        <div class="link link-left"><a href="#" onclick="document.eform.submit();return false;">{#post_it#}</a></div>
                                        </form>
                                </div>
                        </div>