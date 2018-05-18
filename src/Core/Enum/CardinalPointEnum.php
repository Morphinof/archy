<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 21:36
 */

namespace Archy\Core\Enum;

class CardinalPointEnum extends AbstractEnum
{
    const N = 'north';
    const N_E = 'north-east';
    const N_W = 'north-west';
    const E = 'east';
    const S = 'south';
    const S_E = 'south-east';
    const S_W = 'south-west';
    const W = 'west';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::N,
            self::N_E,
            self::N_W,
            self::E,
            self::S,
            self::S_E,
            self::S_W,
            self::W,
        ];
    }

    /**
     * @return array
     */
    public static function doorsPositions(): array
    {
        return [
            self::N,
            self::E,
            self::S,
            self::W,
        ];
    }
}