<?php

/**
 * input.php
 */

$input = [
	'Analytics' => [
		[9, Manager::class, 1, false],
		[3, Manager::class, 2, false],
		[2, Analyst::class, 3, false],
		[2, Marketer::class, 1, false],
		[1, Manager::class, 2, true]
	],

	'Training' => [
		[8, Manager::class, 1, false],
		[3, Marketer::class, 1, false],
		[2, Analyst::class, 1, false],
		[2, Engineer::class, 2, false],
		[1, Manager::class, 2, true]
	],


	'Development' => [
		[12, Manager::class, 2, false],
		[10, Marketer::class, 1, false],
		[8, Engineer::class, 2, false],
		[5, Analyst::class, 3, false],
		[1, Engineer::class, 3, true]
	],


	'Sales' => [
		[13, Manager::class, 1, false],
		[11, Marketer::class, 2, false],
		[3, Marketer::class, 3, false],
		[1, Manager::class, 1, true]
	]

];

/**
 * classes.php
 */

abstract class Employee {
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
		// grade-based look-up array:
		$multiplier = [
			1 => 1,
			2 => 1.25,
			3 => 1.5
		];

		$rate = $this->getBaseRate() * $multiplier[$this->grade];
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

	/**
	 * $methodName = 'getActualPay' to get Total Labor Cost in Department
	 * $methodName = 'getActualCoffeeConsumption' to get Total Coffee Consumption in Department
	 * $methodName = 'getActualCodeProduced' to get Total Code Produced in Department
	 * $methodName = 'getStaffNumber' to get Total Stuff Number in Department
	 * $methodName = 'getCostPerUnit' to get Total Cost Per Code Unit in Department
	 */
	public function getData(string $methodName) {
		if ($methodName == 'getStaffNumber') {
			return count($this->staff);
		} elseif ($methodName == 'getCostPerUnit') {
			return round($this->getData('getActualPay') / $this->getData('getActualCodeProduced'), 2);
		}

		$data = 0;
		foreach ($this->staff as $employee) {
			$data += $employee->$methodName();
		}
		return $data;
	}
}

class Company {
	protected array $depts;

	public function addDept(Department $dept) {
		$this->depts[] = $dept;
	}
	
	public function getDepts() {
		return $this->depts;
	}

	/**
	 * $methodName = 'getStaffNumber' to get Total Staff Number in Company
	 * $methodName = 'getActualPay' to get Total Labor Cost in Company
	 * $methodName = 'getActualCoffeeConsumption' to get Total Coffee Consumption in Company
	 * $methodName = 'getActualCodeProduced' to get Total Code Produced in Company
	 * $methodName = 'getCostPerUnit' to get Total Cost Per Code Unit in Company
	 */
	public function getTotalData(string $methodName) {
		$data = 0;
		foreach ($this->depts as $dept) {
			$data += $dept->getData($methodName);
		}
		return $data;
	}
	
	/**
	 * $methodName = 'getStaffNumber' to get Average Staff Number for Departments of Company
	 * $methodName = 'getActualPay' to get Average Labor Cost for Departments of Company
	 * $methodName = 'getActualCoffeeConsumption' to get Average Coffee Consumption for Departments of Company
	 * $methodName = 'getActualCodeProduced' to get Average Code Units Produced by Departments of Company
	 * $methodName = 'getCostPerUnit' to get Average Cost Per Code Unit for Departments of Company
	 */
	public function getAverageData(string $methodName) {
		return round($this->getTotalData($methodName) / count($this->depts), 2);
	}

	public function printReport() {
		$regcol = 15;
		$widecol = 20;
		
		echo str_pad('DEPARTMENT', $widecol) .
			str_pad('STAFF', $regcol, ' ', STR_PAD_LEFT) .
			str_pad('LABOR COST', $regcol, ' ', STR_PAD_LEFT) .
			str_pad('COFFEE DRUNK', $regcol, ' ', STR_PAD_LEFT) .
			str_pad('CODE UNITS', $regcol, ' ', STR_PAD_LEFT) .
			str_pad('COST PER UNIT', $regcol, ' ', STR_PAD_LEFT) .
			"\n";

		echo str_pad('=', $widecol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			"\n";

		foreach ($this->depts as $dept) {
			echo str_pad($dept->getName(), $widecol) .
			       	str_pad($dept->getData('getStaffNumber'), $regcol, ' ', STR_PAD_LEFT) .
				str_pad($dept->getData('getActualPay'), $regcol, ' ', STR_PAD_LEFT) .
				str_pad($dept->getData('getActualCoffeeConsumption'), $regcol, ' ', STR_PAD_LEFT) .
				str_pad($dept->getData('getActualCodeProduced'), $regcol, ' ', STR_PAD_LEFT) .
				str_pad($dept->getData('getCostPerUnit'), $regcol, ' ', STR_PAD_LEFT) .
				"\n";
		}

		echo str_pad('=', $widecol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			str_pad('=', $regcol, '=', STR_PAD_RIGHT) .
			"\n";

		echo str_pad('TOTAL', $widecol) .
			str_pad($this->getTotalData('getStaffNumber'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getTotalData('getActualPay'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getTotalData('getActualCoffeeConsumption'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getTotalData('getActualCodeProduced'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getTotalData('getCostPerUnit'), $regcol, ' ', STR_PAD_LEFT) .
			"\n";
	
		echo str_pad('AVERAGE', $widecol) .
			str_pad($this->getAverageData('getStaffNumber'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getAverageData('getActualPay'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getAverageData('getActualCoffeeConsumption'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getAverageData('getActualCodeProduced'), $regcol, ' ', STR_PAD_LEFT) .
			str_pad($this->getAverageData('getCostPerUnit'), $regcol, ' ', STR_PAD_LEFT) .
			"\n";
	}
}

/**
 * main.php
 */

function makeDepts(array $input): array {
	$depts = [];
	foreach ($input as $dept => $staff) {
		$currentDept = new Department($dept);
		foreach ($staff as [$quantity, $type, $grade, $chief]) {
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

$company = new Company();
foreach ($depts as $dept) {
	$company->addDept($dept);
}

$company->printReport();
