<?php
class Person {
	private $gender;
	private $age;
	
	protected $food_in_stomach = array();
	
	public function __construct($gender = null, $age = null) {
		$this->gender = $gender;
		$this->age = $age;
	}
	
	public function setAge($age) { $this->age = $age; }
	public function getAge() { return $this->age; }
	
	public function setGender($gender) { $this->gender = $gender; }
	public function getGender() { return $this->gender; }
	
	public function eat($food) {
		$this->food_in_stomach[] = $food;
	}
	
	public function getFoodInStomach() { return $this->food_in_stomach; }
	
	public function initDefault() {
		$this->gender = "Human";
		$this->age = 60;
	}
	
	public function toString() {
		return  "- gender: " . $this->getGender() . "\n"
				. "- age: " . $this->getAge() . "\n"
				. "- food in stomach: " . print_r($this->getFoodInStomach(), true);
	}
}
?>
