{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{$attribute.content.name|wash(xhtml)}

{section name=Option loop=$attribute.content.option_list}
{$Option:item.value|wash()} - {$Option:item.additional_price|l10n(currency)}

{/section}

