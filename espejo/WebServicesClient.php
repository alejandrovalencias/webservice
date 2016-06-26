<?php

class WebServicesClient {

    /**
     * Parametro de tipo WebServices
     * @var WebServices
     */
    public $webServices;

    /**
     * Parametro con la respuesta del servicio
     * @var string
     */
    public $response;

    /**
     * Parametro para almacenar la descripcion del error
     * @var string
     */
    public $errorDescription;

    /**
     * Parametro con el tipo de error
     * @var string
     */
    public $errorType;

    /**
     * Constructor de la clase
     */
    public function __construct() {
        
    }

    /**
     * Metodo para instanciar el servicio web 
     */
    public function webServices($url
    , $login = null
    , $password = null
    , $header = null
    , $nameSpace = null
    ) {
        try {
            $socketTime = 15;

            if (!is_null($login) && !is_null($password)) {

                $this->webServices = new Soapclient($url, array(
                    'login' => $login,
                    'password' => $password,
                    'trace' => 1,
                    'exceptions' => true,
                    'cache_wsdl' => WSDL_CACHE_DISK,
                    'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
                    'default_socket_timeout' => $socketTime,
                ));
            } else {
                $this->webServices = new Soapclient($url, array(
                    'trace' => 1,
                    'exceptions' => true,
                    'cache_wsdl' => WSDL_CACHE_DISK,
                    'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
                    'default_socket_timeout' => $socketTime,
//                        'soap_version' => SOAP_1_2
                ));
            }

            //Creacion de cabeceras para webServices
            if (is_object($header) && !is_null($header)) {
                $authVals = new SoapVar($header, SOAP_ENC_OBJECT);
                $header = new SOAPHeader($nameSpace, 'authenticate', $authVals);
                $this->webServices->__setSoapHeaders($header);
            }
            return true;
        } catch (SoapFault $exc) {
            throw new Exception($exc->getMessage());
        }
        return false;
    }

    /**
     * Metodo para ejecutar metodos del servicio   
     */
    public function executeMethodWs($method
    , $url
    , $params = null
    , $login = null
    , $password = null
    , $header = null
    , $nameSpace = null
    ) {
        try {
            if ($this->webServices($url
                            , $login
                            , $password
                            , $header
                            , $nameSpace)) {
                if (is_string($method) && !empty($method)) {
                    if (is_null($params)) {
                        $this->response = $this->webServices->$method();
                    } else {
                        $this->response = $this->webServices->$method($params);
                    }
                    return true;
                }
            }
            return false;
        } catch (SoapFault $exc) {
            print_r($exc->getMessage());
            return false;
        }
        return false;
    }

    /**
     * Metodo para consumir servicio web teniendo realizando una cantidad n de internos 
     * cada n segundos    
     */
    public function executeMethodWithIntent($object) {
        if (is_object($object)) {
            $method = (isset($object->method)) ? $object->method : '';
            $url = (isset($object->url)) ? $object->url : '';
            $params = (isset($object->params)) ? $object->params : null;
            $login = (isset($object->login)) ? $object->login : null;
            $password = (isset($object->password)) ? $object->password : null;
            $header = (isset($object->header)) ? $object->header : null;
            $nameSpace = (isset($object->nameSpace)) ? $object->nameSpace : null;
            $sleepSeg = (isset($object->sleepSeg)) ? $object->sleepSeg : 0;
            $numIntent = (isset($object->numIntent)) ? $object->numIntent : 0;

            if (((bool) is_numeric($sleepSeg) === true) &&
                    $sleepSeg > 0 &&
                    ((bool) is_numeric($numIntent) === true) &&
                    $numIntent > 0
            ) {
                for ($index = 1; $index <= $numIntent; $index++) {
                    if ($this->executeMethodWs($method
                                    , $url
                                    , $params
                                    , $login
                                    , $password
                                    , $header
                                    , $nameSpace
                                    , $sleepSeg
                                    , $numIntent)) {

                        sleep($sleepSeg);
                    }
                }
            } else {
                print_r('No se ingresaron datos para realizar los intentos');
            }
        } else {
            print_r('El parametro de entrada no es un objeto');
        }
        return false;
    }

}
