{literal}<script type="text/javascript" src = "/design/site/javascript/yahoo-dom-event.js"></script>
<script type="text/javascript" src = "/design/site/javascript/ie-select-width-fix.js"></script>
<script type="text/javascript">
	new YAHOO.Hack.FixIESelectWidth( 'ContentObjectAttribute_ezselect_selected_array_10799[]' ); 
	new YAHOO.Hack.FixIESelectWidth( 'ContentObjectAttribute_ezselect_selected_array_12590[]' );
</script>{/literal}
{ezcss_require( 'jquery.fancybox-1.3.0.css')} 

{set-block scope=root variable=cache_ttl}0{/set-block}
{def $module_params = module_params()}


{foreach $validation.attributes as $key => $error }

	{switch match=$error.identifier}

	    {case match='about_info'} 
	    	{def $error_about_info = 1}
	    {/case}  	
	    {case match='nombre'} 
	    	{def $error_nombre = 1}
	    {/case}
	    {case match='apellido1'} 
	    	{def $error_apellidos = 1}
	    {/case}
	    {case match='email'} 
	    	{def $error_email = 1}
	    {/case}		
	    {case match='telefono'} 
	    	{def $error_telefono = 1}
	    {/case}
	    {case match='politica_privacidad'} 
	    	{def $error_politica = 1}
	    {/case}
	    {case match='captchar'} 
	    	{def $error_captchar = 1}
	    {/case}	
		

	{/switch}

	
{/foreach}



			<div id="gridTwoColumnsTypeB" class="clearFix">
            	
               
				<div class="columnType1">
					<div id="modType2">

						
							<h1>{fetch('content', 'node', hash( 'node_id', $node.node_id)).data_map.titulo.content}</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosUsuario">


						
						{if and( not($validation.attributes|count()|gt(0)), not(and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo'))))  }
						<p>{fetch('content', 'node', hash( 'node_id', $node.node_id)).data_map.descripcion.content.output.output_text}</p><br>
						{/if}
						

						
                                        	{if $validation.attributes|count()|gt(0)}
                                        		<div class="msgError">
                                        			<span>Lo sentimos, pero se han encontrado los siguientes errores</span> 
                                        			<ul>
                                        			{foreach $validation.attributes as $key => $error }
                                        				<li>{$error.name} : {$error.description}<br></li>
                                        			{/foreach}
                                        			</ul>
                                        		</div>
                                        	{else}	
	
							{if and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo')) }
								<div class="contacte" >
								El formulario se ha enviado correctamente.
								</div>

							{else}
							{/if}
						{/if}


{if not(and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo'))) }
                                           
<form method="post" action={"utils/action"|ezurl} id="form_inf_colectivo">
                                            <span class="camposObligatorios">* Datos obligatorios</span>

                                               


                                            	<h2>Datos de usuario</h2>                                                
                                                <ul class="datos">

						    <li {if is_set( $error_about_info)}class="error"{/if}>
                                                    	<label for="about">Deseo recibir información sobre *</label>
                            <span class="select-box" style="padding:0;margin:0;">                           
								{attribute_view_gui attribute=$node.data_map.about_info}
							</span>
                                                    </li>

                                                    <li {if is_set( $error_nombre)}class="error"{/if}>
                                                    	<label for="nombre">Nombre *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.nombre}
							
                                                    </li>
                                                    <li {if is_set( $error_apellidos)}class="error"{/if}>
                                                    	<label for="apellidos">Apellido 1 *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.apellido1}
                                                    </li>
                                                    
                                                    <li >
                                                    	<label for="apellidos">Apellido 2</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.apellido2}
                                                    </li>
	     					   
                                                    
                                                    <li {if is_set( $error_email)}class="error"{/if}>
                                                    	<label for="email">Email *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.email}
                                                    </li>
                                                    

                                                    <li {if is_set( $error_telefono)}class="error"{/if}>
                                                    	<label for="telefono">Teléfono *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.telefono}
                                                    </li>                                                  

						  	
                                                     
                                                    
                                                </ul>
                                                
                                                <ul class="datos">
                                                	
                                                    <li class="condiciones">
                                                    	<label for="condiciones" {if is_set( $error_politica)}class="error"{/if}>{attribute_view_gui attribute=$node.data_map.politica_privacidad} He leído y acepto las condiciones de la <a class="lb" id="politicaligthBox" href={'lightbox/ver/19526'|ezurl}>Política de Privacidad</a> y el <a class="lb" id="avisoLightbox" href={'lightbox/ver/292'|ezurl}>Aviso Legal</a></label>
{*
                                                    	<div>                                                    		
                                                    		{fetch('content', 'node', hash( 'node_id', 1451)).data_map.texto.content.output.output_text}
                                                    	</div>
                                                        *}

                                                    </li>

							 <li>
                                                        {attribute_view_gui attribute=$node.data_map.captcha}
                                                    </li>
                                                                                                    
                                                </ul>

						

                                                
                                               
                                               <div class="clearFix">
	                                                <span class="volver"><a href={"Colectivos"|ezurl}>Volver</a></span>
   	                                                <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="ActionCollectInformation" value="Enviar" id="send"/></span>
                                                
                                                </div> 

						<div >
						   
						   <input type="hidden" name="ContentNodeID" value="{$node.node_id}" />
						   <input type="hidden" name="ContentObjectID" value="{$node.object.id}" />
						   <input type="hidden" name="ViewMode" value="full" />
					       </div>

 
                                                    	                                                        
                                            </form>
					 {/if}

                                                									
										</div>
								
									</div>								                        											
							</div>
						
					</div>
				</div>
				<div class="sideBar">
                
                    
					<div id="modContacto">
						{include uri="design:basket/contactmoduleformacion.tpl"}
					</div>
                    
				</div>
                
			</div>

				
			
		
			
		
		


