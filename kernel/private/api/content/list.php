<?php
/**
 * File containing the ezpContentList class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package API
 */

/**
 * This class lets you browse a previously fetched content list, for instance using ezpContentRepository::query()
 * It is more or less a ResultSet from a database perspective.
 *
 * @package API
 */
class ezpContentList implements Countable, Iterator
{
    public function __construct()
    {
    }

    /**
     * Countable::count
     * @return int
     */
    public function count()
    {
    }

    /**
     * Iterator::key()
     */
    public function key()
    {
    }

    /**
     * Iterator::key()
     */
    public function current ()
    {
    }

    /**
     * Iterator::key()
     */
    public function next()
    {
    }

    /**
     * Iterator::key()
     */
    public function rewind()
    {
    }

    /**
     * Iterator::key()
     */
    public function valid()
    {
    }
}
?>