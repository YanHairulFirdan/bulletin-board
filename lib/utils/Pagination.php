<?php

namespace Lib\Utils;

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

    private function setNextPage()
    {
        $this->data['nextPage'] = ($this->data['currentPage'] != $this->data['numberOfPager']) ? $this->data['currentPage'] + 1 : 0;
    }

    private function setPreviousPage()
    {
        $this->data['previousPage'] = ($this->data['currentPage'] > 1) ? $this->data['currentPage'] - 1 : 0;
    }

    private function setStartIndex()
    {
        $this->data['startIndex'] = 1;

        if ($this->data['numberOfPager'] > 5) {
            if ($this->data['currentPage'] - 2 >= 2) {
                $this->data['startIndex'] = $this->data['currentPage'] - 2;

                if ($this->data['numberOfPager'] - $this->data['currentPage'] <= 1) {
                    $this->data['startIndex'] = $this->data['numberOfPager'] - 4;
                }
            }
        }
    }

    private function setLastIndex()
    {
        $this->data['lastIndex'] = $this->data['numberOfPager'] <= 5 ?: $this->data['startIndex'] + 4;
    }

    public function paginator()
    {
        $this->setStartIndex();
        $this->setPreviousPage();
        $this->setNextPage();
        $this->setLastIndex();
    }

    public function setCurrentPage($currentPage)
    {
        $this->setNumberOfPager($this->data['dataPerPage']);

        $this->data['currentPage'] = (is_array($currentPage)) ? $this->sanitizeParam($currentPage) : $currentPage;
    }

    public function __get($name)
    {
        if (key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    private function sanitizeParam($param)
    {
        if (count($_GET) == 1) {
            $key   = array_key_first($_GET);
            $param = $_GET[$key];

            if (!is_numeric($param)) {
                return 1;
            }
        }

        return $param;
    }
}
