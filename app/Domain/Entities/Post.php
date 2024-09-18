<?php

namespace App\Domain\Entities;

use DateTimeImmutable;
use InvalidArgumentException;

class Post
{
    private ?int $id;
    private string $title;
    private string $content;
    private DateTimeImmutable $createdAt;

    public function __construct(?int $id, string $title, string $content, ?DateTimeImmutable $createdAt = null){
        $this->setId($id);
        $this->setTitle($title);
        $this->setContent($content);
        $this->createdAt = $createdAt ?? new DateTimeImmutable();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function assignId(int $id): void
    {
        if($this->id === null){
            $this->id = $id;
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        if (empty($title)) {
            throw new InvalidArgumentException('Title cannot be empty');
        }
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        if(empty($content)) {
            throw new InvalidArgumentException('Content cannot be empty');
        }
        $this->content = $content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}

?>


