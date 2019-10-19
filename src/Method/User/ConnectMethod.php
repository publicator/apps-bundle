<?php

namespace Publicator\Bundle\AppsBundle\Method\User;

use Publicator\Bundle\AppsBundle\Event\User\ConnectEvent;
use Publicator\Bundle\AppsBundle\Method\AbstractMethod;
use Symfony\Component\Validator\Constraints as Assert;
use Timiki\Bundle\RpcServerBundle\Mapping as RPC;

/**
 * @RPC\Method("user.connect")
 */
class ConnectMethod extends AbstractMethod
{
    /**
     * @RPC\Param
     * @Assert\NotBlank
     */
    protected $userId;

    /**
     * @Rpc\Execute
     *
     * @throws \Exception
     */
    public function execute()
    {
        $this->getEventDispatcher()->dispatch(new ConnectEvent($this->userId));

        return true;
    }
}
