<?php
/**
 * File containing the rotation tool handler
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 1.4.0
 * @package kernel
 */
$prepare_action = new eZIEImagePreAction();

$http = eZHTTPTool::instance();

// @todo change hasvariable to haspostvariable
$angle = $http->hasVariable( 'angle' ) ? $http->variable( 'angle' ) : 0;
$color = $http->hasVariable( 'color' ) ? $http->variable( 'color' ) : 'FFFFFF';

// @todo change hasvariable to haspostvariable
if ( $http->hasVariable( 'clockwise' ) && $http->variable( 'clockwise' ) == 'yes' )
{
    $angle = 360 - intval( $angle );
}

$imageconverter = new eZIEezcImageConverter( eZIEImageToolRotation::filter( $angle, $color ) );

$imageconverter->perform(
    $prepare_action->getImagePath(),
    $prepare_action->getNewImagePath()
);

eZIEImageToolResize::doThumb(
    $prepare_action->getNewImagePath(),
    $prepare_action->getNewThumbnailPath()
);

echo (string)$prepare_action;
eZExecution::cleanExit();
?>
