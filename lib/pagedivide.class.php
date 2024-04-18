<?php  

class PageDistribute {
    private $mAllRows;
	private $mPageSize;
	private $mPageOffset;
	private $mPage;
	private $mPageRest;
	private $mTotalGroup;
	private $mCurrentGroup;
	private $mStr;

	function PageDistribute($rLinkUrl="", $rAllRows="", $rPageSize="", $rPageOffset="", $rPage="", $rStr="") {
		$this->mLinkUrl    = $rLinkUrl;
		$this->mAllRows    = $rAllRows;
		$this->mPageSize   = $rPageSize;
		$this->mPageOffset = $rPageOffset;

		if ("" == $rPage) {
		    $this->mPage = 1;
		}else {
		    $this->mPage = $rPage;
		}
		$this->mStr = $rStr;
	} // end func
	
	function CalculatePage()
	{	
		if (0 == $this->mAllRows) {
			$this->mTotalPage = 0;
		}elseif ($this->mAllRows < $this->mPageSize) {
			$this->mTotalPage = 1;
		}elseif (0 == ($this->mPageSize? $this->mAllRows % $this->mPageSize : 0)) {
			$this->mTotalPage = $this->mPageSize?  $this->mAllRows / $this->mPageSize : 0;    
		}else {
		    $this->mTotalPage = (int)($this->mPageSize? $this->mAllRows / $this->mPageSize : 0) + 1;
		}
// page = 10 ;mTotalPage = 100; mPageOffset 10;
		if (0 == $this->mTotalPage) {
			$this->mTotalGroup = 0;
		}elseif ($this->mTotalPage < $this->mPageOffset) {
			$this->mTotalGroup = 1;
		}elseif (0 == ($this->mPageOffset? $this->mTotalPage % $this->mPageOffset : 0)) {
			$this->mTotalGroup = $this->mPageOffset? $this->mTotalPage / $this->mPageOffset : 0;    
		}else {
		    $this->mTotalGroup = (int)($this->mPageOffset? $this->mTotalPage / $this->mPageOffset : 0) + 1;
		}
		$this->mPageRest = $this->mPageOffset? $this->mPage % $this->mPageOffset : 0;
		if (0 != ($this->mPageRest)) {
			$this->mCurrentGroup = (int)($this->mPageOffset? $this->mPage / $this->mPageOffset : 0) + 1;
		}else {
		    $this->mCurrentGroup = $this->mPageOffset? $this->mPage / $this->mPageOffset : 0;
		}
//	echo $this->mPage,",",$this->mTotalPage,",",$this->mTotalGroup,",",$this->mCurrentGroup,",",$this->mPageRest,"<br>";
	
	
	} // end func

	function ShowPageLink()
	{
		$pagelink = "";
		$this->CalculatePage();		
		
		if (0 == $this->mTotalGroup) {
		    	return $pagelink;
		}


		$p1 = (($this->mPage-1) * $this->mPageSize) + 1;
		$p2 = $this->mPage * $this->mPageSize;
		if ($p2 > $this->mAllRows) {
			$p2 = $this->mAllRows;
		}

		$pagelink = "{$p1} - {$p2} of {$this->mAllRows}&nbsp;&nbsp;";
		$LinkPrevious = "";
		if (($this->mCurrentGroup != 1)||($this->mPage == $this->mPageOffset)) {
			$num = $this->mPage - ($this->mPageRest + $this->mPageOffset -1);
		    	$LinkPrevious .= "<a href=\"$this->mLinkUrl?p=$num$this->mStr\"><<</a>";
		}else {
		    	$LinkPrevious .= "<<";
		}
		
		$LinkNext = "";
		if ($this->mCurrentGroup != $this->mTotalGroup) {
			$num = $this->mPage + ($this->mPageOffset - $this->mPageRest + 1);
			$LinkNext .= "<a href=\"$this->mLinkUrl?p=$num$this->mStr\">>></a>";
		}else {
		    $LinkNext .= ">>";
		}
		
		// intial $num;
		$num = 0;
		$LinkBody = "";
		if (1 == $this->mPageRest) {		
			//$LinkBody .= $this->mPage;
			for ($i=0; ($i<$this->mPageOffset)&&($num < $this->mTotalPage); $i++ ) {
				$num	  = $this->mPage + $i; 
				if ($num ==  $this->mPage) {
					$LinkBody .= "<strong>[".$this->mPage."]</strong>&nbsp;";
				}else {
					$LinkBody .= "<a href=\"$this->mLinkUrl?p=$num$this->mStr\">$num</a>&nbsp;";
				}
			}

		}else {
		    for ($i=1; $i<$this->mPageRest; $i++ ) {
		        $num = $this->mPage - $this->mPageRest + $i;
				$LinkBody .= "<a href=\"$this->mLinkUrl?p=$num$this->mStr\">$num</a>&nbsp;";
		    }
			$LinkBody .= "<strong>[".$this->mPage."]</strong>&nbsp;";
			$num = $this->mPage;
			$k = $this->mPageOffset - $this->mPageRest;
			for ($i=1; $i<=$k&&($num < $this->mTotalPage); $i++) {
		        $num = $this->mPage + $i;
				$LinkBody .= "<a href=\"$this->mLinkUrl?p=$num$this->mStr\">$num</a>&nbsp;";
		    }			
		}
		$pagelink = $pagelink.$LinkPrevious.$LinkBody.$LinkNext;
		return $pagelink;
	} // end func
} // end class




//$page = $_GET[p];
//echo "Page= ",$page,"<br>";
//$ext = new PageDistribute("pagedivide.class.php",100,5,5,$page);
//
//echo $ext->ShowPageLink();
//
?>
