<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/05/2018
 * Time: 20:31
 */

namespace Archy\Core\Tree;

class Tree
{
    /** @var string $id */
    protected $id;

    /** @var TreeNode $root */
    protected $root;

    public function __construct()
    {
        $this->id   = uniqid('Tree_');
        $this->root = new TreeNode();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return TreeNode
     */
    public function getRoot(): TreeNode
    {
        return $this->root;
    }

    /**
     * @param TreeNode $root
     */
    public function setRoot(TreeNode $root): void
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

        if ($currentNode === null && $count === 0) {
            $currentNode = $this->root;
        }

        if ($currentNode === null) {
            return $count;
        }

        $count++;

        if ($currentNode->getChildren()->count() > 0) {
            $count += $currentNode->getChildren()->count();

            foreach ($currentNode->getChildren() as $node) {
                $currentNode = $node;

                $this->count();
            }
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

        if ($currentNode === null && empty($items)) {
            $currentNode = $this->root;
        }

        if ($currentNode === null) {
            return $items;
        }

        $items[] = $currentNode;

        if ($currentNode->getChildren()->count() > 0) {
            $items += $currentNode->getChildren()->items();

            foreach ($currentNode->getChildren() as $node) {
                $currentNode = $node;

                $this->items();
            }
        }

        return $items;
    }

    /**
     * @param TreeNode $node
     *
     * @return bool
     */
    public function remove(TreeNode $node = null): bool
    {
        $currentNode = $this->root;

        if ($currentNode === $node) {
            /** @var TreeNode $parent */
            $parent = $currentNode->getParent();

            if ($parent === null) {
                return false;
            }

            foreach ($parent->getChildren() as $child) {
                $this->remove($child);
            }
        }

        return true;
    }
}