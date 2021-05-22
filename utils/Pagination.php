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

    private function setNumberOfButton()
    {
        $this->data['numberOfButton'] = ($this->data['numberOfPager'] > 5) ? 5 : $this->data['numberOfPager'];

        if ($this->data['numberOfPager'] <= 5) {
            $this->data['numberOfButton'] = $this->data['numberOfPager'];
        } elseif ($this->data['numberOfPager'] > 5) {
            if ($this->data['numberOfPager'] - $this->data['currentPage'] <= 2) {
                $this->data['numberOfButton'] = $this->data['numberOfPager'];
            } else {
                $this->data['numberOfButton'] = ($this->data['currentPage'] <= 2) ? 5 : $this->data['currentPage'] + 2;
            }
        }
    }

    private function setStartIndex()
    {
        if ($this->data['numberOfPager'] <= 5) {
            $this->data['startIndex'] = 1;
        } elseif ($this->data['numberOfPager'] > 5) {
            if ($this->data['currentPage'] - 2 >= 2) {

                if ($this->data['currentPage'] == $this->data['numberOfPager']) {
                    $this->data['startIndex'] = $this->data['currentPage'] - 4;
                } else {
                    $this->data['startIndex'] = $this->data['currentPage'] - 2;
                }
            } else {
                $this->data['startIndex'] = 1;
            }
        }
    }

    private function setLastIndex()
    {
        if ($this->data['numberOfPager'] <= 5) {
            $this->data['lastIndex'] = $this->data['numberOfPager'];
        } elseif ($this->data['numberOfPager'] > 5) {
            if ($this->data['numberOfPager'] - $this->data['currentPage'] <= 4) {
                $this->data['lastIndex'] = $this->data['numberOfPager'];
            } else {
                if ($this->data['currentPage'] > 2) {
                    $this->data['lastIndex'] = $this->data['currentPage'] + 2;
                } else {
                    $this->data['lastIndex'] = 5;
                }
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
        $this->setNumberOfButton();
    }
    public function __get($name)
    {
        if (key_exists($name, $this->data)) {
        }
        return $this->data[$name];
    }
}
