<?php

/**
 * User: Cristian Incarnato
 */
use Zend\ServiceManager\ServiceLocatorInterface;

return array(
    'invokables' => array(
    ),
    'factories' => array(
        'cdilogger_options' => function (ServiceLocatorInterface $sm) {
            $config = $sm->get('Config');
            return new \CdiLogger\Options\CdiLoggerOptions(isset($config['cdilogger_options']) ? $config['cdilogger_options'] : array());
        },
        'cdilogger_utility' => function (ServiceLocatorInterface $sm) {
            $service = new \CdiLogger\Service\Utility();
            $service->setServiceManager($sm);
            return $service;
        }
                
    ));
