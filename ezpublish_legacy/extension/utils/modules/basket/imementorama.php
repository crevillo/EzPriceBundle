<?php
require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();

$basket = eZBasket::currentBasket();

$content = array();
$removeitem = array();
$productos = array();

$ini = eZINI::instance('imemento.ini');
$mData = eZContentObject::fetch( $ini->variable( 'iMemento', 'Object' ) );
$mdatos = $mData->dataMap();
$relationPack = $mdatos["packs"]->content();

foreach ($relationPack["relation_browse"] as $relations)
{
	$idsRelations[] = $relations["contentobject_id"];
}

$tpl->setVariable( "idsRelations", $idsRelations );

if ($basket->SessionID !="")
{
	foreach ($basket->items() as $item)
	{
		$content[$item["item_object"]->ContentObject->ID] = $item["item_object"]->ContentObject->ID;
		$removeitem[$item["item_object"]->ContentObject->ID] = $item["id"];
			
		$pData = eZContentObject::fetch( $item["item_object"]->ContentObject->ID );
			
		if (in_array($pData->ID,$idsRelations))
		{
			$datos = $pData->dataMap();
			if ( $datos['precio'] !="") $precio = $datos['precio']->content()->attribute( 'ex_vat_price' );
			if ( $datos['precio_oferta'] !="") $total = $datos['precio_oferta']->content()->attribute( 'ex_vat_price' );
			if ( $datos['descuento_pack'] !="") $discountpercent = $datos['descuento_pack']->content();
			if ( $datos['nombre']->content() !="") $name = $datos['nombre']->content();
			$productos[] = array('precio' => $precio, 'total' => $total, 'discountpercent'=> $discountpercent, 'name' => $name);
		}
	}
}

$tpl->setVariable( "content", $content );
$tpl->setVariable( "removeitem", $removeitem );
$tpl->setVariable( "productos", $productos );


$Result['content'] = $tpl->fetch( 'design:basket/imementorama.tpl' );
$Result['path'] = array( 
    array( 
        'url' => '/',
        'text' => 'Inicio' 
    ),
    array( 
        'url_alias' => '/catalogo/',
        'text' => 'Catálogo' 
    ),
    array( 
        'url_alias' => '/catalogo/imemento/imemento',
        'text' => 'Imemento' 
    ),
    array( 
        'url' => false,
        'text' => 'Configuración por rama del derecho' 
    )
);
?>