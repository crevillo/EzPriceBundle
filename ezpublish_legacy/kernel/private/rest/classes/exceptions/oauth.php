<?php
/**
 * File containing the ezpOauthException class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * This is the base exception for the eZ Publish oauth library.
 *
 * @package oauth
 */
abstract class ezpOauthException extends ezcBaseException
{
    public $errorType = null;
    public function __construct( $message )
    {
        parent::__construct( $message );
    }
}
?>