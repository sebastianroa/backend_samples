<?php
/*============================================================================================
										PageNav Class
					Navigate through the different search by using the pageNav class
					The number clicked on will guide to those respected search results
					Arrows will jumps x amount of numbers
//1 Set variables that will be placed on the navigation
//2 Set variables that will output HTML
//3 Set variables that will form the query when a button is clicked
//4 Set variables that will hold CSS names
//5 Set variables that will hold text for navigation
//6 Call the constructor
//7 checkRecordOffset will pass var to constructor telling which number the navigator is currently at
//8 setTotalPages - gives you total amount of pages
//9 calculateCurrentPage - what page your currently on
//10 create inactiveSpan - will eliminate unnecessary span tags
//11 calculateCurrentStart - tells page where to begin
//12 calculateEndPage - dictates where nav btn num shall end
//13 getNavBar - prints the navigation bar onto screen
//14 createLink - provides the link to guide the user to more content
//15 set some of the variables depending on the content

============================================================================================*/
//1
class pageNav{
	private $pagename;
	private $totalpages;
	private $recordsperpage;
	private $maxpagesshown;
	private $currentstartpage;
	private $currentendpage;
	private $currentpage;
	//2 Hold HTML that will be delivered on nav
	private $spannextinactive;
	private $spanpreviousinactive;
  
	private $firstinactivespan;
	private $lastinactivespan;
	//3
	private $firstparamname = "offset";
     
	private $params;	
	//4
	private $divwrappername = "navigator";
	private $pagedisplaydivname = "totalpagesdisplay";
	private $inactivespanname = "inactive";
	//5
	private $strfirst = "|<";
	private $strnext = "Next";
	private $strprevious = "Prev";
	private $strlast = ">|";
	private $errorstring;
	//6
	public function __construct($pagename, $totalrecords, $recordsperpage,
     		$recordoffset, $maxpagesshown = 4, $params = "") {
		$this->pagename = $pagename;
		$this->recordsperpage = $recordsperpage;
		$this->maxpagesshown = $maxpagesshown;
		$this->params = $params;
		$this->checkRecordOffset($recordoffset, $recordsperpage) or
          	die($this->errorstring);
		$this->setTotalPages($totalrecords, $recordsperpage);
     		$this->calculateCurrentPage($recordoffset, $recordsperpage);
		$this->createInactiveSpans();
     		$this->calculateCurrentStartPage();
		$this->calculateCurrentEndPage();
	}
	//7
        private function checkRecordOffset($recordoffset, $recordsperpage){
    		$bln = true;
	     	if($recordoffset%$recordsperpage != 0){
			$this->errorstring = "Error - not a multiple of records per page.";
               		$bln = false;
    		}
	     	return $bln;
        }
	//8
	private function setTotalPages($totalrecords, $recordsperpage){
          $this->totalpages = ceil($totalrecords/$recordsperpage);
     }
	//9
	private function calculateCurrentPage($recordoffset, $recordsperpage){
        $this->currentpage = $recordoffset/$recordsperpage;
     }
     //10
	private function createInactiveSpans(){
       		$this->spannextinactive = "<span class=\"".
			"$this->inactivespanname\">$this->strnext</span>\n";
		$this->lastinactivespan = "<span class=\"".
			"$this->inactivespanname\">$this->strlast</span>\n";
		$this->spanpreviousinactive = "<span class=\"".
			"$this->inactivespanname\">$this->strprevious</span>\n";
		$this->firstinactivespan = "<span class=\"".
			"$this->inactivespanname\">$this->strfirst</span>\n";
     }
    //11
     private function calculateCurrentStartPage(){
       		$temp = floor($this->currentpage/$this->maxpagesshown);
       		$this->currentstartpage = $temp * $this->maxpagesshown;
     }
    //12
     private function calculateCurrentEndPage(){
	     $this->currentendpage = $this->currentstartpage + $this->maxpagesshown;
	     if($this->currentendpage > $this->totalpages){
             	$this->currentendpage = $this->totalpages;
          }
     }
    //13
    public function getNavigator() {
	    $strnavigator = "<div class=\"$this->divwrappername\">\n";
	    //move first btn
	    if($this->currentpage == 0){
          	$strnavigator .= $this->firstinactivespan;
	    }else{
          	$strnavigator .= $this->createLink(0,  $this->strfirst);
       	    }
    }
   //14
   private function createLink($offsetj, $strdisplay ){
        $strtemp =  "<a href=\"$this->pagename?$this->firstparamname=";
        $strtemp .= $offset;
        $strtemp .= "$this->params\">$strdisplay</a>\n";
        return $strtemp;
     
   //15
    if($this->currentpage == 0){
             $strnavigator .= $this->spanpreviousinactive;
         }else{
             $strnavigator .= $this->createLink($this->currentpage-1,  $this->strprevious);
         }
     for($x = $this->currentstartpage; $x < $this->currentendpage; $x++){
          if($x == $this->currentpage){
              $strnavigator .= "<span class=\"$this->inactivespanname\">";
              $strnavigator .= $x + 1;
              $strnavigator .= "</span>\n";
          }else{
              $strnavigator .= $this->createLink($x, $x+1);
          }
      }
     //16
     if($this->currentpage == $this->totalpages-1){
        $strnavigator .= $this->spannextinactive;
     }else{
        $strnavigator .= $this->createLink($this->currentpage + 1, $this->strnext);
     }
     //move last button
     if($this->currentpage == $this->totalpages-1){
        $strnavigator .= $this->lastinactivespan;
     }else{
        $strnavigator .= $this->createLink($this->totalpages -1, $this->strlast);
     }
      $strnavigator .= "</div>\n";
     $strnavigator .= $this->getPageNumberDisplay();
     return $strnavigator;
     $str = "<div class=\"$this->pagedisplaydivname\">\nPage ";
     $str .= $this->currentpage + 1;
     $str .= " of $this->totalpages";
     $str .= "</div>\n"; return $str;
   }
}
?>