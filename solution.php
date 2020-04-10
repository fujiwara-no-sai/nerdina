<?php

/**
 * input.php
 * the input format is determined by me based on the given data.
 * I've been told by the peers that the current one is way too complicated and 
 * the array should look like this:
 * $input = [
 *          ['Analytics', 9, Employee::MANAGER, 1],
 *          ['Training', 8, Employee::MANAGER, 1],
 *          ...
 *          ];
 * Please advise on this point
 */

$input = [
	'Analytics' => [
		[9, Employee::MANAGER, 1],
		[3, Employee::MANAGER, 2],
		[2, Employee::ANALYST, 3],
		[2, Employee::MARKETER, 1],
		[1, Employee::MANAGER, 2, true]
	],

	'Training' => [
		[8, Employee::MANAGER, 1],
		[3, Employee::MARKETER, 1],
		[2, Employee::ANALYST, 1],
		[2, Employee::ENGINEER, 2],
		[1, Employee::MANAGER, 2, true]
	],


	'Development' => [
		[12, Employee::MANAGER, 2],
		[10, Employee::MARKETER, 1],
		[8, Employee::ENGINEER, 2],
		[5, Employee::ANALYST, 3],
		[1, Employee::ENGINEER, 3, true]
	],


	'Sales' => [
		[13, Employee::MANAGER, 1],
		[11, Employee::MARKETER, 2],
		[3, Employee::MARKETER, 3],
		[1, Employee::MANAGER, 1, true]
	]

];

/**
 * padstring.php
 * a function facilitating the report output later on
 */

function padString($string, $length, $side = "right", $pad = " ") {
	if (strlen($string) == $length) {
		return $string;
	} else {
		$charsNeeded = $length - strlen($string); // 5
		$padding = str_repeat($pad, $charsNeeded);
		($side == "right") ? ($string = $string . $padding) : ($string = $padding . $string);
		return $string;
	}
}

/**
 * classes.php
 */

abstract class Employee {
	const MANAGER = "Manager";
	const MARKETER = "Marketer";
	const ENGINEER = "Engineer";
	const ANALYST = "Analyst";

	protected int $grade;
	protected bool $chief;

	public function __construct(int $grade, bool $chief = false) {
		$this->grade = $grade;
		$this->chief = $chief;
	}
	
	/**
	 * the following methods are in place to make sure all subclasses
	 * include the base properties returned by these methods
	 */
	abstract public function getBaseRate();
	abstract public function getBaseCoffeeConsumption();
	abstract public function getBaseCodeProduced();

	public function getActualPay(): float {
		$rate = $this->getBaseRate();
		if ($this->grade == 2) {
			$rate *= 1.25;
		} elseif ($this->grade == 3) {
			$rate = $rate * 1.5;
		}

		return $this->chief ? $rate * 2 : $rate;
	}

	public function getActualCoffeeConsumption(): float {
		return $this->chief ? $this->getBaseCoffeeConsumption() * 2 : $this->getBaseCoffeeConsumption();
	}

	public function getActualCodeProduced(): int {
		return $this->chief ? 0 : $this->getBaseCodeProduced();	
	}
}

class Manager extends Employee {
	protected $baseRate = 7000;
	protected $baseCoffeeConsumption = 5;
	protected int $baseCodeProduced = 75;

	public function getBaseRate(): float {
		return $this->baseRate;
	}

	public function getBaseCoffeeConsumption(): float {
		return $this->baseCoffeeConsumption;
	}

	public function getBaseCodeProduced(): int {
		return $this->baseCodeProduced;
	}
}

class Marketer extends Employee {
	protected $baseRate = 6600;
	protected $baseCoffeeConsumption = 4;
	protected int $baseCodeProduced = 5;

	public function getBaseRate(): float {
		return $this->baseRate;
	}

	public function getBaseCoffeeConsumption(): float {
		return $this->baseCoffeeConsumption;
	}

	public function getBaseCodeProduced(): int {
		return $this->baseCodeProduced;
	}
}

class Engineer extends Employee {
	protected $baseRate = 8300;
	protected $baseCoffeeConsumption = 8;
	protected int $baseCodeProduced = 200;
	
	public function getBaseRate(): float {
		return $this->baseRate;
	}

	public function getBaseCoffeeConsumption(): float {
		return $this->baseCoffeeConsumption;
	}

	public function getBaseCodeProduced(): int {
		return $this->baseCodeProduced;
	}
}

class Analyst extends Employee {
	protected $baseRate = 7500;
	protected $baseCoffeeConsumption = 12;
	protected int $baseCodeProduced = 125;

	public function getBaseRate(): float {
		return $this->baseRate;
	}

	public function getBaseCoffeeConsumption(): float {
		return $this->baseCoffeeConsumption;
	}

	public function getBaseCodeProduced(): int {
		return $this->baseCodeProduced;
	}
}

class Department {
	protected string $name;
	protected array $staff;

