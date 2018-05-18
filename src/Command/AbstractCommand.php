<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 18/05/2018
 * Time: 20:39
 */

namespace Archy\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends ContainerAwareCommand
{
    const NAME = 'archy:default';
    const DESCRIPTION = 'No description';
    const HELP = 'No help';
    const BAR_WIDTH = 50;
    const REDRAW_FREQUENCY = 1;
    const EMPTY_BAR_CHARACTER = ' ';

    /** @var InputInterface */
    protected $input;

    /** @var OutputInterface */
    protected $output;

    /** @var boolean */
    protected $debug = false;

    /** @var integer */
    protected $start = 0;

    /** @var integer */
    protected $elapsed = 0;

    /**
     * Default configuration
     */
    protected function configure()
    {
        $this->setName(static::NAME)
            ->setDescription(static::DESCRIPTION)
            ->setHelp(static::HELP)
            ->addOption(
                'debug',
                'd',
                InputOption::VALUE_NONE,
                'Debug mode activation (verbose command)'
            );
    }

    /**
     * Init progress bar
     *
     * @param array $items
     *
     * @return null|ProgressBar
     */
    protected function createProgressBar(array $items = []): ?ProgressBar
    {
        $count = count($items);

        if ($items != null && $count > 0) {
            $progress = new ProgressBar($this->output, $count);
            $progress->setEmptyBarCharacter(static::EMPTY_BAR_CHARACTER);
            $progress->setRedrawFrequency(static::REDRAW_FREQUENCY);
            $progress->setBarWidth(static::BAR_WIDTH);

            return $progress;
        }

        return null;
    }

    /**
     * Update elapsed time
     *
     * @return $this
     */
    protected function updateElapsed(): self
    {
        $this->elapsed = round(microtime(true) - $this->start, 2);

        return $this;
    }

    /**
     * Start the command
     */
    protected function start(): void
    {
        $this->start = microtime(true);

        if ($this->input->getOption('debug')) {
            $this->debug = true;
        }

        if ($this->debug) {
            echo sprintf("Start command %s\n", static::NAME);
        }
    }

    /**
     * Execute the command logic
     *
     * @return bool
     */
    protected function command(): bool
    {
        echo sprintf("Executing command %s logic...\n", static::NAME);

        return true;
    }

    /**
     * End the command
     */
    protected function end(): void
    {
        $this->updateElapsed();

        if ($this->debug) {
            echo sprintf("End command %s\n", static::NAME);
        }
    }

    /**
     * Execute the command
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->input  = $input;
        $this->output = $output;
        $this->start();
        $this->command();
        $this->end();
    }
}