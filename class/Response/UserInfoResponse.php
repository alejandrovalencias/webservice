<?php

/**
 *  UserInfoResponse.php
 *
 * PHP Version 5.3.0
 *
 * @category  PHP
 * @package   Response
 * @author    Sergio Alejandro Valencia López
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   1
 *
 */

/**
 *  UserInfoResponse.php
 *
 * Clase con los atributos para la respuesta de metodo getUserInfo
 *
 * @category  PHP
 * @package   Response
 * @author    Sergio Alejandro Valencia Lopez
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   1
 *
 */
class UserInfoResponse
{

    /**
     * Codigo de la repuesta
     * @var int
     */
    var $codeResponse;

    /**
     * Mensaje de respuesta
     * @var string
     */
    var $messageResponse;

    /**
     * Respuesta del servicio
     * @var UserInfo
     */
    var $response;

}