	public function __construct($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function addToStaff(Employee $employee) {
		$this->staff[] = $employee;
	}

	public function getStaffNumber() {
		return count($this->staff);
	}

	public function getLaborCost() {
		$laborCost = 0;
		foreach ($this->staff as $employee) {
			$laborCost += $employee->getActualPay();
		}
		return $laborCost;
	}

	public function getCoffeeConsumption() {
		$coffee = 0;
		foreach ($this->staff as $employee) {
			$coffee += $employee->getActualCoffeeConsumption();
		}
		return $coffee;
	}

	public function getCodeProduced() {
		$code = 0;
		foreach ($this->staff as $employee) {
			$code += $employee->getActualCodeProduced();
		}
		return $code;
	}

	public function getCostPerUnit() {
		return round($this->getLaborCost() / $this->getCodeProduced(), 2);
	}
	
}

class Company {
	protected array $depts;

	public function __construct(array $depts) {
		$this->depts = $depts;
	}

	public function getDepts() {
		return $this->depts;
	}

	public function getTotalStaffNumber() {
		$staffNumber = 0;
		foreach ($this->depts as $dept) {
			$staffNumber += $dept->getStaffNumber();
		}
		return $staffNumber;
	}

	public function getTotalLaborCost() {
		$laborCost = 0;
		foreach ($this->depts as $dept) {
			$laborCost += $dept->getLaborCost();
		}
		return $laborCost;
	}

	public function getTotalCoffeeConsumption() {
		$coffee = 0;
		foreach ($this->depts as $dept) {
			$coffee += $dept->getCoffeeConsumption();
		}
		return $coffee;
	}

	public function getTotalCodeProduced() {
		$code = 0;
		foreach ($this->depts as $dept) {
			$code += $dept->getCodeProduced();
		}
		return $code;
	}

	public function getTotalCostPerUnit() {
		$cost = 0;
		foreach ($this->depts as $dept) {
			$cost += $dept->getCostPerUnit();
		}
		return $cost;
	}

	public function getAverageStaffNumber() {
		return round($this->getTotalStaffNumber() / count($this->depts), 2);
	}

	public function getAverageLaborCost() {
		return round($this->getTotalLaborCost() / count($this->depts), 2);
	}

	public function getAverageCoffeeConsumption() {
		return round($this->getTotalCoffeeConsumption() / count($this->depts), 2);
	}

	public function getAverageCodeProduced() {
		return round($this->getTotalCodeProduced() / count($this->depts), 2);
	}

	public function getAverageCostPerUnit() {
		return round($this->getTotalCostPerUnit() / count($this->depts), 2);
	}

	/**
	 * should I use echo or is it better to put the entire report string in a variable
	 * and return it?
	 */
	public function printReport() {
		$regcol = 15;
		$widecol = 20;

		echo padString('DEPARTMENT', $widecol) . padString('STAFF', $regcol, 'left') . padString('LABOR COST', $regcol, 'left') . padString('COFFEE DRUNK', $regcol, 'left') . padString('CODE UNITS', $regcol, 'left') . padString('COST PER UNIT', $regcol, 'left') . "\n";
		echo padString('=', $widecol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . "\n";
		foreach ($this->depts as $dept) {
			echo padString($dept->getName(), $widecol) . padString($dept->getStaffNumber(), $regcol, 'left') . padString($dept->getLaborCost(), $regcol, 'left') . padString($dept->getCoffeeConsumption(), $regcol, 'left') . padString($dept->getCodeProduced(), $regcol, 'left') . padString($dept->getCostPerUnit(), $regcol, 'left') . "\n";
		}
		echo padString('=', $widecol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . padString('=', $regcol, 'right', '=') . "\n";
		echo padString('TOTAL', $widecol) . padString($this->getTotalStaffNumber(), $regcol, 'left') . padString($this->getTotalLaborCost(), $regcol, 'left') . padString($this->getTotalCoffeeConsumption(), $regcol, 'left') . padString($this->getTotalCodeProduced(), $regcol, 'left') . padString($this->getTotalCostPerUnit(), $regcol, 'left') . "\n";
		echo padString('AVERAGE', $widecol) . padString($this->getAverageStaffNumber(), $regcol, 'left') . padString($this->getAverageLaborCost(), $regcol, 'left') . padString($this->getAverageCoffeeConsumption(), $regcol, 'left') . padString($this->getAverageCodeProduced(), $regcol, 'left') . padString($this->getAverageCostPerUnit(), $regcol, 'left') . "\n";
	}
}

/**
 * main.php
 */

function makeDepts(array $input): array {
	$depts = [];
	foreach ($input as $dept => $staff) {
		$currentDept = new Department($dept);
		foreach ($staff as $employeeGroup) {
			$quantity = $employeeGroup[0];
			$type = $employeeGroup[1];
			$grade = $employeeGroup[2];
			$chief = isset($employeeGroup[3]) ? true : false;
			for ($c = 0; $c < $quantity; $c++) {
				$employeeObject = new $type($grade, $chief);
				$currentDept->addToStaff($employeeObject);
			}
		}
		$depts[] = $currentDept;
	}
	return $depts;
}

$depts = makeDepts($input);
$company = new Company($depts);

$company->printReport();
