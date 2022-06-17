<?php

namespace Src\Lib\Paginator\Interfaces;

interface IPaginatorLinks {
    public function setCount(int $count);
    public function setPerPage(int $perPage);
    public function setCurrentPage(int $currentPage);
    public function setViewsLength(int $length);
    public function pagesLinks();
    public function getFirst();
    public function getPrevious();
    public function getNext();
    public function getLast();
    public function getPages();
}