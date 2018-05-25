<?php
/**
 * Created by PhpStorm.
 * User: Morphinof
 * Date: 25/05/2018
 * Time: 19:54
 */

namespace Archy\Core\Tree;

class Node extends AbstractNode
{
    /** @var Node $children */
    protected $child;

    public function __construct(Node $parent = null, int $depth = 0, Node $child = null)
    {
        parent::__construct($parent, $depth);

        $this->child = $child;
    }

    /**
     * @return Node
     */
    public function getChild(): Node
    {
        return $this->child;
    }

    /**
     * @param Node $child
     */
    public function setChild(Node $child): void
    {
        $this->child = $child;
    }
}