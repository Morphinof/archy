<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/05/2018
 * Time: 20:26
 */

namespace Archy\Core\Tree;


abstract class AbstractNode
{
    /** @var string $id */
    private $id;

    /** @var mixed $item */
    protected $item;

    /** @var Node $parent */
    protected $parent;

    /** @var int $depth */
    protected $depth;

    public function __construct(Node $parent = null, int $depth = 0)
    {
        $this->id     = uniqid('Node_');
        $this->item   = null;
        $this->parent = $parent;
        $this->depth  = $depth;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param mixed $item
     */
    public function setItem($item): void
    {
        $this->item = $item;
    }

    /**
     * @return Node
     */
    public function getParent(): Node
    {
        return $this->parent;
    }

    /**
     * @param Node $parent
     */
    public function setParent(Node $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return int
     */
    public function getDepth(): int
    {
        return $this->depth;
    }

    /**
     * @param int $depth
     */
    public function setDepth(int $depth): void
    {
        $this->depth = $depth;
    }
}