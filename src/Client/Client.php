<?php

namespace Publicator\Bundle\AppsBundle\Client;

use Doctrine\Common\Cache\Cache;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Timiki\RpcClient\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * Client constructor.
     *
     * @param array|string                  $address         RPC server address string or array
     * @param null|EventDispatcherInterface $eventDispatcher
     * @param null|string                   $apiKey
     * @param array                         $options
     * @param null|Cache                    $cache
     */
    public function __construct($address, EventDispatcherInterface $eventDispatcher = null, $apiKey = null, $options = [], Cache $cache = null)
    {
        parent::__construct($address, $eventDispatcher, $options, $cache);
    }

    /**
     * {@inheritdoc}
     */
    public function notice($method, array $params = [], array $headers = [])
    {
        parent::notice($method, \array_merge($params, ['apiKey' => $this->apiKey]), $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function call($method, array $params = [], array $headers = [])
    {
        parent::call($method, \array_merge($params, ['apiKey' => $this->apiKey]), $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function callWithCache($method, array $params = [], $key = null, $lifetime = 3600, array $headers = [])
    {
        return parent::callWithCache($method, \array_merge($params, ['apiKey' => $this->apiKey]), $key, $lifetime, $headers);
    }
}
