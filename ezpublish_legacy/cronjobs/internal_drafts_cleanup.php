<?php
/**
 * File containing the internal_drafts_cleanup.php.php cronjob
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$cli->output( "Cleaning up internal drafts..." );

// Remove all temporary internal drafts
$ini = eZINI::instance( 'content.ini' );
$internalDraftsCleanUpLimit = $ini->hasVariable( 'VersionManagement', 'InternalDraftsCleanUpLimit' ) ?
                                 $ini->variable( 'VersionManagement', 'InternalDraftsCleanUpLimit' ) : 0;
$durationSetting = $ini->hasVariable( 'VersionManagement', 'InternalDraftsDuration' ) ?
                      $ini->variable( 'VersionManagement', 'InternalDraftsDuration' ) : array( 'hours' => 24 ); // by default, only remove drafts older than 1 day

$isDurationSet = false;
$duration = 0;
if ( is_array( $durationSetting ) )
{
    if ( isset( $durationSetting[ 'days' ] ) and is_numeric( $durationSetting[ 'days' ] ) )
    {
        $duration += $durationSetting[ 'days' ] * 60 * 60 * 24;
        $isDurationSet = true;
    }
    if ( isset( $durationSetting[ 'hours' ] ) and is_numeric( $durationSetting[ 'hours' ] ) )
    {
        $duration += $durationSetting[ 'hours' ] * 60 * 60;
        $isDurationSet = true;
    }
    if ( isset( $durationSetting[ 'minutes' ] ) and is_numeric( $durationSetting[ 'minutes' ] ) )
    {
        $duration += $durationSetting[ 'minutes' ] * 60;
        $isDurationSet = true;
    }
    if ( isset( $durationSetting[ 'seconds' ] ) and is_numeric( $durationSetting[ 'seconds' ] ) )
    {
        $duration += $durationSetting[ 'seconds' ];
        $isDurationSet = true;
    }
}

if ( $isDurationSet )
{
    $expiryTime = time() - $duration;
    $processedCount = eZContentObjectVersion::removeVersions( eZContentObjectVersion::STATUS_INTERNAL_DRAFT, $internalDraftsCleanUpLimit, $expiryTime );

    $cli->output( "Cleaned up " . $processedCount . " internal drafts" );
}
else
{
    $cli->output( "Lifetime is not set for internal drafts (see your ini-settings, content.ini, VersionManagement section)." );
}

?>