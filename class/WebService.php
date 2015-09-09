<?php

/**
 * WebService.php
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
 * Clase Servicio
 *
 * @category  PHP
 * @package   Class
 * @author    Sergio Alejandro Valencia Lopez
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   1
 */
class WebService implements AbstractWebService
{
    /**
     * Metodo para obtener la informacion del usuario
     **
     * @param DocumentUserRequest $userDoc Parametros de entrada
     *
     * @return  UserInfoResponse
     * @author  Sergio Alejandro Valencia Lopez
     * @version 1
     * @access public
     */
    public function getUserInfo($userDoc)
    {
        $userInfoResponse = new UserInfoResponse();
        $userInfoResponse->codeResponse = '01';
        $userInfoResponse->messageResponse = '';
        $userInfoResponse->response = null;
        $userDocAux = 0;

        if (isset($userDoc->document)) {
            $userDocAux = (int)$userDoc->document;
        }

        if ((int)$userDocAux > 0) {
            $objBusiness = new Business();
            $objResponse = $objBusiness->getUserInfo($userDocAux);
            if ($objResponse->message == 'OK') {
                $userInfoResponse->response = $objResponse->response;
                $userInfoResponse->codeResponse = '00';
            } else {
                $userInfoResponse->messageResponse = $objResponse->message;
            }
        } else {
            $userInfoResponse->messageResponse = 'Documento no valido';
        }
        return $userInfoResponse;
    }

    /**
     * Metodo para obtener todos los usuarios
     *
     * @return  UserAllResponse
     * @author  Sergio Alejandro Valencia Lopez
     * @version 1
     * @access public
     */
    public function getUserAll()
    {
        $userInfoResponse = new UserAllResponse();
        $userInfoResponse->codeResponse = '01';
        $userInfoResponse->messageResponse = '';
        $userInfoResponse->response = null;

        $objBusiness = new Business();
        $objResponse = $objBusiness->getUserAll();
        if ($objResponse->message == 'OK') {
            $userInfoResponse->response = $objResponse->response;
            $userInfoResponse->codeResponse = '00';
        } else {
            $userInfoResponse->messageResponse = $objResponse->message;
        }

        return $userInfoResponse;
    }
}
