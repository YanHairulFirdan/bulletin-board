<?php
class Pagination  
{
    private $model, $startIndex, $currentPage, $nextPage, $previousPage, $pager, $dataPerPage;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function paginator()
    {
        $numberOfRecords               = $this->model->numberOfRecord();
        $numberOfPager                 = floor($numberOfRecords / $this->model->dataPerPage);
        $numberOfPager                += ($numberOfRecords % $this->model->dataPerPage > 0) ? 1 : 0;
        $this->currentPage             = (isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 1;
        $this->nextPage                = ($this->currentPage != $numberOfPager) ? $this->currentPage + 1 : 0;
        $this->previousPage            = ($this->currentPage > 1) ? $this->currentPage -  1 : 0;
        $this->pager                   = 5;

        if ($numberOfPager <= 5) {
            $this->startIndex     = 1;
            $this->pager          = $numberOfPager;
        } else if ($numberOfPager > 5) {
            $difference     = $numberOfPager - $this->pager;
            $this->startIndex     = ($this->currentPage < $difference + 1) ? $this->currentPage : $difference + 1;
            $pagerButton    = $this->startIndex + $this->pager;

            if ($this->startIndex == 5) {
                $this->startIndex     = 3;
                $pagerButton    = 8;
            }
        }

        return [
            $this->currentPage, $this->startIndex, $this->previousPage, $this->nextPage, $pagerButton
        ];
    }
}
