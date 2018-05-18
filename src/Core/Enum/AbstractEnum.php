<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 22:16
 */

namespace Archy\Core\Enum;


abstract class AbstractEnum
{
    abstract static function toArray(): array;

    /**
     * @return string
     */
    public static function getRandom(): string
    {
        return self::toArray()[array_rand(self::toArray(), 1)];
    }
}