<?php

namespace Publicator\Bundle\AppsBundle\Method\Publication;

use Publicator\Bundle\AppsBundle\Event\Publication\PublishEvent;
use Publicator\Bundle\AppsBundle\Method\AbstractMethod;
use Symfony\Component\Validator\Constraints as Assert;
use Timiki\Bundle\RpcServerBundle\Mapping as RPC;

/**
 * @RPC\Method("publication.publish")
 */
class PublishMethod extends AbstractMethod
{
    /**
     * @RPC\Param
     * @Assert\NotBlank
     */
    protected $userId;

    /**
     * @RPC\Param
     * @Assert\NotBlank
     */
    protected $publication;

    /**
     * @Rpc\Execute
     *
     * @throws \Exception
     */
    public function execute()
    {
        $this->getEventDispatcher()->dispatch(new PublishEvent($this->userId, $this->publication));

        return true;
    }
}
