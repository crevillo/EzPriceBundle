<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  This script is just a wrapper for action.php with action set to 'MoveNodeRequest'
  and has been created for moving operation to be simply invoked using URI like /content/move/NODE_ID.
*/


$Module = $Params['Module'];
$NodeID = $Params['NodeID'];

$Module->setCurrentAction( 'MoveNodeRequest', 'action' );
$Module->setActionParameter( 'NodeID', $NodeID, 'action' );
return $Module->run( 'action', array( $NodeID ) );

?>