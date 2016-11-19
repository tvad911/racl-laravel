<?php
namespace App\Helpers\Paging;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginationLinks extends LengthAwarePaginator {

    public function render($view = null)
    {
        if ($this->hasPages())
        {
            return sprintf(
                '%s %s %s %s %s',
                $this->getFirst(),
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton(),
                $this->getLast()
            );
        }

        return '';
    }

    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        return '<li><a href="'.htmlentities($url).'"'.$rel.'>'.$page.'</a></li>';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<li class="disabled"><span>'.$text.'</span></li>';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li class="active"><span>'.$text.'</span></li>';
    }

    /**
     * Get a pagination "dot" element.
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper("...");
    }

    public function getFirst($text = '&laquo;')
    {
        if ($this->currentPage() <= 1)
        {
            return $this->getDisabledTextWrapper($text);
        }
        else
        {
            $url = $this->paginator->url(1);
            return $this->getPageLinkWrapper($url, $text);
        }
    }

    public function getLast($text = '&raquo;')
    {
        if ($this->currentPage() >= $this->lastPage())
        {
            return $this->getDisabledTextWrapper($text);
        }
        else
        {
            $url = $this->paginator->url($this->lastPage());

            return $this->getPageLinkWrapper($url, $text);
        }
    }

    public function itemNumber($text = 'Items %s to %s of %s
        total')
    {
        if($this->paginator->total() == 0)
        {
            if($this->currentPage() !=1)
            {
                $from = 0;
            }else{
                $from = 0;
            }
            $to = $this->paginator->currentPage() * $this->paginator->perPage();
            if($to > $this->paginator->total())
            {
                $to = $this->paginator->total();
            }
            $total = $this->paginator->total();
            return sprintf($text,$from,$to,$total);
        }
        else
        {
            if($this->currentPage() !=1)
            {
                $from = ($this->paginator->currentPage() - 1) * $this->paginator->perPage() + 1;
            }else{
                $from = 1;
            }
            $to = $this->paginator->currentPage() * $this->paginator->perPage();
            if($to > $this->paginator->total())
            {
                $to = $this->paginator->total();
            }
            $total = $this->paginator->total();
            return sprintf($text,$from,$to,$total);
        }

    }
}