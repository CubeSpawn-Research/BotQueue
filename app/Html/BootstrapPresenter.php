<?php
/*
	This file is part of BotQueue.

	BotQueue is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	BotQueue is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with BotQueue.  If not, see <http://www.gnu.org/licenses/>.
  */


namespace App\Html;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Presenter;

class BootstrapPresenter implements Presenter
{
    protected $paginator;

    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Render the given paginator.
     *
     * @return string
     */
    public function render()
    {
        if(!$this->hasPages())
            return '';

        return '<div class="pagination">'.
                    '<ul>'.
                        $this->getPreviousLink().
                        $this->getPages().
                        $this->getNextLink().
                    '</ul>'.
                '</div>';
    }

    /**
     * Determine if the underlying paginator being presented has pages to show.
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages();
    }

    protected function current()
    {
        return $this->paginator->currentPage();
    }

    protected function relativePageUrl($relative)
    {
        return $this->paginator->url($this->current() + $relative);
    }

    private function getPreviousLink()
    {
        if($this->current() <= 1)
            return '';

        return '<li><a href="'.$this->paginator->previousPageUrl().'">&laquo; prev</a></li>';
    }

    private function getNextLink()
    {
        if(!$this->paginator->hasMorePages())
            return '';

        return '<li><a href="'.$this->paginator->nextPageUrl().'">next &raquo;</a></li>';
    }

    private function getPages()
    {
        $start = max($this->current() - 4, 1);
        $end   = min($this->current() + 4, $this->pageCount());
        $result = '';

        for($index = $start; $index <= $end; $index++) {
            if($index == $this->current())
                $page = '<li class="active">';
            else
                $page = '<li>';

            $page   .= '<a href="'.$this->paginator->url($index).'">'.$index.'</a></li>';
            $result .= $page;
        }

        return $result;
    }

    private function pageCount()
    {
        return $this->paginator->lastPage();
    }
}