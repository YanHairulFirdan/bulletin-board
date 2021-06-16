<?php

namespace Lib\Pagination;

class Paginator
{
    private $data = [];

    public function __construct($numberOfRecords, $dataPerPage, $numberOfButtons, $index)
    {
        $this->data['numberOfRecords'] = $numberOfRecords;
        $this->data['dataPerPage']     = $dataPerPage;
        $this->data['numberOfButtons'] = $numberOfButtons;
        $this->data['url'] = '?' . $index . '=';
    }

    private function setNumberOfPager()
    {
        $this->data['numberOfPager']  = ceil($this->data['numberOfRecords'] / $this->data['dataPerPage']);
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

        $leftButtons = floor($this->data['numberOfButtons'] / 2);

        if ($this->data['numberOfPager'] > $this->data['numberOfButtons']) {

            if ($this->data['currentPage'] - $leftButtons > 1) {
                $this->data['startIndex'] = $this->data['currentPage'] - $leftButtons;

                if ($this->data['numberOfPager'] - $this->data['currentPage'] <= $leftButtons - 1) {
                    $this->data['startIndex'] = $this->data['numberOfPager'] - ($this->data['numberOfButtons'] - 1);
                }
            }
        }
    }

    private function setLastIndex()
    {
        $this->data['lastIndex'] = $this->data['startIndex'] + ($this->data['numberOfButtons'] - 1);
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

    public function previousPageURL()
    {
        return $this->data['url'] . $this->data['previousPage'];
    }

    public function nextPageURL()
    {
        return $this->data['url'] . $this->data['nextPage'];
    }

    public function genearetURL($index)
    {
        return $this->data['url'] . $index;
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
