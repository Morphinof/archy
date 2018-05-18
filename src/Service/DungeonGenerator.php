<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 20:51
 */

namespace Archy\Service;

use Archy\Core\Dungeon;
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
     * @throws \Exception
     */
    public function generateDungeon(): void
    {
        $this->dungeon = new Dungeon(DungeonTypeEnum::getRandom());

        $numberOfLevels = $this->options[Options::OPT_NUMBER_OF_LEVELS] ?? 1;
        $numberOfRooms  = $this->options[Options::OPT_NUMBER_OF_ROOMS] ?? rand(1, 10);

        for ($i = 0; $i <= $numberOfLevels; $i++) {
            $level = $this->generateLevel($numberOfRooms);

            $this->dungeon->getLevels()->add($level);
        }

        dump($this->dungeon);
    }

    /**
     * @param $numberOfRooms
     *
     * @return Level
     * @throws \Exception
     */
    public function generateLevel($numberOfRooms): Level
    {
        $level = new Level($numberOfRooms);

        for ($i = 1; $i < $numberOfRooms; $i++) {
            $room = $this->generateRoom($level);

            if (!$level->addRoom($room)) {
                 throw new \Exception(sprintf('Unable to place room %d on level %d', $i, $this->dungeon->getLevels()->count()));
            }
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