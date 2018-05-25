<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 20:51
 */

namespace Archy\Service;

use Archy\Core\Door;
use Archy\Core\Dungeon;
use Archy\Core\Enum\CardinalPointEnum;
use Archy\Core\Enum\DoorTypeEnum;
use Archy\Core\Enum\DungeonTypeEnum;
use Archy\Core\Enum\RoomTypeEnum;
use Archy\Core\Level;
use Archy\Core\Room;

class DungeonGenerator
{
    /** @var array $options */
    private $options;

    /** @var Dungeon $dungeon */
    private $dungeon;

    /**
     * LevelGenerator constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @param array $options
     *
     * @throws \Exception
     */
    public function generateDungeon(array $options): void
    {
        $this->dungeon = new Dungeon(DungeonTypeEnum::getRandom());

        $numberOfLevels = $options[Options::OPT_NUMBER_OF_LEVELS] ?? $this->options[Options::OPT_NUMBER_OF_LEVELS];
        $numberOfRooms  = $options[Options::OPT_NUMBER_OF_ROOMS] ?? $this->options[Options::OPT_NUMBER_OF_ROOMS];

        for ($i = 0; $i <= $numberOfLevels; $i++) {
            $level = $this->generateLevel($numberOfRooms);

            $this->dungeon->getLevels()->add($level);
        }
    }

    /**
     * @param $numberOfRooms
     *
     * @return Level
     * @throws \Exception
     */
    public function generateLevel($numberOfRooms): Level
    {
        dump(sprintf('Start generating level %d for %s...', $this->dungeon->getLevels()->count() + 1, $this->dungeon->getName()));

        $level = new Level($numberOfRooms);

        $this->dungeon->getLevels()->add($level);

        for ($i = 1; $i < $numberOfRooms; $i++) {
            dump(sprintf('Generate room %d/%d', $i, $numberOfRooms));

            $room = $this->generateRoom($level);

            if (!$level->addRoom($room)) {
                #dump($this->dungeon);
                throw new \Exception(sprintf('Unable to place room %d on level %d', $i, $this->dungeon->getLevels()->count()));
            }

            dump(sprintf('Room %d/%d added to level %d', $i, $numberOfRooms, $level->getNumber()));
        }
    }

    /**
     * @param Level $level
     *
     * @return Room
     * @throws \Exception
     */
    public function generateRoom(Level $level = null): Room
    {
        $roomSize = rand(1, Room::MAX_ROOM_SIZE);
        $room     = new Room($level, RoomTypeEnum::getRandom(), $roomSize);

        return $room;
    }

    /**
     * @return string
     */
    public function display(): string
    {
        return '';
    }
}