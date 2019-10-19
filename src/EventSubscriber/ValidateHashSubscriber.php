<?php

namespace Timiki\Bundle\RpcServerBundle\EventSubscriber;

use Publicator\Bundle\AppsBundle\Method\AbstractMethod;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Timiki\Bundle\RpcServerBundle\Event\JsonPreExecuteEvent;

class ValidateHashSubscriber implements EventSubscriberInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var ValidatorInterface
     */
    private $validator;

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
     * ValidatorSubscriber constructor.
     *
     * @param null|ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator = null)
    {
        $this->validator = $validator;
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
