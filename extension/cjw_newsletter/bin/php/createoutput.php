#!/usr/bin/env php
<?php

/**
 * File createoutput.php
 *
 * -script to create an newsletter edtion output for a siteaccess<br>
 * -to use the correct locale and SiteUrl<br>
 * -php extension/cjw_newsletter/bin/php/createoutput.php --object_id=102 --object_version=5 --output_format_id=0 --current_hostname=admin.jac-example.de.jac400.fw.lokal --www_dir=tmp/ --skin_name=default -s jac-example_user<br>
 * - --current_hostname :  only important for preview ( in testsystem )
 *
 * @copyright Copyright (C) 2007-2010 CJW Network - Coolscreen.de, JAC Systeme GmbH, Webmanufaktur. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPL v2
 * @version 1.0.0beta2 | $Id: createoutput.php 12712 2010-08-05 07:14:05Z felix $
 * @package cjw_newsletter
 * @author Felix Woldt 2008
 * @subpackage phpscript
 * @filesource
 */

require 'autoload.php';

include_once( 'kernel/common/template.php' );

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "CjW Newsletter CreateOutput\n\n" .

                                                        "\n" .
                                                        "createoutput.php -s siteaccess --outputFormat=0" ),
                                     'use-session' => true,
                                     'use-modules' => true,
                                     'use-extensions' => true ) );

$script->startup();

$options = $script->getOptions( "[output_format_id:][object_id:][object_version:][current_hostname:][www_dir:][skin_name:]",
                                "",
                                array( 'output_format_id' => '--',
                                       'object_id' => '--',
                                       'object_version' => '--',
                                       'current_hostname' => '--',
                                       'www_dir' => '--',
                                       'skin_name' => '--',
                                       ),
                                false,
                                array( 'siteaccess' => true,
                                       'user' => true )  );



$script->initialize();

// login as admin
// that template proecessing inlcude all images
$user = eZUser::fetchByName( 'admin' );

if ( $user and $user->isEnabled( ) )
{
    $userID = $user->attribute( 'contentobject_id' );
    eZUser::setCurrentlyLoggedInUser( $user, $userID );
}


$outputFormatId = 0;
$objectId = 0;
$objectVersion = 0;
$currentHostName = '#current_hostname not set#';
$wwwDir = '';

$skinName = 'default';


if ( $options['output_format_id'] )
{
    $outputFormatId = (int) $options['output_format_id'];
}
if ( $options['object_id'] )
{
    $objectId = (int) $options['object_id'];
}
if ( $options['object_version'] )
{
    $objectVersion = (int) $options['object_version'];
}
if ( $options['current_hostname'] )
{
    $currentHostName = $options['current_hostname'];
}
if ( $options['www_dir'] )
{
    $wwwDir = $options['www_dir'];
}
if ( $options['skin_name'] )
{
    $skinName = $options['skin_name'];
}

//$iniName = $options['arguments'][0];
$ini = eZINI::instance( 'site.ini' );
$siteUrl = $ini->variable( 'SiteSettings', 'SiteURL' );
$locale = $ini->variable( 'RegionalSettings', 'Locale' );

$outputContent = '';

// fetch objectversion
$contentObject = eZContentObjectVersion::fetchVersion( $objectVersion ,$objectId );

$tpl = templateInit();
$tpl->setVariable('contentobject', $contentObject );


if( !is_object( $contentObject ) )
{
    $script->shutdown();
}

$contentType = 'text/html';
$newsletterEditionContent = array( 'html' => '' , 'text' => '' );

$htmlMailImageInclude = 0;

switch( $outputFormatId )
{
    default:
    // html 0
    case CjwNewsletterSubscription::OUTPUT_FORMAT_HTML :
    {
        // textpart
        $template = 'design:newsletter/skin/'.$skinName.'/outputformat/text.tpl';
        $content = $tpl->fetch( $template );
        // TODO text version erstellen
        $content = formatText( $content );
        $newsletterEditionContent['text'] = $content;
        // htmlpart
        $template = 'design:newsletter/skin/'.$skinName.'/outputformat/html.tpl';
        $newsletterEditionContent['html'] = $tpl->fetch( $template );
        $contentType = 'multipart/alternative';

        if ( CjwNewsletterEdition::imageIncludeIsEnabled() )
            $htmlMailImageInclude = 1;

    } break;

    // text 1
    case CjwNewsletterSubscription::OUTPUT_FORMAT_TEXT :
    {
        $template = 'design:newsletter/skin/'.$skinName.'/outputformat/text.tpl';
        $content = $tpl->fetch( $template );
        // TODO text version erstellen

        $content = formatText( $content );

        $newsletterEditionContent['text'] = $content;
        $contentType = 'text/plain';

    } break;
    // text - html
    /*case 2:
    {
       $template = 'design:newsletter/skin/'.$skinName.'/outputformat/html_text.tpl';
       $newsletterEditionContent = $tpl->fetch( $template );
       $contentType = 'text/html';
    } break;*/

}

