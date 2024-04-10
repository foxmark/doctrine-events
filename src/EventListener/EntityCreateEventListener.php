<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Entity\Task;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Psr\Log\LoggerInterface;

#[AsDoctrineListener(event: Events::postPersist, priority: 500, connection: 'default')]
class EntityCreateEventListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function postPersist(PostPersistEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof Task) {
            $this->logger->debug('New Task Created', ['id' => $entity->getId()]);
        }
    }
}