<?php

/**
 * Calendar module initialization file
 *
 * @package activeCollab.modules.calendar
 */

define('QUOTE_MODULE', 'quote');
define('QUOTE_MODULE_PATH', APPLICATION_PATH . '/modules/quote');


AngieApplication::setForAutoload(array(
    'Quote' => QUOTE_MODULE_PATH . '/models/Quote.class.php',
    'MyQuoteFile' =>  QUOTE_MODULE_PATH . '/models/MyQuoteFile.class.php',
    'PHPMailer' => QUOTE_MODULE_PATH . '/models/phpmailer/class.phpmailer.php' ,
    'TCPDF' => QUOTE_MODULE_PATH . '/models/tcpdf/tcpdf.php',
    'api' => QUOTE_MODULE_PATH . '/models/api.php',
));
/**
 * Returns true if $user can see $profile calendar
 *
 * @param User $user
 * @return boolean
 */
