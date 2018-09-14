<?php

namespace App;

/**
 * Class Pagination
 * @package App
 */
class Pagination
{

    /**
     * @var Amount of links of page navigation
     * 
     */
    private $max = 10;

    /**
     * @var Key for GET in which added page number
     * 
     */
    private $index = 'page_number';

    /**
     * @var Current Page
     * 
     */
    private $current_page;

    /**
     * 
     * @var Total amount of tasks
     * 
     */
    private $total;

    /**
     * 
     * @var Tasks per page
     * 
     */
    private $limit;

    /**
     * Necessary launch for navigation
     * @param integer $total - total amount of tasks
     * @param integer $limit - tasks per page
     * 
     * @return
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        $this->total = $total;

        $this->limit = $limit;

        $this->index = $index;

        $this->amount = $this->amount();

        $this->setCurrentPage($currentPage);
    }

    /**
     *  For links display
     * 
     * @return HTML-code with navigation links
     */
    public function get()
    {
        $links = null;

        $limits = $this->limits();

        $html = '<ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)) {
            if ($this->current_page > 1)
                $links = $this->generateHtml(1, '&lt;') . $links;

            if ($this->current_page < $this->amount)
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';

        return $html;
    }

    /**
	 * To generate HTML-code link
     * @param integer $page - page number
     * 
     * @return string
     */
    private function generateHtml($page, $text = null)
    {
        if (!$text){
			$text = $page;
		}

		$currentURI = Router::generateFilterHtml('~\?page_number=[0-9]+|&page_number=[0-9]+~');
        return '<li><a href="' . $currentURI . $this->index .'='. $page . '">' . $text . '</a></li>';
    }

    /**
	 * To obtain the start point
     * 
     * @return array with start and end countdown
     */
    private function limits()
    {
        $left = $this->current_page - round($this->max / 2);

        $start = $left > 0 ? $left : 1;

        if ($start + $this->max <= $this->amount)
            $end = $start > 1 ? $start + $this->max : $this->max;
        else {
            $end = $this->amount;

            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return array($start, $end);
    }

	/**
	 * For current page setting
	 *
	 * @param $currentPage
	 */
    private function setCurrentPage($currentPage)
    {
        $this->current_page = $currentPage;

        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount)
                $this->current_page = $this->amount;
        } else
            $this->current_page = 1;
    }

    /**
     * For obtaining total amount of pages
     * 
     * @return amount of pages
     */
    private function amount()
    {
        return ceil($this->total / $this->limit);
    }

}
