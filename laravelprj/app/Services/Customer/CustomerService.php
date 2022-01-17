<?php

namespace App\Services\Customer;

use App\Entities\Customer\CustomerCreateTDO;
use App\Models\Customer;
use App\Services\Interfaces\ConsoleService;
use Illuminate\Support\Facades\DB;

class CustomerService implements ConsoleService
{    
    private array $errHeaders;
    private array $errData;
    
    public function __construct(array $data)
    {        
        $this->errHeaders = ['id', 'name', 'email', 'age', 'location', 'err_field'];
        $this->errData = [];
    }    
    public function fillCustomers(array $data) : void
    {
        $errData = [];
        foreach($data as $icustomer){
            $customerTDO = new CustomerCreateTDO(...$icustomer);
            if($customerTDO->error){                
                $addCustomer = $icustomer;                
                $addCustomer['err_field'] =  $customerTDO->err_field;
                $this->errData[] = $addCustomer;
            } else {
                $this->create($customerTDO);
            }
            
        }     
    }   
    private function create(CustomerCreateTDO $customerTDO) : Customer
    {
        $customer = new Customer();
        DB::transaction(function() use ($customerTDO, $customer){
            $customer->name = $customerTDO->name;
            $customer->email = $customerTDO->email;
            $customer->age = $customerTDO->age;
            $customer->location = $customerTDO->location;
            $customer->save();
        });
        return $customer;
    }        
    public function clearCustomers() : void
    {
        Customer::truncate();
    }
    public function getHeaders() : array
    {
        return $this->errHeaders;
    }
    public function getData() : array
    {        
        return $this->errData;
    }
}
