<?php

namespace Publicator\Bundle\AppsBundle\Method;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Timiki\Bundle\RpcServerBundle\Mapping as RPC;

abstract class AbstractMethod implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @RPC\Param
     * @Assert\NotBlank
     */
    protected $hash;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }
}
