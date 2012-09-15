<?php
/**
 * File blacklist_item_list.php
 *
 * @copyright Copyright (C) 2007-2010 CJW Network - Coolscreen.de, JAC Systeme GmbH, Webmanufaktur. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPL v2
 * @version 1.0.0beta2 | $Id: blacklist_item_list.php 12409 2010-07-09 06:36:07Z felix $
 * @package cjw_newsletter
 * @subpackage modules
 * @filesource
 */

// Blacklist User by nl user id or by email
// update all nessesarry status fields to blacklisted

$module = $Params['Module'];
$templateFile = 'design:newsletter/blacklist_item_list.tpl';

include_once( 'kernel/common/template.php' );

$http = eZHTTPTool::instance();
$tpl = templateInit();

$http = eZHTTPTool::instance();
$db = eZDB::instance();

$viewParameters = array( 'offset' => 0,
                         'namefilter' => '' );

$userParameters = $Params['UserParameters'];
$viewParameters = array_merge( $viewParameters, $userParameters );

$limit = 10;
$limitArray = array( 10, 10, 25, 50 );
$limitArrayKey = eZPreferences::value( 'admin_blacklist_item_list_limit' );

// get user limit preference
if ( isset( $limitArray[ $limitArrayKey ] ) )
{
    $limit =  $limitArray[ $limitArrayKey ];
}

$blacklistItemList = CjwNewsletterBlacklistItem::fetchAllBlacklistItems( $limit, $viewParameters[ 'offset' ] );
$blacklistItemListCount = CjwNewsletterBlacklistItem::fetchAllBlacklistItemsCount( );

$tpl->setVariable( 'view_parameters', $viewParameters );

$tpl->setVariable( 'blacklist_item_list', $blacklistItemList );
$tpl->setVariable( 'blacklist_item_list_count', $blacklistItemListCount );

$tpl->setVariable( 'limit', $limit );


$Result = array();

$Result['content'] = $tpl->fetch( $templateFile );
$Result['path'] =  array( array( 'url'  => 'newsletter/index',
                                 'text' => ezi18n( 'cjw_newsletter/path', 'Newsletter' ) ),
                          array( 'url'  => false,
                                 'text' => ezi18n( 'cjw_newsletter/blacklist_item_list', 'Blacklists' ) ) );
?>