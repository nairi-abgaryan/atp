<?php

namespace App\Service\Pagination;

class PaginatedCollection
{
    /**
     * Array of result items.
     *
     * @var array
     */
    private $items;

    /**
     * Total count of result items.
     *
     * @var int
     */
    private $total;

    /**
     * Count of items in current page.
     *
     * @var int
     */
    private $count;

    /**
     * Links for result meta description.
     *
     * @var array
     */
    private $_links = [];

    /**
     * PaginatedCollection constructor.
     *
     * @param $items
     * @param $total
     */
    public function __construct($items, $total)
    {
        $this->items = $items;
        $this->total = $total;
        $this->count = count($items);
    }

    /**
     * Return array representation of paginated collection.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'items' => $this->items,
            'total' => $this->total,
            'count' => $this->count,
            '_links' => $this->_links,
        ];
    }

    /**
     * Add link to _links array in collection.
     *
     * @param $ref
     * @param $url
     */
    public function addLink($ref, $url)
    {
        $this->_links[$ref] = $url;
    }
}
