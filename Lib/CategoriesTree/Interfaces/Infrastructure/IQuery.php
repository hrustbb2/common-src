<?php

namespace Src\Lib\CategoriesTree\Interfaces\Infrastructure;

use Src\Common\Interfaces\Infrastructure\IQueryBase;

interface IQuery extends IQueryBase {
    /**
     * @return $this
     */
    public function select(array $fields);

    /**
     * @return $this
     */
    public function whereId($id);

    /**
     * @return $this
     */
    public function whereIdIn(array $ids);

    /**
     * @return $this
     */
    public function whereParentId($parentId);

    /**
     * @return $this
     */
    public function whereInPath(string $matherialPath);

    /**
     * @return $this
     */
    public function withParent(array $fields);
}