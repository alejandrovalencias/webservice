<?php
include_once 'Auth.php';
include_once 'Util.php';
include_once 'Item.php';
/**
 * Description of PlaceToPayDTO
 *
 * @author Alejandro
 */
class PlaceToPayDTO {

    //Se valida que los datos se han correctos
    public function validData($objParams) {
        return true;
    }

    public function getDataBankList($objParams) {
        //en caso de que se necesite algùn item
        $objAuth = new Auth ();
        $strSeed = Util::instance()->getSeed();
        $objAuth->login =  Util::instance()->strLogin;
        $objAuth->seed = $strSeed;
        $objAuth->tranKey = Util::instance()->getTranKey(
                Util::instance()->strTranKey, $strSeed);
        $objAuth->additional [] = new Item();
        
        $objReponse = new stdClass();        
        $objReponse->auth = $objAuth;
        return $objReponse;
    }

}