// ########## set image urls to absolut path and use CurrentHostname (testdomain)

$outputContent['html'] = '';
$outputContent['text'] = '';

$urlArray = getUrlArray( $siteUrl, $currentHostName, $wwwDir );

foreach( $newsletterEditionContent as $index => $outputString )
{
    $outputContent[ $index ] = generateAbsoluteLinks( $outputString, $urlArray );
}

$subject = "newsletter subject $objectId";
if ( $tpl->hasVariable( 'subject' ) )
{
    $subject = $tpl->variable( 'subject' );
}

$outputArray = array( 'contentobject_id' => $objectId,
                      'contentobject_version' => $objectVersion,
                      'output_format' => $outputFormatId,
                      'content_type' => $contentType,
                      'subject' => $subject,
                      'body' => $outputContent,
                      'template' => $template,
                      'template_validation' => $tpl->validateTemplateFile( $template, false ),
                      'template_errors' => $tpl->errorLog(),
                      'site_url' => $siteUrl,
                      'locale' => $locale,
                      'html_mail_image_include' => $htmlMailImageInclude
                       );

$outputArray = array_merge( $outputArray, $urlArray );

//serialize( $ini );
$cli->output( serialize( $outputArray ) );
$script->shutdown();

/**
 * $hostname = www.test.de
 *
 * @param string $string
 * @param array $urlArray
 * @return unknown_type
 */
function generateAbsoluteLinks( $string , $urlArray )
{

    /*
     $hostUrlEZ = 'http://' .$hostNameAndUri;
     $hostUrlRoot = 'http://' .$hostName;
    */

    $hostUrlEZ   = $urlArray[ 'ez_url' ];
    $hostUrlRoot = $urlArray[ 'ez_root' ];

    $htmlPage = $string;
    $htmlPage = preg_replace("/url:/",              $hostUrlEZ,                         $htmlPage );
    $htmlPage = preg_replace("/src=\"\/design/",    'src="'.$hostUrlRoot.'/design',     $htmlPage );
    $htmlPage = preg_replace("/src=\"\/extension/", 'src="'.$hostUrlRoot.'/extension',  $htmlPage );
    $htmlPage = preg_replace("/src=\"\/var/",       'src="'.$hostUrlRoot.'/var',        $htmlPage );
    $htmlPage = preg_replace("/href=\"\//",         'href="'.$hostUrlEZ.'/',            $htmlPage );
    $htmlPage = preg_replace("/Link: \"\//",        'Link: "'.$hostUrlEZ.'/',           $htmlPage ); // proper Links in text version Change here from 285
    $htmlPage = preg_replace("/url\(\"\//",         'url("'.$hostUrlRoot.'/',           $htmlPage );
    $htmlPage = preg_replace("/url\( \"\//",        'url( "'.$hostUrlRoot.'/',          $htmlPage );
    $htmlPage = preg_replace("/url\('\//",          "url('".$hostUrlRoot.'/',           $htmlPage );
    $htmlPage = preg_replace("/url\( '\//",         "url( '".$hostUrlRoot.'/',          $htmlPage );

    return $htmlPage;// . '<!--'. print_r( $urlArray, true ).' -->';
}

function getUrlArray( $siteUrl, $currentHostName, $wwwDir )
{
    //1. case 1 host matching      www.example.com

    //2. case 2 host_uri matching  www.example.com/de

    //3. uri matching ip pased in subfolder   http://127.0.0.1/ezpublish/430/index.php/de

    $siteUrlWithoutHttp = $siteUrl;

    $UrlStartWith = 'http://';

    if ( strpos( $siteUrl, 'http://' ) === 0 )
    {
        $siteUrlWithoutHttp = substr( $siteUrl, 7, strlen( $siteUrl ) );
    }

    if ( strpos( $siteUrl, 'https://' ) === 0 )
    {
        $siteUrlWithoutHttp = substr( $siteUrl, 8, strlen( $siteUrl ) );
        $UrlStartWith = 'https://';
    }

    $siteUrlExplode = explode( '/', $siteUrlWithoutHttp );
    $siteDomainName = $siteUrlExplode[0];
    $hostName = $siteDomainName;

    $currentHostNameExplode = array_reverse( explode( '.', $currentHostName ) );
    $hostNameExplode = array_reverse( explode( '.', $siteDomainName ) );

    $hostNameAndUri = $siteUrlWithoutHttp;

    // testdomian   admin. [example.de] .jac430.fw.lokal - www. [example.de]
    if ( $currentHostNameExplode[4] == $hostNameExplode[1] && count( $hostNameExplode ) > 1 )
    {
        $explodeHostName = explode( '/', $currentHostName );
        $domainName = $explodeHostName[0];

        $testHostName = $siteDomainName.'.'.  $currentHostNameExplode[2] .'.'. $currentHostNameExplode[1] .'.'. $currentHostNameExplode[0];
        //$hostNameAndUri = $hostName . $siteUri;
        $hostNameAndUri = str_replace( $hostName, $testHostName, $hostNameAndUri );
        $hostName = $testHostName;
    }

    $urlRoot = $hostName;
    if( $wwwDir != '' )
    {
        $urlRoot = $urlRoot .'/'. $wwwDir;
    }

    $ezUrl = $UrlStartWith . $hostNameAndUri;
    $ezRoot = $UrlStartWith . $urlRoot;

    return array( 'www_dir' => $wwwDir,
                  'site_url' => $siteUrl,
                  'current_host_name' => $currentHostName,
                  'ez_url'   => $ezUrl,
                  'ez_root'  => $ezRoot,
    //              'ez_file' => $localFileUrl
     );
}

