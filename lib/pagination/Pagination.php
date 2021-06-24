<?php

namespace Lib\Pagination;

class Pagination
{
    private $currentPage;
    private $numberOfRecords;
    private $numberOfButtons;
    private $dataPerPage;
    private $nextPage;
    private $previousPage;
    private $startIndex;
    private $lastIndex;

    public function __construct($numberOfRecords, $dataPerPage, $numberOfButtons, $currentPage = 0)
    {
        $this->numberOfRecords = $numberOfRecords;
        $this->dataPerPage     = $dataPerPage;
        $this->numberOfButtons = $numberOfButtons;
        $this->currentPage     = $currentPage;
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
        $this->numberOfButtons = ($this->numberOfPager >= $this->numberOfButtons) ? $this->numberOfButtons : $this->numberOfPager;
    }

    private function setCurrentPage()
    {
        $this->currentPage = $this->sanitizeParam($this->currentPage);
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
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

                if ($this->numberOfButtons == 2) {
                    $this->startIndex = $this->currentPage;
                }

                if ($this->numberOfPager - $this->currentPage <= $leftButtons - 1) {
                    $this->startIndex = $this->numberOfPager - ($this->numberOfButtons - 1);
                }
            } else {
                if (
                    $this->currentPage == $this->numberOfButtons
                    &&
                    $this->currentPage < $this->numberOfPager
                ) {
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

    public function getDataPerPage()
    {
        return $this->dataPerPage;
    }

    public function paginator()
    {
        $this->setNumberOfPager();
        $this->setCurrentPage();
        $this->setNumberOfButtons();
        $this->setStartIndex();
        $this->setPreviousPage();
        $this->setNextPage();
        $this->setLastIndex();
    }

    private function sanitizeParam($index)
    {
        return filter_var($index, FILTER_VALIDATE_INT) ?: 1;
    }
}
