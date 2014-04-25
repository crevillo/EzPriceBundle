<?php /* #?ini charset="utf-8"? */

/**
 * File containing the cronjob ini
 *
 * @copyright Copyright (C) 2007-2010 CJW Network - Coolscreen.de, JAC Systeme GmbH, Webmanufaktur. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPL v2
 * @version 1.0.0beta2 | $Id: cronjob.ini.append.php 10958 2010-03-30 13:39:59Z felix $
 * @package cjw_newsletter
 * @subpackage ini
 * @filesource
 */

/*
# php runcronjobs.php cjw_newsletter
# php runcronjobs.php -s siteaccess cjw_newsletter_mailqueue_create
# php runcronjobs.php -s siteaccess cjw_newsletter_mailqueue_process

[CronjobSettings]
ExtensionDirectories[]=cjw_newsletter
ScriptDirectories[]=cronjobs

#Scripts[]=cjw_newsletter_mailqueue_create.php
#Scripts[]=cjw_newsletter_mailqueue_process.php

# CronjobPart for Testing
[CronjobPart-cjw_newsletter]
Scripts[]=cjw_newsletter_mailqueue_create.php
Scripts[]=cjw_newsletter_mailqueue_process.php


[CronjobPart-cjw_newsletter_mailqueue_create]
Scripts[]=cjw_newsletter_mailqueue_create.php

[CronjobPart-cjw_newsletter_mailqueue_process]
Scripts[]=cjw_newsletter_mailqueue_process.php

*/ ?>
