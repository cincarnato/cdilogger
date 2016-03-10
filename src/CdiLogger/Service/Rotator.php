<?php

namespace CdiLogger\Service;

use Zend\Log\Logger as ZendLogger;
use Zend\Authentication\AuthenticationService;
use Zend\Http\PhpEnvironment\Request;

/**
 * Class Log
 * @package CdiLogger\Service\Log
 */
class Rotator {
    
    static $TYPE_SIZE = 1;
    static $TYPE_TIME = 0;
    static $RANGE_TIME_HOUR = 2;
    static $RANGE_TIME_DAY = 3;
    static $RANGE_TIME_WEEK = 4;
    static $RANGE_TIEM_MONTH = 5;
    
    

    /**
     * @var 
     */
    protected $type = 0;

    
    protected $rangeTime = 3;
    
    /**
     * Size of File in MEGA BYTE
     * 
     * @var 
     */
    protected $size = "100"; 


    public function check(){
        if($this->type == 0){
            $this->checkTime();
        }else if($this->type == 1){
             $this->checkSize();
        }
    }
    
    
    protected function checkSize(){
        
    }
    
    
    protected function checkTime(){
        
    }
}
