<?php
/**
 *  ${name}.php
 *
 * 5.3
 *
 * @category  ${name}
 * @package   ${name}
 * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
 * @version   1.0
 *
 */

/**
 *  Business.php
 *
 * Comentarios!
 *
 * @category  Business
 * @package   Business
 * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
 * @version   1.0
 *
 */
class Business
{
    /**
     * conexión a la base de datos
     * @var $_conection object
     */
    private $_conection = null;

    /**
     * Constructor de la clase
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1.0
     * @copyright 2014
     * @return \Business
     * @access public
     */
    public function __construct()
    {
        $this->_conection = Conection::Instance();
    }

    public function getUserAll()
    {
        $objResponse = new stdClass();
        $objResponse->message = '';
        $objResponse->response = '';

        $objConection = $this->_conection;

        $strSql = 'SELECT  usr_id ,usr_name ,usr_documentId
                          ,usr_lastName ,usr_email ,usr_age
                        FROM dem_user';

        try {
            $objConection->query($strSql);
            $arrResult = (array)$objConection->resultset();
        } catch (Exception $e) {
            $objResponse->message = $e->getMessage();
            return $objResponse;
        }

        if (count($arrResult) > 0) {
            $arrList = [];
            foreach ($arrResult as $data) {
                $objInfoUser = new UserInfo();
                $objInfoUser->id = $data['usr_id'];
                $objInfoUser->documentNumber = $data['usr_documentId'];
                $objInfoUser->lastName = $data['usr_lastName'];
                $objInfoUser->name = $data['usr_name'];
                $objInfoUser->email = $data['usr_email'];
                $objInfoUser->age = $data['usr_age'];
                $arrList[] = $objInfoUser;
            }
            $objResponse->response = $arrList;
            $objResponse->message = 'OK';
        } else {
            $objResponse->message = 'No hay usuarios';
        }

        return $objResponse;
    }

    public function getUserInfo($userDocAux)
    {
        $objResponse = new stdClass();
        $objResponse->message = '';
        $objResponse->response = '';

        $objConection = $this->_conection;
        $strSql = 'SELECT  usr_id
                              ,usr_name
                              ,usr_lastName
                              ,usr_email
                              ,usr_age
                        FROM dem_user
                        WHERE usr_documentId =:intDocumentId';

        $objConection->query($strSql);
        $objConection->bind(':intDocumentId', $userDocAux);
        $arrResult = (array)$objConection->single();

        if (isset($arrResult['usr_id'])) {

            $objInfoUser = new UserInfo();
            $objInfoUser->id = $arrResult['usr_id'];
            $objInfoUser->documentNumber = $userDocAux;
            $objInfoUser->lastName = $arrResult['usr_lastName'];
            $objInfoUser->name = $arrResult['usr_name'];
            $objInfoUser->email = $arrResult['usr_email'];
            $objInfoUser->age = $arrResult['usr_age'];

            $objResponse->response = $objInfoUser;
            $objResponse->message = 'OK';
        } else {
            $objResponse->message = 'Documento no existe';
        }

        return $objResponse;
    }


} 