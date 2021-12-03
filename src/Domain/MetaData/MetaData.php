<?php
declare(strict_types=1);

namespace App\Domain\MetaData;

use JsonSerializable;

class MetaData implements JsonSerializable
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
     * @var string
     */
    private $value;

    /**
     * @param int|null  $id
     * @param string    $name
     * @param string    $value
     */
    public function __construct(?int $id, string $name, string $value)
    {
        $this->id = $id;
        $this->name = ucfirst($name);
        $this->value = ucfirst($value);
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
    public function getMetaDataName(): string
    {
        return $this->name;
    }
    
    /**
     * @return string
     */
    public function getMetaDataValue(): string
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value
        ];
    }
}
