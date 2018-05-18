<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 21:36
 */

namespace Archy\Core\Enum;

class DoorTypeEnum extends AbstractEnum
{
    const BROKEN = 'broken';
    const PORTAL = 'portal';
    const RIVER = 'river';
    const STEEL = 'steel';
    const TUNNEL = 'tunnel';
    const WOOD = 'wood';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::BROKEN,
            self::PORTAL,
            self::RIVER,
            self::STEEL,
            self::TUNNEL,
            self::WOOD,
        ];
    }
}