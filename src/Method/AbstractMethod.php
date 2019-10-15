<?php

namespace Publicator\Bundle\AppsBundle\Method;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class AbstractMethod implements ContainerAwareInterface
{
    use ContainerAwareTrait;
}
