<?php

namespace Publicator\Bundle\AppsBundle\Event\User;

use Publicator\Bundle\AppsBundle\Event\AbstractEvent;

class DisconnectEvent extends AbstractEvent
{
    /**
     * @var null|int
     */
    private $userId;

    /**
     * @param null|int $userId
     */
    public function __construct(?int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return null|int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
