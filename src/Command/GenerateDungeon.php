<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 18/05/2018
 * Time: 20:49
 */

namespace Archy\Command;

use Archy\Service\DungeonGenerator;
use Symfony\Component\Console\Input\InputOption;

class GenerateDungeon extends AbstractCommand
{
    const NAME = 'archy:generate:dungeon';

    /** @var DungeonGenerator $generator */
    private $generator;

    /**
     * RoleCommand constructor.
     *
     * @param DungeonGenerator $generator
     */
    public function __construct(DungeonGenerator $generator)
    {
        parent::__construct(self::NAME);

        $this->generator = $generator;
    }

    /**
     * Configuration
     */
    protected function configure(): void
    {
        parent::configure();

        $this
            ->setName(self::NAME)
            ->addOption(
                self::OPT_NUMBER_OF_ROOMS,
                self::SCT_NUMBER_OF_ROOMS,
                InputOption::VALUE_OPTIONAL
            );
    }

    /**
     * Generates a dungeons
     *
     * @return bool
     * @throws \Exception
     */
    protected function command(): bool
    {
        if ($this->checkArguments()) {
            $options = [
                self::OPT_NUMBER_OF_LEVELS => $this->input->getOption(self::OPT_NUMBER_OF_LEVELS) ?? self::NUMBER_OF_LEVELS,
                self::OPT_NUMBER_OF_ROOMS  => $this->input->getOption(self::OPT_NUMBER_OF_ROOMS) ?? self::NUMBER_OF_ROOMS,
            ];

            $this->generator->generate($options);

            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function checkArguments(): bool
    {
        return true;
    }
}