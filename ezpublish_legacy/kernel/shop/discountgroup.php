<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$module = $Params['Module'];

$http = eZHTTPTool::instance();

$discountGroupArray = eZDiscountRule::fetchList();

if ( $http->hasPostVariable( "AddDiscountGroupButton" ) )
{
    $params = array();
    $Module->redirectTo( $Module->functionURI( "discountgroupedit" ) );
    return;
}

if ( $http->hasPostVariable( "EditGroupButton" ) && $http->hasPostVariable( "EditGroupID" ) )
{
    $Module->redirectTo( $Module->functionURI( "discountgroupedit" ) . "/" . $http->postVariable( "EditGroupID" ) );
    return;
}

if ( $http->hasPostVariable( "RemoveDiscountGroupButton" ) )
{
    $discountRuleIDList = $http->postVariable( "discountGroupIDList" );

    $db = eZDB::instance();
    $db->begin();
    foreach ( $discountRuleIDList  as $discountRuleID )
    {
        eZDiscountRule::removeByID( $discountRuleID );
    }
    $db->commit();

    // we changed prices of products (no discount now) => remove content caches
    eZContentCacheManager::clearAllContentCache();

    $module->redirectTo( $module->functionURI( "discountgroup" ) . "/" );
    return;
}
$module->setTitle( "View discount group" );
$tpl = eZTemplate::factory();
$tpl->setVariable( "discountgroup_array", $discountGroupArray );
$tpl->setVariable( "module", $module );

$Result = array();
$Result['content'] = $tpl->fetch( "design:shop/discountgroup.tpl" );
$Result['path'] = array( array( 'url' => '/shop/discountgroup/',
                                'text' => ezpI18n::tr( 'kernel/shop', 'Discount group' ) ) );
?>