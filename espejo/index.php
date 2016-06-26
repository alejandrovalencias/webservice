<?php
include_once 'PlaceToPay.php';
$objRequest = new stdClass();
$objPlaceToPay = new PlaceToPay();
$objPlaceToPay->getBankList($objRequest);