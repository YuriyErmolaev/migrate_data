<?php

namespace App\Entities\Customer;

class CustomerCreateTDO
{
    public string $name;
    public string $email;
    public int $age;
    public string $location;
    public string $err_field;
    public bool $error;
    
    

    public function __construct( string $id = '', string $name, string $email, string $age, string $location)
    {        
        $this->name = $name;
        $this->email = $email;                
        
        $age = (int)$age;
        $this->age = $age;        
        
        $this->location = $location;
        
        $this->er_field = '';
        $this->error = false;
        
        $this->validate($age, $email, $location);       
    }

    private function validate($age, $email, $location)
    {        
        if($age < 18 || $age > 99 ){            
            $this->err_field = 'age';
            $this->error = true;            
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->err_field = 'email';
            $this->error = true;
        }        
        if(!$location){
            $this->location = 'Unknown';                
        }
    }
    



}
