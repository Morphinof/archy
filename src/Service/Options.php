<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 18/05/2018
 * Time: 21:08
 */

namespace Archy\Service;

final class Options
{
    const NUMBER_OF_LEVELS = 1;
    const OPT_NUMBER_OF_LEVELS = 'opt-numbers-of-levels';
    const SCT_NUMBER_OF_LEVELS = 'l';
    const DSC_NUMBER_OF_LEVELS = 'Number of levels to generate';

    const NUMBER_OF_ROOMS = 10;
    const OPT_NUMBER_OF_ROOMS = 'opt-numbers-of-rooms';
    const SCT_NUMBER_OF_ROOMS = 'r';
    const DSC_NUMBER_OF_ROOMS = 'Number of rooms to generate at first level, next levels will get more rooms';

    const NUMBER_OF_DOORS = 4;
    const OPT_NUMBER_OF_DOORS = 'opt-numbers-of-doors';
    const SCT_NUMBER_OF_DOORS = 'd';
    const DSC_NUMBER_OF_DOORS = 'Max number of doors per room';
}