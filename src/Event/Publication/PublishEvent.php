<?php

namespace Publicator\Bundle\AppsBundle\Event\Publication;

use Publicator\Bundle\AppsBundle\Event\AbstractEvent;

class PublishEvent extends AbstractEvent
{
    /**
     * @var null|int
     */
    private $userId;

    /**
     * @var array
     */
    private $publication;

    /**
     * @param null|int $userId
     * @param array    $publication
     */
    public function __construct($userId, $publication)
    {
        $this->userId = $userId;
        $this->publication = $publication;
    }

    /**
     * @return null|int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getPublication()
    {
        return $this->publication;
    }
}
