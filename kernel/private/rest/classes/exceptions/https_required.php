<?php
/**
 * File containing the ezpRestHTTPSRequiredException exception
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

class ezpRestHTTPSRequiredException extends ezpRestException
{
    public function __construct()
    {
        parent::__construct( "Communication over HTTPS is required." );
    }
}