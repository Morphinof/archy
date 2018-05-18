<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 20:53
 */

namespace Archy\Core;

use Archy\Core\Enum\DungeonTypeEnum;
use Archy\Core\Enum\RoomTypeEnum;

class Dungeon
{
    const DEFAULT_NAME = 'Shandalar';

    /** @var int $id */
    private $id;

    /** @var string $name */
    private $name;

    /** @var string $type */
    private $type;

    /** @var Collection $levels */
    private $levels;

    /**
     * Dungeon constructor.
     *
     * @param string          $type
     * @param Collection|null $levels
     *
     * @throws \Exception
     */
    public function __construct(string $type, Collection $levels = null)
    {
        if (!in_array($type, DungeonTypeEnum::toArray())) {
            throw new \Exception(sprintf('Invalid %s type %s, available types [%s]', __CLASS__, $type, implode(', ', DungeonTypeEnum::toArray())));
        }

        $this->id     = uniqid(__CLASS__, true);
        $this->name   = self::DEFAULT_NAME;
        $this->type   = $type;
        $this->levels = $levels;

        if ($this->levels === null) {
            $this->levels = new Collection();
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Collection
     */
    public function getLevels(): Collection
    {
        return $this->levels;
    }

    /**
     * @param Collection $levels
     */
    public function setLevels(Collection $levels): void
    {
        $this->levels = $levels;
    }
}