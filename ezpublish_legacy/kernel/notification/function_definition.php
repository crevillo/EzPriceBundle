<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$FunctionList = array();
$FunctionList['handler_list'] = array( 'name' => 'handler_list',
                                       'operation_types' => array( 'read' ),
                                       'call_method' => array( 'class' => 'eZNotificationFunctionCollection',
                                                               'method' => 'handlerList' ),
                                       'parameter_type' => 'standard',
                                       'parameters' => array( ) );

$FunctionList['digest_handlers'] = array( 'name' => 'digest_handlers',
                                          'operation_types' => array( 'read' ),
                                          'call_method' => array( 'class' => 'eZNotificationFunctionCollection',
                                                                  'method' => 'digestHandlerList' ),
                                          'parameter_type' => 'standard',
                                          'parameters' => array( array( 'name' => 'date',
                                                                        'type' => 'integer',
                                                                        'required' => true ),
                                                                 array( 'name' => 'address',
                                                                        'type' => 'string',
                                                                        'required' => true ) ) );


$FunctionList['digest_items'] = array( 'name' => 'digest_items',
                                       'operation_types' => array( 'read' ),
                                       'call_method' => array( 'class' => 'eZNotificationFunctionCollection',
                                                               'method' => 'digestItems' ),
                                       'parameter_type' => 'standard',
                                       'parameters' => array( array( 'name' => 'date',
                                                                     'type' => 'integer',
                                                                     'required' => true ),
                                                              array( 'name' => 'address',
                                                                     'type' => 'string',
                                                                     'required' => true ),
                                                              array( 'name' => 'handler',
                                                                     'type' => 'string',
                                                                     'required' => true ) ) );


$FunctionList['event_content'] = array( 'name' => 'event_content',
                                       'operation_types' => array( 'read' ),
                                       'call_method' => array( 'class' => 'eZNotificationFunctionCollection',
                                                               'method' => 'eventContent' ),
                                       'parameter_type' => 'standard',
                                       'parameters' => array( array( 'name' => 'event_id',
                                                                     'type' => 'integer',
                                                                     'required' => true ) ) );

$FunctionList['subscribed_nodes'] = array( 'name' => 'subscribed_nodes',
                                           'operation_types' => array( 'read' ),
                                           'call_method' => array( 'class' => 'eZNotificationFunctionCollection',
                                                                   'method' => 'subscribedNodes' ),
                                           'parameter_type' => 'standard',
                                           'parameters' => array( array( 'name' => 'offset',
                                                                         'type' => 'integer',
                                                                         'default' => false,
                                                                         'required' => false ),
                                                                  array( 'name' => 'limit',
                                                                         'type' => 'integer',
                                                                         'default' => false,
                                                                         'required' => false ) ) );

$FunctionList['subscribed_nodes_count'] = array( 'name' => 'subscribed_nodes_count',
                                                 'operation_types' => array( 'read' ),
                                                 'call_method' => array( 'class' => 'eZNotificationFunctionCollection',
                                                                         'method' => 'subscribedNodesCount' ),
                                                 'parameter_type' => 'standard',
                                                 'parameters' => array() );

?>