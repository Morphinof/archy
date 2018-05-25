<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/05/2018
 * Time: 19:51
 */

namespace Archy\Core\Tree;

class ChainedList
{
    /** @var string $id */
    protected $id;

    /** @var Node $root */
    protected $root;

    public function __construct()
    {
        $this->id   = uniqid('ChainedList_');
        $this->root = new Node();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Node
     */
    public function getRoot(): Node
    {
        return $this->root;
    }

    /**
     * @param Node $root
     */
    public function setRoot(Node $root): void
    {
        $this->root = $root;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        static $count = 0;
        static $currentNode = null;

        if ($currentNode === null) {
            $currentNode = $this->root;
        }

        if ($currentNode->getChild() !== null) {
            $count++;
            $currentNode = $currentNode->getChild();

            $this->count();
        }

        return $count;
    }

    /**
     * @return array
     */
    public function items(): array
    {
        static $items = [];
        static $currentNode = null;

        if ($currentNode === null) {
            $currentNode = $this->root;
        }

        $item[] = $currentNode;
        if ($currentNode->getChild() !== null) {
            $this->items();
        }

        return $items;
    }

    /**
     * @param Node $node
     *
     * @return bool
     */
    public function remove(Node $node): bool
    {
        $currentNode = $this->root;

        while ($currentNode !== null) {
            if ($currentNode === $node) {
                $parent   = $currentNode->getParent();
                $child = $currentNode->getChild();

                if ($parent !== null && $child !== null) {
                    $parent->setChild($child);
                    $child->setParent($parent);
                } else {
                    if ($child !== null) {
                        $child->setParent(null);
                    } else {
                        if ($parent !== null) {
                            $parent->setChild(null);
                        }
                    }
                }

                return true;
            }

            $currentNode = $currentNode->getChild();
        }

        return false;
    }
}