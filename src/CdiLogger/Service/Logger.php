<?php

namespace CdiLogger\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;

/**
 * TITLE
 *
 * Description
 *
 * @author Cristian Incarnato <cristian.cdi@gmail.com>
 *
 * @package Paquete
 */
class Logger implements ServiceManagerAwareInterface {

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

}
