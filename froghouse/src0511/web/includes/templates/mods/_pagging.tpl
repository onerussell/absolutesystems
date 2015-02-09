{#display#} <strong>{$range.0+1}-{$range.1}</strong> {#of#} <strong>{$range.2}</strong> {#items#}&nbsp;&nbsp;&nbsp; 
<strong>{#page#} </strong>
{section name = i loop = $pages}
{if $page == $pages[i].page}
<a href="{$pages[i].link}"><strong>{$pages[i].page}</strong></a>
{else}
<strong> <a href="{$pages[i].link}">{$pages[i].page}</a></strong>
{/if}
{/section}