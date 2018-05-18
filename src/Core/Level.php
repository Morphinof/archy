<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 18/05/2018
 * Time: 21:13
 */

namespace Archy\Core;

use Archy\Core\Enum\RoomTypeEnum;
use Archy\Service\Options;

class Level
{
    /** @var int $number */
    private $number = 1;

    /** @var int $numberOfRooms */
    private $numberOfRooms = 0;

    /** @var Room $entrance */
    private $entrance;

    /**
     * Level constructor.
     *
     * @param int|null  $numberOfRooms
     * @param Room|null $entrance
     *
     * @throws \Exception
     */
    public function __construct(int $numberOfRooms = null, Room $entrance = null)
    {
        $this->numberOfRooms = $numberOfRooms;

        if ($numberOfRooms === null) {
            $this->numberOfRooms = Options::NUMBER_OF_ROOMS + log($this->number * 4);
        }

        $this->entrance = $entrance;

        if ($this->entrance === null) {
            $this->entrance = new Room($this, RoomTypeEnum::getRandom(), rand(1, Room::MAX_ROOM_SIZE));
        }
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumberOfRooms(): int
    {
        return $this->numberOfRooms;
    }

    /**
     * @param int $numberOfRooms
     */
    public function setNumberOfRooms(int $numberOfRooms): void
    {
        $this->numberOfRooms = $numberOfRooms;
    }

    /**
     * @return Room
     */
    public function getEntrance(): Room
    {
        return $this->entrance;
    }

    /**
     * @param Room $entrance
     */
    public function setEntrance(Room $entrance): void
    {
        $this->entrance = $entrance;
    }

    /**
     * @param Room|null $room
     *
     * @return array
     */
    public function getAllRooms(Room $room = null): array
    {
        static $rooms = [];
        $currentRoom = null;

        while (($currentRoom === null ? $currentRoom = $this->entrance : $room)) {
            $rooms[] = $currentRoom;

            /** @var Door $door */
            foreach ($currentRoom->getDoors() as $door) {
                $nextRoom = $door->getRoom();

                $this->getAllRooms($nextRoom);
            }
        }

        return $rooms;
    }

    /**
     * @return array
     */
    public function getAvailableRooms(): array
    {
        $rooms = $this->getAllRooms();
        $available = [];

        /** @var Room $room */
        foreach ($rooms as $room) {
            if ($room->getDoors()->count() < Options::NUMBER_OF_DOORS) {
                $available[] = $room;
            }
        }

        return $available;
    }

    /**
     * @return Room|null
     */
    public function getRandomAvailableRoom(): ?Room
    {
        if ($this->entrance->getDoors()->count() === 0) {
            return $this->entrance;
        }

        $rooms = $this->getAvailableRooms();

        if (empty($rooms)) {
            return null;
        }

        $available = $rooms[array_rand($rooms, 1)];

        if (empty($available)) {
            return null;
        }

        return $available;
    }

    /**
     * @param Room $room
     *
     * @return bool
     */
    public function addRoom(Room $room): bool
    {
        $availableRoom = $this->getRandomAvailableRoom();

        if ($availableRoom === null) {
            return false;
        }

        $door = $availableRoom->getAvailableDoor();

        if ($door !== null) {
            $door->setRoom($room);

            return true;
        }

        return false;
    }
}