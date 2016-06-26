<?php

/**
 * Description of transaction
 *
 * @author Alejandro
 */
class Transaction {

    /**
     *
     * @var string $bankCode 
     */
    public $bankCode;

    /**
     *
     * @var string $bankInterface 
     */
    public $bankInterface;

    /**
     *
     * @var string $returnURL 
     */
    public $returnURL;

    /**
     *
     * @var string $reference 
     */
    public $reference;

    /**
     *
     * @var string $description 
     */
    public $description;

    /**
     *
     * @var string $language 
     */
    public $language;

    /**
     *
     * @var string $currency 
     */
    public $currency;

    /**
     *
     * @var double $totalAmount 
     */
    public $totalAmount;

    /**
     *
     * @var double $taxAmount 
     */
    public $taxAmount;

    /**
     *
     * @var double $devolutionBase 
     */
    public $devolutionBase;

    /**
     *
     * @var Person $payer 
     */
    public $payer;

    /**
     *
     * @var Person $buyer 
     */
    public $buyer;

    /**
     *
     * @var Person $shipping
     */
    public $shipping;

    /**
     *
     * @var string $ipAddress 
     */
    public $ipAddress;

    /**
     *
     * @var string $userAgent 
     */
    public $userAgent;

    /**
     *
     * @var array $additionalData 
     */
    public $additionalData;

}
