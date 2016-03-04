<?php

namespace CdiLogger\Options;

use Zend\Stdlib\AbstractOptions;

class CdiLoggerOptions extends AbstractOptions {

    protected $defaultPath;

    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

  
    function getDefaultPath() {
        return $this->defaultPath;
    }



    function setDefaultPath($defaultPath) {
        $this->defaultPath = $defaultPath;
    }




}
