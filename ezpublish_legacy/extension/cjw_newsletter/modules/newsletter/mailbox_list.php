<?php
/**
 * File mailbox_list.php
 *
 * List all stored mailboxes.
 *
 * @copyright Copyright (C) 2007-2010 CJW Network - Coolscreen.de, JAC Systeme GmbH, Webmanufaktur. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPL v2
 * @version 1.0.0beta2 | $Id: mailbox_list.php 12405 2010-07-08 16:02:08Z felix $
 * @package cjw_newsletter
 * @subpackage modules
 * @filesource
 */

$module = $Params['Module'];
$templateFile = "design:newsletter/mailbox_list.tpl";

include_once( 'kernel/common/template.php' );

$mailboxObject = new CjwNewsletterMailbox( true );

$listMailboxesCount = 0;

// return array with mailbox objects
// TODO result check (is array or object etc )
if ( is_object( $mailboxObject ) )
{
    $listMailboxes = $mailboxObject->fetchAllMailboxes();
    $listMailboxesCount = count( $listMailboxes );
}

$tpl = templateInit();

$viewParameters = array( 'offset' => 0,
                         'namefilter' => '',
                         'redirect_uri' => $module->currentRedirectionURI() );

// variablen mit () in der url in viewparameter übernehmen
// z.B.  ../list/(offset)/4  setzt die viewparametervariable $offset = 3
$userParameters = $Params['UserParameters'];
$viewParameters = array_merge( $viewParameters, $userParameters );

$tpl->setVariable( 'view_parameters', $viewParameters );

$tpl->setVariable( 'mailbox_list', $listMailboxes );
$tpl->setVariable( 'mailbox_list_count', $listMailboxesCount );

$Result = array();

$Result['content'] = $tpl->fetch( $templateFile );
$Result['path'] = array( array( 'url'  => 'newsletter/index',
                                'text' => ezpI18n::tr( 'cjw_newsletter', 'Newsletter' ) ),
                         array( 'url'  => false,
                                'text' => ezpI18n::tr( 'cjw_newsletter/mailbox_item_list', 'Mail accounts' ) ) );


?>