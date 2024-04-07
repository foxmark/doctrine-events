<?php

declare(strict_types=1);

namespace App\Contract\Doctrine;

interface UpdatedAwareInterface
{
    public function getUpdatedAt(): ?\DateTimeInterface;

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self;
}