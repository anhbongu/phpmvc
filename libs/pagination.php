<?php 
	class Pagination{
		public $totalItem 					;	//tổng số dòng record
		private $totalItemPerpage			;	//tổng số phần tử trên 1 trang
		private $totalPage 					;	//tổng số trang
		private $pageRange					;	//tổng số listpage muốn hiển thị
		private $currentPage				;	//trang hiện tại	


		public function __construct($totalItem, $totalItemPerpage, $currentPage, $pageRange){
			$this->totalItem 		=	$totalItem;
			$this->totalItemPerpage	= 	$totalItemPerpage;
			$this->totalPage 		=	ceil($this->totalItem/$this->totalItemPerpage);
			$this->currentPage		= 	$currentPage;

			if($pageRange %2 == 0) $pageRange = $pageRange + 1;	
			$this->pageRange			= $pageRange;
		}
		

		public function ShowPagination(){




			//PHÂN TRANG
			$start = '<div class="button2-right"><div class="start"><span>Start</span></div></div>';
			$previous = '<div class="button2-right"><div class="prev"><span>Prev</span></div></div>';	
			$next = '<div class="button2-left"><div class="prev"><span>Next</span></div></div>';
			$end = '<div class="button2-left"><div class="prev"><span>End</span></div></div>';


			//NẾU TRANG HIỆN TAI LỚN HƠN 1 THÌ KHÔNG XUẤT HIỆN NÚT START VÀ PRIVIOUS
			if($this->currentPage > 1){
				$start = '<div class="button2-right"><div class="start"><span><a href="#" onclick=javascript:changePage(1)>Start</a></span></div></div>';
				$previous = '<div class="button2-right"><div class="prev"><span><a onclick=javascript:changePage('.($this->currentPage - 1).') href="#">Prev</a></span></div></div>';
			}
			//NẾU TRANG HIỆN TẠI >= TRANG CUỐI CÙNG THÌ KO XUẤT HIỆN  NÚT NEXT VÀ END
			if($this->currentPage < $this->totalPage){
	
				$next = '<div class="button2-left"><div class="next"><a onclick=javascript:changePage('.($this->currentPage + 1).') href="#">Next</a></div></div>';

				$end = '<div class="button2-left"><div class="next"><a onclick=javascript:changePage('.($this->totalPage).') href="#">End</a></div></div>';


			}



			//NẾU TRANG ĐÀU TIÊN LÀ 1 THÌ: 1 2 3
			//NẾU TRANG ĐÀU TIÊN LÀ 2 THÌ: 2 3 4
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


			$listPage 	= ' <div class="button2-left"><div class="page">';
			for($i=$startPage; $i<=$endPage; $i++){
				if($i == $this->currentPage){
					$listPage .= '<span>'.$i.'</span>';
				}else{
					$listPage .= '<a onclick=javascript:changePage('.$i.') href="#">'.$i.'</a>';
				}
				
			}
			$listPage 	.= '</div></div>';
 


			$endPagination = '<div class="limit">Page '.$this->currentPage.' of '.$this->totalPage.'</>';

			return $pagination = $start.$previous.$listPage.$next.$end.$endPagination;



		}
	}

 ?>