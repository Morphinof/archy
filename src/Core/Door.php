<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 21:29
 */

namespace Archy\Core;

use Archy\Core\Enum\CardinalPointEnum;
use Archy\Core\Enum\DoorTypeEnum;

class Door
{
    /** @var int $id */
    private $id;

    /** @var string $type */
    private $type;

    /** @var string $position */
    private $position;

    /** @var Room $room */
    private $parent;

    /** @var Room $room */
    private $room;

    /**
     * Door constructor.
     *
     * @param string $type
     * @param string $position
     * @param Room   $parent
     * @param Room   $room
     *
     * @throws \Exception
     */
    public function __construct(string $type, string $position, Room $parent = null, Room $room = null)
    {
        if (!in_array($type, DoorTypeEnum::toArray())) {
            throw new \Exception(sprintf('Invalid %s type %s, available types [%s]', __CLASS__, $type, implode(', ', DoorTypeEnum::toArray())));
        }

        if (!in_array($position, CardinalPointEnum::doorsPositions())) {
            throw new \Exception(sprintf('Invalid cardinal position %s, allowed positions [%s]', __CLASS__, $position, implode(', ', CardinalPointEnum::doorsPositions())));
        }

        if ($parent === null) {
            throw new \Exception(sprintf('Missing parent door'));
        }

        $this->id       = uniqid(__CLASS__, true);
        $this->type     = $type;
        $this->position = $position;
        $this->parent   = $parent;
        $this->room     = $room;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return Room
     */
    public function getParent(): Room
    {
        return $this->parent;
    }

    /**
     * @param Room $parent
     */
    public function setParent(Room $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }
}