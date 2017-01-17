<?php
/**
 * set the current class of page indicator to active if it equal on requested page
 * @param  integer  $page_nav item_index
 * @param  integer $page     requested_page
 * @return string            add active class
 */
function page_indicator($page_nav,$page=1){
		echo $indi=$page_nav==$page?"active":''; 
}

/**
 * set next page and prevent next page to set out of page boundery
 * @param  integer $page       total number of pages
 * @param  integer $data_pages page value
 * @return integer             return the next allowed page
 */
function page_next($page,$data_pages){
		/**
		 * pages
		 * @var $page_nav
		 */
		$page_nav=($page+1);

       $next=$page_nav<=$data_pages?$page_nav:$data_pages;
       echo $z=$next>=1?$next:1;
} 

	
/**
 * set previous page
 * @param  integer $page       total number of pages
 * @param  integer $data_pages page value
 * @return integer             return the previous allowed page
 */
function page_previous($page,$data_pages){
    	$page_nav=($page-1);
    	echo $prev=$page_nav>0?$page_nav:1;
} 


?>