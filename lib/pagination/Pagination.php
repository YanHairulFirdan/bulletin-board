<?php

namespace Lib\Pagination;

class Pagination
{
    private $data = [];
    private $currentPage;
    private $numberOfRecords;
    private $numberOfButtons;
    private $dataPerPage;
    private $nextPage;
    private $previousPage;
    private $startIndex;
    private $lastIndex;

    public function __construct($numberOfRecords, $dataPerPage, $numberOfButtons)
    {
        $this->numberOfRecords = $numberOfRecords;
        $this->dataPerPage     = $dataPerPage;
        $this->numberOfButtons = $numberOfButtons;
    }

    private function setNumberOfPager()
    {
        $this->numberOfPager = ceil($this->numberOfRecords / $this->dataPerPage);
    }
    
    public function getNumberOfPager()
    {
        return $this->numberOfPager;
    }

    private function setNumberOfButtons()
    {
        $this->numberOfButtons  = ($this->numberOfPager >= $this->numberOfButtons) ? $this->numberOfButtons : $this->numberOfPager;
    }

    private function setNextPage()
    {
        $this->nextPage = ($this->currentPage != $this->numberOfPager) ? $this->currentPage + 1 : 0;
    }
    
    public function getNextPage()
    {
        return $this->nextPage;
    }

    private function setPreviousPage()
    {
        $this->previousPage = ($this->currentPage > 1) ? $this->currentPage - 1 : 0;
    }
    
    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    private function setStartIndex()
    {
        $this->startIndex = 1;

        $leftButtons = floor($this->numberOfButtons / 2);

        if ($this->numberOfPager >= $this->numberOfButtons) {
            if (($this->currentPage - $leftButtons) > 1) {
                $this->startIndex = $this->currentPage - $leftButtons;

                if ($this->numberOfPager - $this->currentPage <= $leftButtons - 1) {
                    $this->startIndex = $this->numberOfPager - ($this->numberOfButtons - 1);
                }
            } else {
                if ($this->currentPage == $this->numberOfButtons && $this->currentPage < $this->numberOfPager) {
                    $this->startIndex = $this->currentPage;
                }
            }
        }
    }

    public function getStartIndex()
    {
        return $this->startIndex;
    }

    private function setLastIndex()
    {
        $this->lastIndex = $this->startIndex + ($this->numberOfButtons - 1);
    }
    
    public function getLastIndex()
    {
        return $this->lastIndex;
    }
    
    public function setCurrentPage($currentPage)
    {
        $this->setNumberOfPager($this->dataPerPage);
        
        $this->currentPage = (is_array($currentPage)) ? $this->sanitizeParam($currentPage) : $currentPage;
    }
    
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getDataPerPage()
    {
        return $this->dataPerPage;
    }
    public function paginator()
    {
        $this->setNumberOfButtons();
        $this->setStartIndex();
        $this->setPreviousPage();
        $this->setNextPage();
        $this->setLastIndex();
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
