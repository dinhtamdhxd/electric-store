<?php
class Pagination{
	
	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 1;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 5;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	private $currentPage			= 1;	// Trang hiện tại
	
	public function __construct($totalItems, $pagination){
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $pagination['totalItemsPerPage'];
		
		if($pagination['pageRange'] %2 == 0) $pagination['pageRange'] = $pagination['pageRange'] + 1;
		
		$this->pageRange			= $pagination['pageRange'];
		$this->currentPage			= $pagination['currentPage'];
		$this->totalPage			= ceil($totalItems/$pagination['totalItemsPerPage']);
	}
	
	public function showPagination(){
		// Pagination
		$paginationHTML = '';


		//Nối đường dẫn
		$arr = [];
		$queryStr = $_SERVER['QUERY_STRING'];
		parse_str($queryStr, $arr);	
		unset($arr['page']);
		$queryString = http_build_query($arr);
		$link = 'index.php?' . $queryString . '&page=';
		
		if($this->totalPage > 1){
			$start 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
			$prev 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fas fa-angle-left"></i></a></li>';
			if ($this->currentPage > 1) {
				$start 	= ' <li class="page-item"><a class="page-link" href="' . $link . '1"><i class="fas fa-angle-double-left"></i></a></li>';
				$prev 	= '<li class="page-item" ><a class="page-link" href="' . $link . ($this->currentPage - 1) . '"><i class="fas fa-angle-left"></i></a></li>';
			}

			$next 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>';
			$end 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>';
			if ($this->currentPage < $this->totalPage) {
				$next 	= ' <li class="page-item"><a class="page-link" href="' . $link . ($this->currentPage + 1) . '"><i class="fas fa-angle-right"></i></a></li>';
				$end 	= '<li class="page-item"><a class="page-link" href="' . $link . ($this->totalPage) . '"><i class="fas fa-angle-double-right"></i></a></li>';
			}
		
			if($this->pageRange < $this->totalPage){
				if($this->currentPage == 1){
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				}else if($this->currentPage == $this->totalPage){
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				}else{
					$startPage		= $this->currentPage - ($this->pageRange-1)/2;
					$endPage		= $this->currentPage + ($this->pageRange-1)/2;
		
					if($startPage < 1){
						$endPage	= $endPage + 1;
						$startPage = 1;
					}
		
					if($endPage > $this->totalPage){
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			}else{
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = "";
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
				} else {
					$listPages .= '<li class="page-item" ><a class="page-link" href="' . $link . $i . '">' . $i . '</a></li>';
				}
			}
			$paginationHTML = '<ul class="pagination pagination-sm m-0 float-right">' . $start . $prev . $listPages . $next . $end . '</ul>';
		}
		return $paginationHTML;
	}
}