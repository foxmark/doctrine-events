<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Contract\Doctrine\UpdatedAwareInterface;
use App\Entity\Project;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Psr\Log\LoggerInterface;

#[AsDoctrineListener(event: Events::preUpdate, priority: 500, connection: 'default')]
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
        if ($entity instanceof UpdatedAwareInterface) {
            $entity->setUpdatedAt(new \DateTimeImmutable());
        }

        if ($entity instanceof Project) {
            $changes = $args->getEntityChangeSet();
            if(isset($changes['name'])) {
                $this->logger->debug('Name has changed', ['id' => $entity->getId()]);
            }
        }
    }
}