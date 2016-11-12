<?php

/**
 * User: Cristian Incarnato
 */
use Zend\ServiceManager\ServiceLocatorInterface;

return array(
    'factories' => array(
        'cdilogger' => 'CdiLogger\Factory\Log',
        'cdilogger_options' => function (ServiceLocatorInterface $sm) {
            $config = $sm->get('Config');
            return new \CdiLogger\Options\CdiLoggerOptions(isset($config['cdilogger_options']) ? $config['cdilogger_options'] : array());
        },
            )
        );

        
