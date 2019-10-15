<?php

namespace Publicato\Bundle\Serializer;

use JMS\Serializer\SerializationContext;
use Timiki\Bundle\RpcServerBundle\Serializer\SerializerInterface;

class RpcSerializer implements SerializerInterface
{
    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $jmsSerializer;

    /**
     * Serializer constructor.
     *
     * @param \JMS\Serializer\Serializer $jmsSerializer
     */
    public function __construct(\JMS\Serializer\Serializer $jmsSerializer)
    {
        $this->jmsSerializer = $jmsSerializer;
    }

    /**
     * Serialize data.
     *
     * @param mixed        $data
     * @param array|string $group
     *
     * @return array
     */
    public function serialize($data, $group = null)
    {
        if (!\is_array($data) && !\is_object($data)) {
            return $data;
        }

        $context = SerializationContext::create();
        $context->enableMaxDepthChecks();
        $context->setSerializeNull(true);

        if ($group) {
            $context->setGroups($group);
        }

        return $this->jmsSerializer->toArray($data, $context);
    }

    /**
     * Serialize data to json.
     *
     * @param mixed        $data
     * @param array|string $group
     *
     * @return string
     */
    public function toJson($data, $group = null)
    {
        if (\is_string($data)) {
            return $data;
        }

        $context = SerializationContext::create();
        $context->enableMaxDepthChecks();
        $context->setSerializeNull(true);

        if ($group) {
            $context->setGroups($group);
        }

        return $this->jmsSerializer->serialize($data, 'json', $context);
    }
}
