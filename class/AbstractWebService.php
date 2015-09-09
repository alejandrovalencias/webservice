<?php

/**
 * AbstractWebService.php
 *
 * PHP Version 5.3.0
 *
 * @category  PHP
 * @package   Class
 * @author    Sergio Alejandro Valencia Lopez
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   1
 *
 */

/**
 * WebService.php
 *
 * Clase AbstractWebService
 *
 * @category  PHP
 * @package   Class
 * @author    Sergio Alejandro Valencia Lopez
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   1
 */
interface AbstractWebService
{
    /**
     * Metodo para obtener la informacion del usuario
     **
     * @param DocumentUserRequest $userDoc Parametros de entrada
     *
     * @return  UserInfoResponse
     */
    public function getUserInfo($userDoc);


    /**
     * Metodo para obtener todos los usuarios
     *
     * @return  UserAllResponse
     */
    public function getUserAll();

}
