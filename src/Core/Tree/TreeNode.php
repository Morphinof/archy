<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/05/2018
 * Time: 20:26
 */

namespace Archy\Core\Tree;

use Archy\Core\Collection\Collection;

class TreeNode extends AbstractNode
{
    /** @var Collection $children */
    protected $children;

    public function __construct(Node $parent = null, int $depth = 0, Collection $children = null)
    {
        parent::__construct($parent, $depth);

        $this->parent = $parent;
        $this->depth  = $depth;

        if ($children === null) {
            $this->children = new Collection();
        }
    }

    /**
     * @param Node $parent
     */
    public function setParent(Node $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection $children
     */
    public function setChildren(Collection $children): void
    {
        $this->children = $children;
    }
}