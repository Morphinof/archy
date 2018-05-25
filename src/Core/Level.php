<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 18/05/2018
 * Time: 21:13
 */

namespace Archy\Core;

use Archy\Core\Collection\Collection;
use Archy\Service\Options;

class Level
{
    /** @var int $number */
    private $number = 1;

    /** @var int $numberOfRooms */
    private $numberOfRooms = 0;

    /** @var Collection $rooms */
    private $rooms;

    /**
     * Level constructor.
     *
     * @param int|null        $numberOfRooms
     * @param Collection|null $rooms
     */
    public function __construct(int $numberOfRooms = null, Collection $rooms = null)
    {
        $this->numberOfRooms = $numberOfRooms;

        if ($numberOfRooms === null) {
            $this->numberOfRooms = Options::NUMBER_OF_ROOMS + log($this->number * 4);
        }

        $this->rooms = $rooms;

        if ($this->rooms === null) {
            $this->rooms = new Collection();
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
     * @return array
     */
    public function getAvailableRooms(): array
    {
        $available = [];

        /** @var Room $room */
        foreach ($this->rooms->items() as $room) {
            dump(sprintf('Checking available doors of room %s %d door(s)', $room->getId(), $room->getDoors()->count()));

            if (($door = $room->getAvailableDoor()) !== null) {
                dump(sprintf('Available door %s founded !', $door->getId()));

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
        if ($this->rooms->count() === 0) {
            $this->rooms->add($room);

            return true;
        }

        $availableRoom = $this->getRandomAvailableRoom();

        if ($availableRoom === null) {
            dump(sprintf('No more available rooms !'));

            return false;
        }

        $door = $availableRoom->getAvailableDoor();

        if ($door !== null) {
            $door->setRoom($room);

            dump(sprintf('Door %s has been linked to Room %s !', $door->getId(), $room->getId()));

            return true;
        }

        dump(sprintf('No more available door in room %s but it should have been at least one !', $room->getId()));

        return false;
    }
}