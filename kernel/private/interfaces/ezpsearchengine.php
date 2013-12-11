<?php
/**
 * File containing the ezpSearchEngine interface
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 * @subpackage search
 */

/**
 * This interface is used as the basis for the different search engine implementation
 * @package kernel
 * @subpackage search
 */
interface ezpSearchEngine
{
    /**
     * Whether a commit operation is required after adding/removing objects.
     *
     * @see commit()
     * @return bool
     */
    public function needCommit();

    /**
     * Whether calling removeObject() is required when updating an object.
     *
     * @see removeObject()
     * @return bool
     */
    public function needRemoveWithUpdate();

    /**
     * Adds object $contentObject to the search database.
     *
     * @param eZContentObject $contentObject Object to add to search engine
     * @param bool $commit Whether to commit after adding the object
     * @return bool True if the operation succeed.
     */
    public function addObject( $contentObject, $commit = true );

    /**
     * Removes object $contentObject from the search database.
     *
     * @param eZContentObject $contentObject the content object to remove
     * @param bool $commit Whether to commit after removing the object
     * @return bool True if the operation succeed.
     */
    public function removeObject( $contentObject, $commit = true );

    /**
     * Searches $searchText in the search database.
     *
     * @see supportedSearchTypes()
     * @param string $searchText Search term
     * @param array $params Search parameters
     * @param array $searchTypes Search types
     */
    public function search( $searchText, $params = array(), $searchTypes = array() );

    /**
     * Returns an array describing the supported search types by the search engine.
     *
     * @see search()
     * @return array
     */
    public function supportedSearchTypes();

    /**
     * Commit the changes made to the search engine.
     *
     * @see needCommit()
     */
    public function commit();
}
?>
