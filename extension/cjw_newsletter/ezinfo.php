<?php
/**
 * File containing cjw_newsletterInfo class
 *
 * @copyright Copyright (C) 2007-2010 CJW Network - Coolscreen.de, JAC Systeme GmbH, Webmanufaktur. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPL v2
 * @version 1.0.0beta2 | $Id: ezinfo.php 13088 2010-09-27 14:25:36Z felix $
 * @package cjw_newsletter
 */
/**
 * Class description here
 *
 * @version 1.0.0beta2
 * @package cjw_newsletter
 */
class cjw_newsletterInfo
{
    // set manually - is used in email header, and in file header @version
    const SOFTWARE_VERSION = '1.0.0beta2';

    static function info()
    {
        return array( 'Name'             => 'CJW Newsletter - Multi Channel Marketing',
                      'Version'          => self::SOFTWARE_VERSION,
                      'eZ version'       => '4.x',
                      'Copyright'        => '(C) 2007-' . date( 'Y' ) . ' <a href="http://www.cjw-network.com">CJW Network</a> [ <a href="http://www.coolscreen.de">coolscreen.de - enterprise internet</a> &amp; <a href="http://www.jac-systeme.de">JAC Systeme</a> &amp; <a href="http://www.webmanufaktur.ch">Webmanufaktur</a> ]',
                      'License'          => 'GNU General Public License v2.0',
                      'More Information' => '<a href="http://projects.ez.no/cjw_newsletter">http://projects.ez.no/cjw_newsletter</a>'
                    );
    }

    /**
     * get some additional infos about the newsletter
     * for future use
     */
    static function packageInfo()
    {
        $infoArray = array();
        $infoArray[ 'release_version' ] = '1.0.0beta2';

        // is set when building the package
        $infoArray[ 'release_svn_revision' ] = '13095';
        return $infoArray;
    }
}
?>
