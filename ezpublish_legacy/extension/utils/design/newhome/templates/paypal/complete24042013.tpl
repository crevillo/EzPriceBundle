    {def $products = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $training = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $order_info = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}
{if sum( $products_ua|count, $training_ua|count )|gt(0)}
<script type="text/javascript">
{literal}
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2627590-1']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_addTrans',
    '{/literal}{$id_pedido_lfbv}{literal}',           // order ID - required
    'Ediciones Francis Lefebvre',  // affiliation or store name
    '{/literal}{$basket.price_ex_vat|explode(',')|implode('.')}{literal}',          // total - required
    '{/literal}{$basket.price_inc_vat|dec( $basket.price_ex_vat )|explode(',')|implode('.')}{literal}',           // tax
    '0',              // shipping
    'Madrid',       // city
    'Madrid',     // state or province
    'Spain'             // country
  ]);
{/literal}
    {foreach $products as $product}

{literal}
   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
  _gaq.push(['_addItem',
    '{/literal}{$id_pedido_lfbv}{literal}',           // order ID - required
    '{/literal}{$product.contentobject.data_map.referencia.content}{literal}',           // SKU/code - required
    '{$product.name}',        // product name
    '',   // category or variation
    '{/literal}{$product.price_ex_vat|explode(',')|implode('.')}{literal}',          // unit price - required
    '{/literal}{$product.item_count}{literal}'               // quantity - required
  ]);
{/literal}
{/foreach}
{literal}
  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
{/literal}
</script>                         

<!-- Google Code for Venta Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "es";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "cKHcCIPSiAIQva3B9gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1053841085/?label=cKHcCIPSiAIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>         

<!-- Google Code for Home Page Remarketing List -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "666666";
var google_conversion_label = "_xsRCIvRiAIQva3B9gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1053841085/?label=_xsRCIvRiAIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
{/if}
{if $encuesta}

        

<div id="gridTwoColumnsTypeB" class="clearFix">
  <div class="columnType1">
                    <div id="modType2">

                            
                            <h1>{$node.name|wash()}</h1>
                            
                            <div class="wrap clearFix curvaFondo">                          
                                    <div id="finProceso" class="description">
                                                    
                                              <div class="encuesta">  
                                        {def $name_pattern = $node.object.content_class.contentobject_name|explode('>')|implode(',')
         $name_pattern_array = array('enable_comments', 'enable_tipafriend', 'show_children', 'show_children_exclude', 'show_children_pr_page')
         $exclude_datatypes = array('ezoption', 'ezmultioption', 'ezmultioption2', 'ezrangeoption', 'ezprice', 'ezmultiprice')}
    {set $name_pattern  = $name_pattern|explode('|')|implode(',')}
    {set $name_pattern  = $name_pattern|explode('<')|implode(',')}
    {set $name_pattern  = $name_pattern|explode(',')}
    {foreach $name_pattern  as $name_pattern_string}
        {set $name_pattern_array = $name_pattern_array|append( $name_pattern_string|trim() )}
    {/foreach}

                {*attribute_view_gui attribute=$node.data_map.survey*}
                {def $attribute = $node.data_map.survey}
                {def $survey_validation=$attribute.content.survey_validation}
                {def $survey=$node.data_map.survey.content.survey}
{if is_set($attribute.content.survey_validation.one_answer_need_login)}
<p>{"You need to log in in order to answer this survey"|i18n('survey')}.</p>
{include uri='design:user/login.tpl'}
{else}
{if $survey.valid|eq(false())}
<p>{"The survey is not active"|i18n('survey')}.</p>
{else}
{def $survey_validation=$attribute.content.survey_validation}
{if or(is_set( $survey_validation.one_answer ), and(is_set($survey_validation.one_answer_count), $survey_validation.one_answer_count|gt(0)))}
<p>{"The survey does already have an answer from you"|i18n('survey')}.</p>
{else}
{def $prefixAttribute='ContentObjectAttribute'}
{def $node=fetch( 'content', 'node', hash( 'node_id', $node.node_id ))}
{def $module_param_value=concat(module_params().module_name,'/', module_params().function_name)}
{if $module_param_value|ne('content/edit')}
<form enctype="multipart/form-data" method="post" action={concat("paypal/complete/", $order_id )|ezurl()}>
{/if}
<input type="hidden" name="pid" value="{$basket.productcollection_id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_contentobjectattribute_id_{$attribute.id}" value="{$attribute.id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_node_id_{$attribute.id}" value="{$node.node_id}" />

