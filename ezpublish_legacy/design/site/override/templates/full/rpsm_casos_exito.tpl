{def $user = fetch( 'user', 'current_user')}
{if $user.is_logged_in|not}

	<div id="gridTwoColumns" class="clearFix">
		<div class="columnType1">
			<div id="modAbonados">
				
					<h1>Recursos Portal Soluciones Memento</h1>
					<div class="wrap clearFix">
				
							<div class="description">
								<div class="wysiwyg">
									<h2>Le ayudamos a sacar el máximo partido a su Producto Electrónico, proporcionándole…</h2>
									<br>
									<ul>
										<li><strong>Formación.</strong><ul><li>Acceda a <b>videos demostrativos</b> para <b>dominar</b> su producto.</li><li>Participe en <b>sesiones formativas gratuitas.</b></li><li>Consulte <b>documentación con casos prácticos.</b></li></ul></li>
										<li><strong>Asistencia.</strong> <b>Solucione</b> todas sus dudas con nuestra <b>asistencia On line.</b></li>
										<li><strong>Experiencia.</strong><ul><li><b>Comparta su opinión</b> sobre nuestros productos.</li><li>Lea los <b>casos de éxito</b> de clientes que, como Usted, utilizan el Portal Soluciones Memento.</li></ul></li>
										<li><strong>Noticias.</strong> Reciba todas las <b>novedades relacionadas con su producto</b> a través de e-mail y RSS.</li>
									</ul>
								</div>
							</div>								                        											
					</div>
				
			</div>
		</div>
		<div class="sideBar">
			<div id="modAccesoAbonados">

				<h2>Acceso usuarios</h2>
				<div class="wrap clearFix">
					<form action={"colectivos/login"|ezurl} method="post">
						<ul>
							<li>
								<label for="usuario">Usuario</label>
								<input type="text" class="text" id="usuario" name="Login" />
							</li>

							<li>
								<label for="pass">Contraseña</label>
								<input type="password" class="text" id="pass" name="Password" />
								<span><a href={"basket/forgotpassword"|ezurl}>¿Olvidó su contraseña?</a></span>
							</li>
							<li>
								<span class="submit"><input type="image" src={"btn_entrar.gif"|ezimage} alt="entrar" name="LoginButton" /></span>
							</li>
						</ul>
						
						<input type="hidden" name="RedirectURI" value="RecursosPSM" />
						
					</form>
															
				</div>
			</div>
			<br>
			<div align="center">
				<a href={"formularios/pruebe-nuestros-productos-electronicos-15-dias-sin-compromiso"|ezurl} target="_blank"><img src={"banner_prueba_gratuita_rpsm.jpg"|ezimage} alt="" /></a>
			</div>
		</div>
	</div>

{else}

	<div id="bodyContent">
	
		<div id="gridWide" class="casosExito">
							
			<h1>Casos de éxito</h1>
		
			<div class="wrap">
			
				<div class="inner">
			
					<div class="wysiwyg">
						<div class="attribute-cuerpo clearFix">
							<p>
								Aquí se presentan una serie de Casos de Éxito de clientes de Ediciones Francis Lefebvre con los productos ofrecidos por el Portal Soluciones Memento: Nautis, Mementix, Formularios, Actum y Convenios Colectivos.
							</p>
						</div>
					</div>
					
				</div>
			
			</div>
		
		</div>
			
		<div id="casos">
			<div id="gridType2">
													
				<div class="wrap clearFix">
					<div class="columnType1">
						<div class="wrapColumn">
							<div class="inner">
							
								{def $listado-casos-exito=fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id ))}
								
								<ul class="wrapAjaxContent clearFix">
								
									{foreach $listado-casos-exito as $caso-exito}
										<li style="border-bottom:2px solid #c6e7ff; padding: 12px 0 18px 0;">
											<div class="description">
												<div class="wysiwyg">
													<img src={$caso-exito.data_map.logo.content.fichaproducto.url|ezroot}>
													<h2>{$caso-exito.data_map.titulo.content}</h2>
													<p>{$caso-exito.data_map.descripcion.content.output.output_text}</p>
												</div>
											</div>
										</li>										
									{/foreach}
								</ul>
								
								{undef $listado-casos-exito}
								
							</div>
					</div>
				</div>
			</div>
	
		</div>
	</div>
		
</div>

{/if}