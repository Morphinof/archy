<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 18/05/2018
 * Time: 20:05
 */

namespace Archy\Core\Collection;

class Collection
{
    /** @var array $items */
    protected $items = [];

    /** @var int $count */
    private $count = 0;

    /**
     * @param mixed $item
     *
     * @return bool
     */
    public function has($item): bool
    {
        if (empty($this->items)) {
            return false;
        }

        foreach ($this->items as $i) {
            if ($i === $item) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param int $index
     *
     * @return null|mixed
     */
    public function get(int $index)
    {
        if (isset($this->items[$index])) {
            return $this->items[$index];
        }

        return null;
    }

    /**
     * @return array
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * @param mixed $item
     */
    public function add($item): void
    {
        if (!$this->has($item)) {
            $this->items[] = $item;
            $this->count++;
        }
    }

    /**
     * @param mixed $item
     *
     * @return bool
     */
    public function remove($item): bool
    {
        if (empty($this->items)) {
            return false;
        }

        foreach ($this->items as $index => $i) {
            if ($i === $item) {
                unset($this->items[$index]);
                $this->count--;
            }
        }
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }
}