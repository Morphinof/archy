<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 20:53
 */

namespace Archy\Core;

use Archy\Core\Enum\CardinalPointEnum;
use Archy\Core\Enum\DoorTypeEnum;
use Archy\Core\Enum\RoomTypeEnum;

class Room
{
    const MAX_ROOM_SIZE = 2;

    /** @var int $id */
    private $id;

    /** @var string $type */
    private $type;

    /** @var int $size */
    private $size;

    /** @var Level $level */
    private $level;

    /** @var Collection $doors */
    private $doors;

    /**
     * Room constructor.
     *
     * @param Level      $level
     * @param string     $type
     * @param int        $size
     * @param Collection $doors
     *
     * @throws \Exception
     */
    public function __construct(Level $level = null, string $type, int $size, Collection $doors = null)
    {
        if ($level === null) {
            throw new \Exception(sprintf('Missing level'));
        }

        if (!in_array($type, RoomTypeEnum::toArray())) {
            throw new \Exception(sprintf('Invalid %s type %s, available types [%s]', __CLASS__, $type, implode(', ', RoomTypeEnum::toArray())));
        }

        if ($size > self::MAX_ROOM_SIZE) {
            throw new \Exception(sprintf('Invalid size %d, max allowed size : %d', $size, self::MAX_ROOM_SIZE));
        }

        $this->id    = uniqid(__CLASS__, true);
        $this->type  = $type;
        $this->size  = $size;
        $this->level = $level;
        $this->doors = $doors;

        if (empty($this->doors)) {
            $this->initDoors();
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
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return Level
     */
    public function getLevel(): Level
    {
        return $this->level;
    }

    /**
     * @param Level $level
     */
    public function setLevel(Level $level): void
    {
        $this->level = $level;
    }

    /**
     * @return Collection
     */
    public function getDoors(): Collection
    {
        return $this->doors;
    }

    /**
     * @param array $doors
     */
    public function setDoors(array $doors): void
    {
        $this->doors = $doors;
    }

    /**
     * @return Door|null
     */
    public function getAvailableDoor(): ?Door
    {
        /** @var Door $door */
        foreach ($this->getDoors() as $door) {
            if ($door->getRoom() === null) {
                return $door;
            }
        }

        return null;
    }

    /**
     * Default configuration with 4 doors
     *
     * @throws \Exception
     */
    private function initDoors(): void
    {
        $this->doors = new Collection();

        if ($this->getLevel()) {

        }
        foreach (CardinalPointEnum::doorsPositions() as $position) {
            # Create a new random door
            $door = new Door(DoorTypeEnum::getRandom(), $position, $this, null);

            $this->doors->add($door);
        }
    }
}