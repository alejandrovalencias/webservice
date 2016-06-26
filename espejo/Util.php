<?php

date_default_timezone_set("America/Bogota");

/**
 * Description of Util
 *
 * @author Alejander
 */
class Util {

    /**
     *
     * @var string $strUrlPlaceToPay; 
     */
    public $strUrlPlaceToPay = 'placetopay.wsdl';

    /**
     *
     * @var string $strTranKey
     */
    public $strTranKey = '024h1IlD';

    
     /**
     *
     * @var string $strLogin
     */
    public $strLogin = '6dd490faf9cb87a9862245da41170ff2';
    /**
     *
     * @var object $_singleton
     */
    private static $_singleton;

    public static function instance() {
        if (!isset(self::$_singleton)) {
            self::$_singleton = new Util();
        }
        return self::$_singleton;
    }

    //Método para return el tranKey con sha1
    public function getTranKey($strTranKey, $strSeed) {
        $strResponse = '';
        if ($strTranKey !== '' && $strSeed !== '') {
            $strResponse = sha1($strSeed . $strTranKey, false);
        }
        return $strResponse;
    }

    //Método para retornar la semilla
    public function getSeed() {
        return date('c');
    }

}
