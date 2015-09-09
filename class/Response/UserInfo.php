<?php

/**
 *  UserInfo.php
 *
 * PHP Version 5.3.0
 *
 * @category  PHP
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
 * @author    Sergio Alejandro Valencia López
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   1
 *
 */
class UserInfo
{

    /**
     * id de usuario
     * @var int
     */
    public $id;

    /**
     * Numero de documento
     * @var int
     */
    public $documentNumber;

    /**
     * Nombre usuario
     * @var string
     */
    public $name;

    /**
     * apellido usuario
     * @var string
     */
    public $lastName;

    /**
     * Correo usuario
     * @var string
     */
    public $email;

    /**
     * Edad usuario
     * @var int
     */
    public $age;

}
