<select name="UserInfo[{$field}]" style="font-size:12px;width:150px;" /> 
{section name=iic loop=$st_ar}
<option value="{$st_ar[iic].city_id}" {if $st_ar[iic].city_id == $city_id}selected="selected"{/if}>{$st_ar[iic].name}</option>
{sectionelse}
<option value="0">{#notinlist#}</option>
{/section}
</select>
