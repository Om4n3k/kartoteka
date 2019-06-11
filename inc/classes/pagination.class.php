<?php
class PerPage {
	public $perpage;
	
	function __construct() {
		$this->perpage = 10;
	}
	
	function getAllPageLinks($count,$href) {
		$output = '<ul class="pagination">';
		if(!isset($_GET["page"])) $_GET["page"] = 1;
		if($this->perpage != 0)
			$pages  = ceil($count/$this->perpage);
		if($pages>1) {
			if($_GET["page"] == 1) 
				$output = $output . '<li class="page-item disabled"><a class="page-link" href="#" >&#8810;</a></li><li class="disabled"><a class="page-link" href="#">&#60;</a></li>';
			else	
				$output = $output . '<li class="page-item"><a href="#" class="page-link" onclick="getresult(\'' . $href . (1) . '\')" >&#8810;</a></li><li><a href="#" class="page-link" onclick="getresult(\'' . $href . ($_GET["page"]-1) . '\')" >&#60;</a></li>';
			
			
			if(($_GET["page"]-3)>0) {
				if($_GET["page"] == 1)
					$output = $output . '<li class="page-item active"><a class="page-link" href="#" id="1">1</a></li>';
				else				
					$output = $output . '<li class="page-item"><a class="page-link" href="#" onclick="getresult(\'' . $href . '1\')" >1</a></li>';
			}
			if(($_GET["page"]-3)>1) {
					$output = $output . '<li class="page-item disabled"><a class="page-link" href="#" >...</a></li>';
			}
			
			for($i=($_GET["page"]-2); $i<=($_GET["page"]+2); $i++)	{
				if($i<1) continue;
				if($i>$pages) break;
				if($_GET["page"] == $i)
					$output = $output . '<li class="page-item active"><a class="page-link" href="#" id="'.$i.'">'.$i.'</a></li>';
				else				
					$output = $output . '<li class="page-item"><a href="#" class="page-link" onclick="getresult(\'' . $href . $i . '\')" >'.$i.'</a></li>';
			}
			
			if(($pages-($_GET["page"]+2))>1) {
				$output = $output . '<li class="page-item"><a class="page-link">...</a></li>';
			}
			if(($pages-($_GET["page"]+2))>0) {
				if($_GET["page"] == $pages)
					$output = $output . '<li class="page-item active"><a class="page-link" href="#" id="'.($pages).'">'.($pages).'</a></li>';
				else				
					$output = $output . '<li class="page-item"><a class="page-link" href="#" onclick="getresult(\'' . $href .  ($pages) .'\')" >' . ($pages) .'</a></li>';
			}
			
			if($_GET["page"] < $pages)
				$output = $output . '<li class="page-item"><a href="#" class="page-link" onclick="getresult(\'' . $href . ($_GET["page"]+1) . '\')" >></a></li><li><a href="#" class="page-link" onclick="getresult(\'' . $href . ($pages) . '\')" >&#8811;</a></li>';
			else				
				$output = $output . '<li class="page-item"><a href="#" class="page-link">></a></li><li class="disabled"><a class="page-link" href="#" >&#8811;</a></li>';
			
			
		}
		$output.='</ul>';
		return $output;
	}
	function getPrevNext($count,$href) {
		if(!isset($_GET["page"])) $_GET["page"] = 1;
		if($this->perpage != 0)
			$pages  = ceil($count/$this->perpage);
		if($pages>1) {
			if($_GET["page"] == 1) 
				$output = $output . '<button disabled class="btn btn-primary float-left">Poprzednia</button>';
			else	
				$output = $output . '<button class="btn btn-primary float-left" onclick="getresult(\'' . $href . ($_GET["page"]-1) . '\')" >Poprzednia</button>';			
			
			if($_GET["page"] < $pages)
				$output = $output . '<button class="btn btn-primary float-right" onclick="getresult(\'' . $href . ($_GET["page"]+1) . '\')" >Następna</button>';
			else				
				$output = $output . '<button class="btn btn-primary float-right" disabled>Następna</button>';
			
			
		}
		$output.='</ul>';
		return $output;
	}
}
?>