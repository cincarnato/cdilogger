<?php
namespace CdiLogger\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\Filter\Priority;
use CdiLogger\Log;


class Log implements FactoryInterface
{
    /**
     * @var  Logger
     */
    private $logger;
    
    
    public function getLogger()
    {
        return $this->logger;
    }
    
      public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL)
    {
           $config = $container->get('Config');
        $config = $config['cdilogger_options'];
        $this->logger = new Log();
        $this->configuration($config);
        $this->writerCollection($config);
        $this->execute();
        return $this->logger;
          
      }
    
    
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Zend\Http\Client
     */
     public function createService(ServiceLocatorInterface $services) {
        return $this($services, \CdiLogger\Log::class);
    }

    /**
     * @param array $config
     *
     * @return int
     */
    private function writerCollection(array $config)
    {
        if (!empty($config['writers'])) {
            $writers = 0;
            foreach ($config['writers'] as $writer) {
                if ($writer['enabled']) {
                    $this->writerAdapter( $writer );
                    $writers ++;
                }
            }
            return $writers;
        }
    }
    /**
     * @param array $writer
     *
     * @return \Zend\Log\Writer\AbstractWriter
     */
    private function writerAdapter(array $writer)
    {
        $writerAdapter = new $writer['adapter']($writer['options']['output']);
        $this->logger->addWriter($writerAdapter);
        $writerAdapter->addFilter(
            new Priority(
                $writer['filter']
            )
        );
        return $writerAdapter;
    }
    /**
     * @param array $config
     */
    private function configuration(array $config)
    {
        if (!empty($config['registerErrorHandler'])) {
            $config['registerErrorHandler'] === false ?: Logger::registerErrorHandler( $this->logger );
        }
        if (!empty($config['registerExceptionHandler'])) {
            $config['registerExceptionHandler'] === false ?: Logger::registerExceptionHandler( $this->logger );
        }
    }
    /**
     * @return Logger
     */
    private function execute()
    {
        if ($this->logger->getWriters()->count() == 0) {
            return $this->logger->addWriter(new \Zend\Log\Writer\Null);
        }
    }
}