<input type="hidden" name="{$prefixAttribute}_ezsurvey_id_{$attribute.id}" value="{$survey.id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_id_view_mode_{$attribute.id}" value="{$survey.id}" />



{section show=$preview|not}
{include uri="design:survey/view_validation.tpl"}
{/section}

{let question_results=$survey.question_results}
{section show=$question_results}
  {section var=question loop=$survey.questions}
    {section show=$question.visible}
      <div class="block">
      <input type="hidden" name="{$prefix}_ezsurvey_question_list_{$attribute.id}[]" value="{$question.id}" />
      <a name="survey_question_{$question.question_number}"></a>
      {if is_set($question_results[$question.id])}
        {survey_question_view_gui question=$question question_result=$question_results[$question.id] attribute_id=$attribute.id prefix_attribute=$prefixAttribute survey_validation=$survey_validation}
      {else}
        {survey_question_view_gui question=$question question_result=0 attribute_id=$attribute.id prefix_attribute=$prefixAttribute}
      {/if}
      <div class="break"></div>
      </div>
    {/section}
  {/section}
{section-else}
  {section var=question loop=$survey.questions}
    {section show=$question.visible}
      <div class="block">
      <input type="hidden" name="{$prefixAttribute}_ezsurvey_question_list_{$attribute.id}[]" value="{$question.id}" />
      <a name="survey_question_{$question.question_number}"></a>
      {survey_question_view_gui question=$question question_result=0 attribute_id=$attribute.id prefix_attribute=$prefixAttribute}
      <div class="break"></div>
      </div>
    {/section}
  {/section}
{/section}
{/let}

<div class="block">

<input type="hidden" name="send" value="1" />
<input type="image" name="{$prefixAttribute}_ezsurvey_store_button_{$attribute.id}" value="{'Submit'|i18n( 'survey' )}" src={"btn_continuar.gif"|ezimage} />
</div>

{if $module_param_value|ne('content/edit')}
</form>
{/if}
{/if}
{/if}
{/if}
                                        
                                        
                                        
                                        </div>
                                        
                                    </div>
                            </div>  
                                   
                            </div>             
                           
                    
                    
                </div>

                <div class="sideBar">
                    
                    <div id="modContacto">
                        {include uri="design:basket/contactmodule.tpl"}
                    </div>
                    
                </div>

                
            </div>
{else}        
            
        
            <div id="gridTwoColumnsTypeB" class="clearFix">
                
                <ol id="pasosCompra">
                    <li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
                    <li><img src={"txt_paso2.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
                    <li><img src={"txt_paso3.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
                    <li class="reset"><img src={"txt_paso4-sel.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
                </ol>
                
                <div class="columnType1">
                    <div id="modType2">

                            
                            <h1>Fin de proceso de compra</h1>
                            
                            <div class="wrap clearFix curvaFondo">                    		
									<div id="finProceso" class="description">
													
                                        		
										<ul>
											<li>Su pedido ha sido procesado. Su número de pedido lo recibirá por email una vez que su compra se haya tramitado con éxito. </li>
											<li>Si todo ha ido bien, en breves instantes <strong>recibirá un email</strong> con la información de dicho proceso. Si esto no ocurre en los próximos minutos póngase en contacto con nosotros.</li>

										</ul>
										
                                        
										
										
									</div>								                        											
							</div>	
                                   
                            </div>             
                            <div id="modType3">
						        <h2 class="title">Déjenos conocerle</h2>
                                <div class="wrap clearFix curvaFondo">                    		
							        <div class="description">
                            	        <div class="cont" style="padding:20px;">
                                            <form action={concat( "paypal/complete/", $id)|ezurl} method="post" id="finCompraForm" class="formulario conocer" name="finCompraForm">
                                                
                                               {include uri="design:basket/dejenosconocerle.tpl"}
                                               
                                               <div class="clearFix">
	                                                <!--span class="volver"><a href="">Volver</a></span-->
   	                                             <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="btnContinuar" /></span>

                                                
                                                </div>  
                                                    	                                                        
                                            </form>

                                         </div>

							</div>								                        											
						</div>
																				
					</div>
					
					
				</div>

                <div class="sideBar">
                    
                    <div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
                    
                </div>

                
            </div>
                
            
        
            
        
        </div>
{/if}