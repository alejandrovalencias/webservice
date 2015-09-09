<?php

/**
 * client.php
 *
 * Archivo de prueba
 *
 * @category  PHP
 * @package   Class
 * @author    Sergio Alejandro Valencia Lopez
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   1
 */

/**
 * Metodo de prueba para el servicio demo
 *
 * @param string $url Url del servicio
 *
 * @return boolean
 */
function validateWebServices($url)
{

    // Primero, compruebo si la URL es una URL valida
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }
    // Inicializo y configuro una peticion con CURL
    $curlInit = curl_init($url);

    // Limito el tiempo de espera en 5 segundos y configuro las opciones
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

    // Obtengo una respuesta
    $response = curl_exec($curlInit);
    curl_close($curlInit);

    if ($response) {
        return true;
    }
    return false;
}

try {
    $url = 'http://127.0.0.1/webservice/index.php?wsdl';
    $validacion = validateWebServices($url);
    if ($validacion) {
        $soapclient = new SoapClient($url);
        //$result = $soapclient->__getFunctions();
        try {
            $objRequest = new stdClass();
            $objRequest->document = '1234';
            $result = $soapclient->getUserInfo($objRequest);
//            $result = $soapclient->getUserAll();
            echo __FILE__ . __LINE__ . "<br/><pre>";
            print_r($result);
            echo "</pre><br/>";
//            exit();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    } else {
        echo 'erorr en la url';
    }
} catch (Exception $exc) {
    echo $exc->getMessage();
}