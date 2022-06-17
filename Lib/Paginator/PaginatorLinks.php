<?php

namespace Src\Lib\Paginator;

use Src\Lib\Paginator\Interfaces\IPaginatorLinks;

class PaginatorLinks implements IPaginatorLinks {

    private $count = 10;

    private $perPage = 2;

    private $currentPage = 3;

    private $viewsLength = 3;

    public function setCount(int $count)
    {
        $this->count = $count;
    }

    public function setPerPage(int $perPage)
    {
        $this->perPage = $perPage;
    }

    public function setCurrentPage(int $currentPage)
    {
        $this->currentPage = $currentPage;
    }

    public function setViewsLength(int $length)
    {
        $this->viewsLength = $length;
    }

    /**
     * Возвращает массив следующего вида:
     * [first] => int номер первой страницы
     * [previous] => int номер предыдущей страницы
     * [pages] => int[] массив с отображаемыми номерами страниц
     * [next] => int номер следующей страницы
     * [last] => int номер последней страницы
     */
    public function pagesLinks()
    {
        $result['first'] = 1;
        $result['previous'] = $this->getPrevious();
        $result['pages'] = $this->getPages();
        $result['next'] = $this->getNext();
        $result['last'] = $this->getLast();
        return $result;
    }

    public function getFirst()
    {
        return 1;
    }

    public function getPrevious()
    {
        $previous = $this->currentPage - 1;
        return ($previous < 1) ? $this->getLast() : $previous;
    }

    public function getNext()
    {
        $next = $this->currentPage + 1;
        return ($next > $this->getLast()) ? 1 : $next;
    }

    public function getLast()
    {
        return ceil($this->count / $this->perPage);
    }

    public function getPages()
    {
        $result = [];

        if($this->viewsLength * $this->perPage > $this->count){
            $this->viewsLength = ceil($this->count / $this->perPage);
        }

        $p = floor($this->viewsLength / 2);
        if($this->currentPage - $p <= 0){
            $from = 1;
        }else{
            $from = $this->currentPage - $p;
        }

        $to = $from + $this->viewsLength - 1;
        if($to > ceil($this->count / $this->perPage)){
            $to = ceil($this->count / $this->perPage);
            $from = $to - $this->viewsLength + 1;
        }

        for ($i = $from; $i <= $to; $i++){
            $result[] = $i;
        }

        return $result;
    }

}