<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$http = eZHTTPTool::instance();
$Module = $Params['Module'];
$collectionID = $Params['CollectionID'];

$collection = false;
$object = false;

if( is_numeric( $collectionID ) )
{
    $collection = eZInformationCollection::fetch( $collectionID );
}

if( !$collection )
{
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}

$object = eZContentObject::fetch( $collection->attribute( 'contentobject_id' ) );

if( !$object )
{
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}

$objectID   = $collection->attribute( 'contentobject_id' );
$objectName = $object->attribute( 'name' );

$tpl = eZTemplate::factory();
$tpl->setVariable( 'module', $Module );
$tpl->setVariable( 'collection', $collection );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:infocollector/view.tpl' );
$Result['path'] = array( array( 'url' => '/infocollector/overview',
                                'text' => ezpI18n::tr( 'kernel/infocollector', 'Collected information' ) ),
                         array( 'url' => '/infocollector/collectionlist/' . $objectID,
                                'text' => $objectName ),
                         array( 'url' => false,
                                'text' => $collectionID ) );

?>