// TODO html to text parser define in tools class

/**
 *
 * @param unknown_type $content
 * @return unknown_type
 */
function formatText( $content )
{
    $content = html_entity_decode( $content, ENT_COMPAT, 'UTF-8' );

    // end get proper links in text version
    $content = str_replace( "\r", "\n", $content );

    $serachArray = array( '&nbsp;', "</p><p>", "<p>" , '</p>', "\n\n\n\n<ol>", "</ol>\n\n\n\n", "\n\n\n\n<ul>", "</ul>\n\n\n\n", "\n\n<ol>", "</ol>\n\n", "\n\n<ul>", "</ul>\n\n", "<li>\n", '<li>', '</li>', "<hr>"     , "<br />\n", '<br />',   '<br>'    , '<h1>', '</h1>', '<h2>' , '</h2>', '<h3>'  , '</h3>' , '<h4>'   , '</h4>'  , '<h5>'    , '</h5>' );
    $replaceArray =  array( ' ', "[[[BR]]]\n", "\n"  , "\n"  , "[[[BR]]]"    , "[[[BR]]]"     , "[[[BR]]]"    , "[[[BR]]]"     , "[[[BR]]]" , "[[[BR]]]", "[[[BR]]]", "[[[BR]]]" , "<li>"  , '- '  , "\n"    , "[[[HR]]]", "[[[BR]]]", "[[[BR]]]" ,'[[[BR]]]', "\n= ", " =\n" , "\n== ", " ==\n", "\n=== ", " ===\n", "\n==== ", " ====\n", "\n===== ", " =====\n" );

    $content = str_replace( $serachArray , $replaceArray , $content );

    // get proper links in text version
    $content = stripAttributes( $content);
    $content = str_replace( "<a></a>", "", $content );
    $content = str_replace( "</a>", "", $content );
    $content = str_replace( "<a href=", "\nLink: ", $content ); // Warning: When you change this, you have to change line 265 (Change here from line 285), too.

    // preg_replace("/\n[^\w]*\n/","\n", $content);

     // turn returns to newlines:
    $content = str_replace("\r", "\n", $content);
    // turn tabs to spaces:
    $content = str_replace("\t", " ", $content);
    // next is searching for double spaces.
   /*  while (preg_match("/ /i", "$content"))
     {
     // replace them with single spaces:
     $content = str_replace(" ", " ", $content);
     }*/

    // looks for spaces after a newline:
    while ( preg_match( "/\n /", "$content" ) )
    {
        // remove that space:
        $content = str_replace( "\n ", "\n", $content );
    }


    // look for two newlines:
    while ( preg_match( "/\n\n/i", "$content" ) )
    { // turn it to one newline
         $content = str_replace( "\n\n", "\n", $content );
    }



     // the \n now separates paragraphs; change \n to <p>:
     /*$content = "<p>" . str_replace("\n", "</p><p>", $content) . "</p>";
     $content = str_replace("<p></p>", "", $content);*/
    // done!

    $serachArray = array( "\n= ",
                          "\n== ",
                          "\n=== ",
                          "\n==== ",
                          "\n===== ",
                          "\n[[[HR]]]",
                          "[[[BR]]]" );
    $replaceArray =  array( "\n\n= ",
                            "\n\n== ",
                            "\n\n=== ",
                            "\n\n==== ",
                            "\n\n===== ",
                            "\n--------------------------------------------------------------------------------",
                             "\n");

    $content = str_replace( $serachArray , $replaceArray , $content );

    return $content;
}

/**
 *
 * @param unknown_type $content
 * @return unknown_type
 */
function stripAttributes($content)
{
    $content = preg_replace('/(<a.*)href=(.*>)/', '${1}href..;,;..${2}', $content);
    while ( preg_match('/(<.*) .*=(\'|"|\w)\w*(\'|"|\w)(.*>)/', $content ) )
    {
        $content = preg_replace ( '/(<.*) .*=(\'|"|\w)\w*(\'|"|\w)(.*>)/', '${1}${4}', $content );
    }
    $content = str_replace('..;,;..', '=', $content);
    // <div: 565px;"-center"> entfernen
    $content = preg_replace('/<div:[^>]*>/', '', $content);
    $content = strip_tags( $content, '<a>' );

    return $content;
}

?>