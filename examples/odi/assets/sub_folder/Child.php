<?php
class Child {
	private $props;
	private $dob;
	
	public function __construct($dob = null) {
		$this->dob = $dob;
	}
	
	public function setProps($props) { $this->props = $props; }
	public function getProps() { return $this->props; }
	
	public function setDOB($dob) { $this->dob = $dob; }
	public function getDOB() { return $this->dob; }
	
	public function toString() {
		return  "- dob: " . $this->getDOB() . "\n"
				. "- props: " . print_r($this->getProps(), true);
	}
}
?>
