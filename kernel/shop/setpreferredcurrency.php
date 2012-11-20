<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$module = $Params['Module'];

$preferredCurrency = $Params['Currency'];

if ( $module->isCurrentAction( 'Set' ) )
{
    if ( $module->hasActionParameter( 'Currency' ) )
        $preferredCurrency = $module->actionParameter( 'Currency' );
}

if ( $preferredCurrency )
    eZShopFunctions::setPreferredCurrencyCode( $preferredCurrency );

eZRedirectManager::redirectTo( $module, false );

?>
