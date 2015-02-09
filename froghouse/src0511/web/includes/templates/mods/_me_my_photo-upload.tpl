    <div class="maincontainer">
        {if $is_user != 1 && $UserInfo}
            {include file="mods/people/_left_menu.tpl"}
        {else}
            {include file="mods/photo/_left_menu.tpl"}
        {/if}
        <div class="rightpart">

            <div class="title-block"><div>Upload photo</div></div>
            <div class="block">
                <div class="pad">
                    <div class="form">
                    <div class="pad">
                        <b>Choose the photo to upload</b><br>
                        <span class="note">Maximum file size is 2Mb. Our service will automatically create a thumbnail.</span>
                        {if $fdata.javascript}
                         {$fdata.javascript}
                        {/if}
 
                        <form {$fdata.attributes}>
                        {if $fdata.errors}
                        {foreach from=$fdata.errors item=err}
                        <p style="color:red">{$err}</p>
                        {/foreach}
                       {/if}
                       {section name=i loop=$fdata.elements}
                       {if $fdata.elements[i].type=='hidden'}
                           {$fdata.elements[i].html}
                       {/if}
                       {/section}
                       {section name=i loop=$fdata.elements}
                       {if $fdata.elements[i].type=='file'}
                           {$fdata.elements[i].html}
                       {/if}
                       {/section}
                        <p><b>Label</b><br>
                        <span class="note">Label the photo. For example, "University Buildin"g or "My favourite club".<br>Letters, numbers and spaces only.<br>If you leave this field blank, the name of the file will be used.</span><br>
                       {section name=i loop=$fdata.elements}
                       {if $fdata.elements[i].type=='text'}
                           {$fdata.elements[i].html}
                       {/if}
                       {/section}
                        <p><input type="submit" value="Upload File"><br>
                        </form>
                        <span class="note">* Please be patient. Upload may take several minutes.</span>
                    </div>
                    </div>
                    <div class="spacer s9"><!-- --></div>
                </div>
            </div>

        </div>
