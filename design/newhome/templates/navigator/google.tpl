{default page_uri_suffix=false()
         left_max=5
         right_max=4}
{default name=ViewParameter
         page_uri_suffix=false()
         left_max=$left_max
         right_max=$right_max}

{let page_count=int( ceil( div( $item_count,$item_limit ) ) )
      current_page=min($:page_count,
                       int( ceil( div( first_set( $view_parameters.offset, 0 ),
                                       $item_limit ) ) ) )
      item_previous=sub( mul( $:current_page, $item_limit ),
                         $item_limit )
      item_next=sum( mul( $:current_page, $item_limit ),
                     $item_limit )

      left_length=min($ViewParameter:current_page,$:left_max)
      right_length=max(min(sub($ViewParameter:page_count,$ViewParameter:current_page,1),$:right_max),0)
      view_parameter_text=""
      offset_text=eq( ezini( 'ControlSettings', 'AllowUserVariables', 'template.ini' ), 'true' )|choose( '/offset/', '/(offset)/' )}
{* Create view parameter text with the exception of offset *}
{section loop=$view_parameters}
 {section-exclude match=eq($:key,offset)}
 {section-exclude match=$:item|not}
 {set view_parameter_text=concat($:view_parameter_text,'/(',$:key,')/',$:item)}
{/section}


{section show=$:page_count|gt(1)}

<div class="paginationResults">
<span>Página {$:current_page|inc} de {$:page_count}</span>
<ul>


     {switch match=$:item_previous|lt(0) }
       {case match=0}
           {def $previous_page_url = concat($page_uri,$:item_previous|gt(0)|choose('',concat($:offset_text,$:item_previous)),$:view_parameter_text,$page_uri_suffix)}
           {ezpagedata_set( 'previous_page', $previous_page_url|ezurl() )}
      <li class="prev"><a href={$previous_page_url|ezurl}>{"Previous"|i18n("design/standard/navigator")}</a></li>
       {/case}
       {case match=1}
       {/case}
     {/switch}

    


{section show=$:current_page|gt($:left_max)}
<li><a href={concat($page_uri,$:view_parameter_text,$page_uri_suffix)|ezurl}>1</a></li>
{section show=sub($:current_page,$:left_length)|gt(1)}
<li>...</li>
{/section}
{/section}

    {section loop=$:left_length}
        {let page_offset=sum(sub($ViewParameter:current_page,$ViewParameter:left_length),$:index)}
          <li><a href={concat($page_uri,$:page_offset|gt(0)|choose('',concat($:offset_text,mul($:page_offset,$item_limit))),$ViewParameter:view_parameter_text,$page_uri_suffix)|ezurl}>{$:page_offset|inc}</a></li>
        {/let}
    {/section}

        <li>{$:current_page|inc}</li>

    {section loop=$:right_length}
        {let page_offset=sum($ViewParameter:current_page,1,$:index)}
          <li><a href={concat($page_uri,$:page_offset|gt(0)|choose('',concat($:offset_text,mul($:page_offset,$item_limit))),$ViewParameter:view_parameter_text,$page_uri_suffix)|ezurl}>{$:page_offset|inc}</a></li>
        {/let}
    {/section}

{section show=$:page_count|gt(sum($:current_page,$:right_max,1))}
{section show=sum($:current_page,$:right_max,2)|lt($:page_count)}
<li>...</li>
{/section}
<li><a href={concat($page_uri,$:page_count|dec|gt(0)|choose('',concat($:offset_text,mul($:page_count|dec,$item_limit))),$:view_parameter_text,$page_uri_suffix)|ezurl}>{$:page_count}</a></li>
{/section}

	{switch match=$:item_next|lt($item_count)}
      {case match=1}
        {def $next_page_url = concat($page_uri,$:offset_text,$:item_next,$:view_parameter_text,$page_uri_suffix)}
        {ezpagedata_set( 'next_page', $next_page_url|ezurl() )}
        <li class="next"><a href={$next_page_url|ezurl}>{"Next"|i18n("design/standard/navigator")}</a></li>
      {/case}
      {case}
      {/case}
    {/switch}
</ul>
</div>

{/section}

 {/let}
{/default}
{/default}

