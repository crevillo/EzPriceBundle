<?php
/**
 * File containing the CjwNewsletterUtils class
 *
 * @copyright Copyright (C) 2007-2010 CJW Network - Coolscreen.de, JAC Systeme GmbH, Webmanufaktur. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPL v2
 * @version 1.0.0beta2 | $Id: cjwnewsletterutils.php 10958 2010-03-30 13:39:59Z felix $
 * @package cjw_newsletter
 * @filesource
 */
/**
 * class with some useful functions
 *
 * @version 1.0.0beta2
 * @package cjw_newsletter
 */
class CjwNewsletterUtils extends eZPersistentObject
{

    function __construct(){ }

    /**
     * generate a unique hash md5
     *
     * @param string $flexibleVar is used as a part of string for md5
     * @return string md5
     */
    static function generateUniqueMd5Hash( $flexibleVar = '' )
    {
        $stringForHash = $flexibleVar. '-'. microtime( true ). '-' . mt_rand(). '-' . mt_rand();
        return md5( $stringForHash );
    }
}

?>