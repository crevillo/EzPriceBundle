<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = $Params['Module'];
$http = eZHTTPTool::instance();
$orderIDArray = $http->sessionVariable( "OrderIDArray" );

$db = eZDB::instance();
$db->begin();
foreach ( $orderIDArray as $archiveID )
{
    eZOrder::unarchiveOrder( $archiveID );
}
$db->commit();
$Module->redirectTo( '/shop/archivelist/' );
?>
