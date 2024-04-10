<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Contract\Doctrine\UpdatedAwareInterface;
use App\Entity\Project;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Psr\Log\LoggerInterface;

#[AsDoctrineListener(event: Events::preUpdate, priority: 500, connection: 'default')]
#[AsDoctrineListener(event: Events::postUpdate, priority: 500, connection: 'default')]
class EntityUpdatedEventListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->logger->debug('preUpdate invoked', ['id' => $entity->getId()]);
        
        if ($entity instanceof UpdatedAwareInterface) {
            $entity->setUpdatedAt(new \DateTimeImmutable());
        }
    }

    public function postUpdate(PostUpdateEventArgs $args):void
    {
        $entity = $args->getObject();
        $this->logger->debug('postUpdate invoked', ['id' => $entity->getId()]);
    }
}