{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<h1>{"Template list"|i18n("design/standard/setup")}</h1>

<h2>{"Most common templates"|i18n("design/standard/setup")}</h2>

<table class="list" width="100%" cellpadding="2" cellspacing="0" border="0">
<tr>
   <th>
   {"Template"|i18n("design/standard/setup")}
   </th>
   <th>
   {"Design Resource"|i18n("design/standard/setup")}
   </th>
</tr>
{section name=Template loop=$most_used_template_array sequence=array(bglight,bgdark)}
<tr class="{$:sequence}">
   <td> 
   <a href={concat('/setup/templateview',$Template:item.template)|ezurl}>{$Template:item.template}</a>
   </td>
   <td>
   {$Template:item.base_dir}
   </td>
</tr>
{/section}
</table>

<h2>{"Complete template list"|i18n("design/standard/setup")}</h2>

<table class="list" width="100%" cellpadding="2" cellspacing="0" border="0">
<tr>
   <th>
   {"Template"|i18n("design/standard/setup")}
   </th>
   <th>
   {"Design Resource"|i18n("design/standard/setup")}
   </th>
</tr>
{section max=20 offset=$view_parameters.offset name=Template loop=$template_array sequence=array(bglight,bgdark)}
<tr class="{$:sequence}">
   <td> 
   <a href={concat('/setup/templateview',$Template:item.template)|ezurl}>{$Template:item.template}</a>
   </td>
   <td>
   {$Template:item.base_dir}
   </td>
</tr>
{/section}
</table>

{include name=navigator
         uri='design:navigator/google.tpl'
         page_uri='/setup/templatelist'
         item_count=$template_count
         view_parameters=$view_parameters
         item_limit=20}
 