<?php

class TestTest extends PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider getData
	 */
	public function testAddNumbers($a, $b, $expected) {
		$this->assertEquals($expected, $a + $b);
	}

	public function getData() {
		return array(
			array(5, 5, 10),
			array(5, 3, 8)
			);
	}

}

?>