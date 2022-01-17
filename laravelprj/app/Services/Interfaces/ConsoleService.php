<?php
namespace App\Services\Interfaces;

interface ConsoleService {
    // public function setData (string $path);    
    public function getHeaders () : array;
    public function getData () : array;
}