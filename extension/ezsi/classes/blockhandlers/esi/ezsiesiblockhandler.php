<?php
//
// Definition of siblocksupdate cronjob
//
// Created on: <28-Apr-2008 10:06:19 jr>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ publish
// SOFTWARE RELEASE: 4.7.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2012 eZ Systems AS
// SOFTWARE LICENSE: eZ Business Use License Agreement eZ BUL Version 2.1
// NOTICE: >
//   This source file is part of the eZ Publish CMS and is
//   licensed under the terms and conditions of the eZ Business Use
//   License v2.1 (eZ BUL).
// 
//   A copy of the eZ BUL was included with the software. If the
//   license is missing, request a copy of the license via email
//   at license@ez.no or via postal mail at
//  	Attn: Licensing Dept. eZ Systems AS, Klostergata 30, N-3732 Skien, Norway
// 
//   IMPORTANT: THE SOFTWARE IS LICENSED, NOT SOLD. ADDITIONALLY, THE
//   SOFTWARE IS LICENSED "AS IS," WITHOUT ANY WARRANTIES WHATSOEVER.
//   READ THE eZ BUL BEFORE USING, INSTALLING OR MODIFYING THE SOFTWARE.

// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

class eZSIESIBlockHandler extends eZSIBlockHandler
{
    public function generateMarkup()
    {
        $ttlInfos = $this->parseTTL();

        $markup = '<esi:include src="' . $this->Src . '" ttl="' . $ttlInfos['ttl_value'] . $ttlInfos['ttl_unit'] . '" onerror="continue"/>';
        eZDebug::writeNotice( $markup, __METHOD__ );
        return $markup;
    }
}
?>
