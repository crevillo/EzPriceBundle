<?php
/**
 * File containing the ezpContentFieldCriteria class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package API
 */

/**
 * This class is used to instantiate and manipulate a field value content criteria.
 *
 * @package API
 */
class ezpContentFieldCriteria implements ezpContentCriteriaInterface
{
    public function __construct( $fieldIdentifier )
    {

    }

    /**
     * Adds a 'like' parameter to the criteria.
     *
     * @param string $string
     *
     * @return ezpContentFieldCriteria
     */
    public function like( $string )
    {

    }

    /**
     * Filter content on the value a string starts with
     *
     * @param string $string String the content has to start with
     *
     * @return ezpContentFieldCriteria
     */
    public function startsWith( $string )
    {

    }

    /**
     * Filter content on the value a string ends with
     *
     * @param string $string String the content has to end with
     *
     * @return ezpContentFieldCriteria
     */
    public function endsWith( $string )
    {

    }

    public function translate() {}

    public function __toString() {}
}
?>