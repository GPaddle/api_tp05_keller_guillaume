<?php
declare(strict_types=1);

namespace App\Domain\Category;

use JsonSerializable;

class Category implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @param int|null  $id
     * @param string    $name
     */
    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = ucfirst($name);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
