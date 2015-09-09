<?php

/**
 * index file
 *
 * PHP Version 5.3.0
 *
 * @category  PHP
 * @package   wsportfolio
 * @author    Sergio Alejandro Valencia Lopez
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   SVN: $Id$
 *
 */

require_once 'class/Conf/Autoload.php';

Autoload::register(array(
        dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class',
        dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class'
        . DIRECTORY_SEPARATOR . 'Request',
        dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class'
        . DIRECTORY_SEPARATOR . 'Response',
        dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class'
        . DIRECTORY_SEPARATOR . 'Params',
        dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class'
        . DIRECTORY_SEPARATOR . 'Conf',
        dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class'
        . DIRECTORY_SEPARATOR . 'Business'
    )
);


if (isset($_GET['wsdl'])) {
    include_once 'Zend/Soap/AutoDiscover.php';
    $autodiscover = new Zend_Soap_AutoDiscover(true);

    $autodiscover->setUri('http://127.0.0.1/webservice/index.php');

    $autodiscover->setClass('WebService');
    $autodiscover->handle();
} else {

    ini_set("soap.wsdl_cache_enabled", 0);
    $server = new SoapServer('wsdl/webservice.wsdl');
    $server->setClass('WebService');
    $server->setPersistence(SOAP_PERSISTENCE_SESSION);
    $server->handle();
}