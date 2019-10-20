<?php

namespace Publicator\Bundle\AppsBundle\EventSubscriber;

use Publicator\Bundle\AppsBundle\Method\AbstractMethod;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Timiki\Bundle\RpcServerBundle\Event\JsonPreExecuteEvent;

class ValidateHashSubscriber implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            JsonPreExecuteEvent::class => 'onPreExecute',
        ];
    }

    /**
     * @param JsonPreExecuteEvent $event
     *
     * @throws \Exception
     */
    public function onPreExecute(JsonPreExecuteEvent $event)
    {
        if (!$event->getObject() instanceof AbstractMethod) {
            return;
        }

        if (!$this->container->hasParameter('publicator.secret_key')) {
            throw new \Exception('NO_SECRET_KEY');
        }

        $request = $event->getJsonRequest();
        $params = $request->getParams();

        unset($params['hash']);

        $hash = \md5(\json_encode($params).$this->container->getParameter('publicator.secret_key'));

        if ($hash !== $request->get('hash')) {
            throw new \Exception('INVALID_HASH');
        }
    }
}
