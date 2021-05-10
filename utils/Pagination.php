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

        echo $this->currentPage;

        if ($numberOfPager <= 5) {
            $this->startIndex       = 1;
            $this->pager            = $numberOfPager;
        } else if ($numberOfPager > 5) {
            $this->startIndex       = ($this->currentPage - 2 >= 2) ? $this->currentPage - 2 : 1;
            if ($numberOfPager - $this->currentPage <= 2) {
                $pagerButton        = $numberOfPager;
                $this->startIndex   = ($numberOfPager - $this->currentPage == 0) ? $this->currentPage - 4 : $this->currentPage - 3;
            } else {

                $pagerButton        = ($this->currentPage <= 2) ? 5 : $this->currentPage + 2;
            }
        }

        // echo "<pre>";
        // print_r([
        //     $this->currentPage,
        //     $this->startIndex,
        //     $this->previousPage,
        //     $this->nextPage,
        //     $pagerButton
        // ]);
        // echo "</pre>";
        // die;
        return [
            $this->currentPage,
            $this->startIndex,
            $this->previousPage,
            $this->nextPage,
            $pagerButton
        ];
    }
}
