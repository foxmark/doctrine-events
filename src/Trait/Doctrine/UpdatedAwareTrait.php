<?php

declare(strict_types=1);

namespace App\Trait\Doctrine;

use Doctrine\ORM\Mapping as ORM;

trait UpdatedAwareTrait
{
    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $updatedAt;

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}