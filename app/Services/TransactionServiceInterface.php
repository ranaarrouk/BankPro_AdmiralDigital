<?php


namespace App\Services;


interface TransactionServiceInterface
{
    public function deposit($amount) : void;

    public function transferMoney($accountNumber, $amount) : void;
}
