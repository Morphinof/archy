<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 20:55
 */

namespace Archy\Core\Enum;

class RoomTypeEnum extends AbstractEnum
{
    const BOSS = 'boss';
    const COMBAT = 'combat';
    const EMPTY = 'empty';
    const SHOP = 'shop';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::BOSS,
            self::COMBAT,
            self::EMPTY,
            self::SHOP,
        ];
    }
}