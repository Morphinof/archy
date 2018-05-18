<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 17/05/2018
 * Time: 20:55
 */

namespace Archy\Core\Enum;

class DungeonTypeEnum extends AbstractEnum
{
    const SEWER = 'sewer';
    const TOWN = 'town';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::SEWER,
            self::TOWN,
        ];
    }
}