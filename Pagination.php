<?php
/** Andrey Shtarev | www.shtarev.com | 18.05.2020
* Pagination for Bootstrap v4.4.1
* $Pagination = new Pagination(quantity of content, quantity of buttons, 'MySql-request');
* $Pagination->inhalt; // content array
* $Pagination->pagipunct(); // pagination buttons
*/

class Pagination
{
	public $elem = '';
	public $pagPunkt = '';
	public $pagination = array();
	public $end = '';
	public $start = 0;
	public $startja = '';
	public $startnein = '';
	public $endja = '';
	public $endnein = '';
	public $key = 0;
	public $pagi = array();
	public $inhalt = array();

	function __construct($elem, $pagPunkt, $requestResult) {
		$this->elem = $elem;
		$this->pagPunkt = $pagPunkt;
		$this->pagination = array_chunk($requestResult, $elem);
		$this->end = count($this->pagination)-1;
		if(isset($_GET['key'])) { $this->key = $_GET['key']; }
		$this->inhalt = $this->pagination[$this->key];
	}
	
	public function paginati() {
		if($this->key < $this->pagPunkt-1 || $this->pagPunkt == $this->end+1){

			if($this->pagPunkt > $this->end) {
				$this->startja = 'none'; 
				$this->startnein = '';
				$this->endja = 'none'; 
				$this->endnein = '';
				$this->pagi = array_slice($this->pagination, 0, $this->pagPunkt, true);
			}
			else {
				$this->startja = 'none'; 
				$this->startnein = '';
				$this->endja = ''; 
				$this->endnein = 'none';
				$this->pagi = array_slice($this->pagination, 0, $this->pagPunkt, true);
			}
		}
		elseif($this->key > $this->end - $this->pagPunkt+1) {
			$this->startja = ''; 
			$this->startnein = 'none';
			$this->endja = 'none'; 
			$this->endnein = '';
			$this->pagi = array_slice($this->pagination, -($this->pagPunkt), $this->pagPunkt, true);
		}
		else {
			$this->startja = ''; 
			$this->startnein = 'none';
			$this->endja = ''; 
			$this->endnein = 'none';
			$this->pagi = array_slice($this->pagination, $this->key-round($this->pagPunkt/2, 0, PHP_ROUND_HALF_DOWN), $this->pagPunkt, true);
		}
	}
	
	public function pagipunct() {
		$this->paginati();
		echo "
			<li class=\"page-item disabled\" style=\"display:".$this->startnein."\">
				<a class=\"page-link\" href=\"\" tabindex=\"-1\" aria-disabled=\"true\">Previous</a>
			</li>
			<li class=\"page-item\" style=\"display:".$this->startja."\"><a class=\"page-link\" href=\"?key=".$this->start."\">Previous</a></li>
		";
		foreach($this->pagi as $Key => $value){
			if($Key == $this->key){
				echo "
				<li class=\"page-item active\" aria-current=\"page\">
					<a class=\"page-link\" href=\"?key=".$Key."\">".++$Key." <span class=\"sr-only\">(current)</span></a>
				</li>
			";
			}
			else{
				echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?key=".$Key."\">".++$Key."</a></li>";
			}
		}
		echo "
			<li class=\"page-item disabled\" style=\"display:".$this->endnein."\">
				<a class=\"page-link\" href=\"\" tabindex=\"-1\" aria-disabled=\"true\">Next</a>
			</li>
			<li class=\"page-item\"  style=\"display:".$this->endja."\"><a class=\"page-link\" href=\"?key=".$this->end."\">Next</a></li>
		";
	}
}
