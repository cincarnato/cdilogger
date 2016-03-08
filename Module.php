<?php

namespace CdiLogger;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * Module
 *
 * @package   Cdi
 * @copyright Cristian Incarnato (c) - http://www.cincarnato.com
 */
class Module implements AutoloaderProviderInterface {

    public function init() {
        
    }
  
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
            return include __DIR__ . '/config/services.config.php';
    }

    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(
            new Request($e->getApplication()->getServiceManager()->get('cdilogger'))
        );
        $config = $e->getApplication()->getServiceManager()->get('Config');
        $moduleConfig = $config['cdilogger_options'];
        $response   = new Response($e->getApplication()->getServiceManager()->get('cdilogger'));
        $mediaTypes = empty($moduleConfig['doNotLog']['mediaTypes']) ? array() : $moduleConfig['doNotLog']['mediaTypes'];
        $response->setIgnoreMediaTypes($mediaTypes);
        $eventManager->attach($response);
        return;
    }


  

}
