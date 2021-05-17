<?php
class Pagination
{

    private $data = [];
    private $model, $startIndex, $currentPage, $nextPage, $previousPage, $pager, $dataPerPage, $numRows, $numberOfPager, $lastIndex;
    public function __construct($numberOfRecords, $dataPerPage = 10)
    {
        $this->data['numberOfRecords'] = $numberOfRecords;
        $this->data['dataPerPage'] = $dataPerPage;
    }

    private function setNumberOfPager()
    {
        $this->data['numberOfPager'] = floor($this->data['numberOfRecords'] / $this->data['dataPerPage']);
        // $this->numberOfPager = floor($this->numberOfRecords / $this->dataPerPage);
    }

    private function setCurrentPage()
    {
        $this->data['currentPage'] = (isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 1;
        // $this->currentPage = (isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 1;
    }

    private function setNextPage()
    {
        $this->data['nextPage'] = ($this->data['currentPage'] != $this->data['numberOfPager']) ? $this->data['currentPage'] + 1 : 0;
        // $this->nextPage = ($this->currentPage != $this->numberOfPager) ? $this->currentPage + 1 : 0;
    }

    private function setPreviousPage()
    {
        $this->data['previousPage'] = ($this->data['currentPage'] > 1) ? $this->data['currentPage'] -  1 : 0;

        // $this->previousPage = ($this->currentPage > 1) ? $this->currentPage -  1 : 0;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    private function setNumberOfButton()
    {
        $this->data['numberOfButton'] = ($this->data['numberOfPager'] > 5) ? 5 : $this->data['numberOfPager'];
        // $this->pager = ($this->numberOfPager > 5) ? 5 : $this->numberOfPager;
    }

    private function setStartIndex()
    {
        if ($this->numberOfPager <= 5) {
            // $this->startIndex = 1;
            $this->data['startIndex'] = 1;
        } elseif ($this->numberOfPager > 5) {
            // $this->startIndex = ($this->currentPage - 2 >= 2) ? $this->currentPage - 2 : 1;
            $this->data['startIndex'] = ($this->currentPage - 2 >= 2) ? $this->currentPage - 2 : 1;

            if ($this->data['numberOfPager'] - $this->data['currentPage'] <= 2) {
                // $this->startIndex = ($this->numberOfPager - $this->currentPage == 0) ? $this->currentPage - 4 : $this->currentPage - 3;
                $this->data['startIndex'] = ($this->data['numberOfPager'] - $this->data['currentPage'] == 0) ? $this->data['currentPage'] - 4 : $this->data['currentPage'] - 3;
            }
        }
    }

    private function setLastIndex()
    {
        // $this->data['lastIndex'];
        if ($this->data['numberOfPager'] <= 5) {
            $this->data['lastIndex'] = $this->data['numberOfPager'];
        } elseif ($this->data['numberOfPager'] > 5) {
            if ($this->data['numberOfPager'] - $this->data['currentPage'] <= 2) {
                $this->data['lastIndex'] = $this->data['numberOfPager'];
                // $this->data['lastIndex'] = $this->data['numberOfPager'];
            } else {
                // $this->data['lastIndex'] = ($this->data['currentPage'] <= 2) ? 5 : $this->data['currentPage'] + 2;
                $this->data['lastIndex'] = ($this->data['currentPage'] <= 2) ? 5 : $this->data['currentPage'] + 2;
            }
        }
    }

    public function paginator()
    {
        $this->setNumberOfPager(10);
        $this->setCurrentPage();
        $this->setNextPage();
        $this->setPreviousPage();
        $this->setNumberOfButton();
        $this->setStartIndex();
        $this->setLastIndex();
    }
}
