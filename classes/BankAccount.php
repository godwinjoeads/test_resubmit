<?php

class BankAccount implements IfaceBankAccount
{

    private $balance = null;

    public function __construct(Money $openingBalance)
    {
        $this->balance = $openingBalance;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function deposit(Money $amount)
    {
        $bal = $this->balance;
        $this->balance = new Money($bal->value() + $amount->value());
    }

    public function withdraw(Money $amount)
    {
        if($this->balance->value() > $amount->value()){
            $this->balance = new Money($this->balance->value() - $amount->value());
        }else{
            throw new Exception("Withdrawl amount larger than balance");
        }
    }

    public function transfer(Money $amount, BankAccount $account)
    {
        $this->withdraw($amount);
        $account->balance   = new Money($account->balance->value() + $amount->value());
    }
}