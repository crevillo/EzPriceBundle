<?php
/**
 * File containing the eZURLFunctionCollection class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZURLFunctionCollection ezurlfunctioncollection.php
  \brief The class eZURLFunctionCollection does

*/

class eZURLFunctionCollection
{
    /*!
     Constructor
    */
    function eZURLFunctionCollection()
    {
    }

    function fetchList( $isValid, $offset, $limit, $onlyPublished )
    {
        $parameters = array( 'is_valid' => $isValid,
                             'offset' => $offset,
                             'limit' => $limit,
                             'only_published' => $onlyPublished );
        $list = eZURL::fetchList( $parameters );
        if ( $list === null )
            $result = array( 'error' => array( 'error_type' => 'kernel',
                                               'error_code' => eZError::KERNEL_NOT_FOUND ) );
        else
            $result = array( 'result' => $list );
        return $result;
    }

    function fetchListCount( $isValid, $onlyPublished )
    {
        $parameters = array( 'is_valid' => $isValid,
                             'only_published' => $onlyPublished );
        $listCount = eZURL::fetchListCount( $parameters );
        if ( $listCount === null )
            $result = array( 'error' => array( 'error_type' => 'kernel',
                                               'error_code' => eZError::KERNEL_NOT_FOUND ) );
        else
            $result = array( 'result' => $listCount );
        return $result;
    }

}

?>