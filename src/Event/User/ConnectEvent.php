<?php

namespace Publicator\Bundle\AppsBundle\Event\User;

use Publicator\Bundle\AppsBundle\Event\AbstractEvent;

class ConnectEvent extends AbstractEvent
{
    /**
     * @var null|int
     */
    private $userId;

    /**
     * @param null|int $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return null|int
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
