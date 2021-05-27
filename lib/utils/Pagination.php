<?php

namespace App\Utils;

class Pagination
{
    private $data = [];

    public function __construct($numberOfRecords, $dataPerPage = 10)
    {
        $this->data['numberOfRecords'] = $numberOfRecords;
        $this->data['dataPerPage']     = $dataPerPage;
    }

    private function setNumberOfPager()
    {
        $this->data['numberOfPager']  = floor($this->data['numberOfRecords'] / $this->data['dataPerPage']);
        $this->data['numberOfPager'] += ($this->data['numberOfRecords'] % $this->data['dataPerPage'] > 0) ? 1 : 0;
    }

    private function setCurrentPage()
    {
        $this->data['currentPage'] = (isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 1;
    }

    private function setNextPage()
    {
        $this->data['nextPage'] = ($this->data['currentPage'] != $this->data['numberOfPager']) ? $this->data['currentPage'] + 1 : 0;
    }

    private function setPreviousPage()
    {
        $this->data['previousPage'] = ($this->data['currentPage'] > 1) ? $this->data['currentPage'] -  1 : 0;
    }

    private function setStartIndex()
    {
        $this->data['startIndex'] = 1;

        if ($this->data['numberOfPager'] > 5) {
            if ($this->data['currentPage'] - 2 >= 2) {
                $this->data['startIndex'] = $this->data['currentPage'] - 2;

                if ($this->data['currentPage'] == $this->data['numberOfPager']) {
                    $this->data['startIndex'] = $this->data['currentPage'] - 4;
                } elseif ($this->data['currentPage'] + 1 == $this->data['numberOfPager']) {
                    $this->data['startIndex'] = $this->data['currentPage'] - 3;
                }
            }
        }
    }

    private function setLastIndex()
    {
        $this->data['lastIndex'] = $this->data['numberOfPager'];

        if ($this->data['numberOfPager'] > 5) {
            if (empty($_GET) || $this->data['currentPage'] === 1) {
                $this->data['lastIndex'] = 5;
            }

            if (
                ($this->data['currentPage'] > 2)
                &&
                ($this->data['numberOfPager'] - $this->data['currentPage'] >= 2)
            ) {
                $this->data['lastIndex'] = $this->data['currentPage'] + 2;
            }
        }
    }

    public function paginator()
    {
        $this->setNumberOfPager(10);
        $this->setCurrentPage();
        $this->setStartIndex();
        $this->setPreviousPage();
        $this->setNextPage();
        $this->setLastIndex();
    }

    public function __get($name)
    {
        if (key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }
}
