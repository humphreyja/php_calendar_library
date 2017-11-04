<?php
declare(strict_types=1);
namespace Jake;

use PHPUnit\Framework\TestCase;

/**
 * Tests the Calendar class.
 * @author Jake Humphrey
 */
final class CalendarTest extends TestCase {
  public function testDateIsALeapYear(): void {
    $date = Calendar::parseString("6/2/1994");
    $this->assertTrue($date->isLeapYear());
  }

  public function testDateIsNotALeapYear(): void {
    $date = Calendar::parseString("6/2/1995");
    $this->assertFalse($date->isLeapYear());
  }

  public function testParser(): void {
    $date = Calendar::parseString("6/2/1995");
    $this->assertEquals($date->getYear(), 1995);
    $this->assertEquals($date->getMonth(), 6);
    $this->assertEquals($date->getDay(), 2);
  }

  public function testIsDateInstance(): void {
    $this->assertInstanceOf(Calendar::class, Calendar::parseString("6/2/1994"));
  }

  public function testExpectInvalidDateExceptionOnParseRandomStr(): void {
    $this->expectException(InvalidDateException::class);
    Calendar::parseString("My Birthday!");
  }

  public function testExpectInvalidDateExceptionOnParseInvalidDate(): void {
    $this->expectException(\RangeException::class);
    Calendar::parseString("2/29/1995"); // Not a leap year so the day is out of range.
  }

  public function testSetValidMonth(): void {
    $date = Calendar::parseString("6/2/1994");
    $date->setMonth(11);
    $this->addToAssertionCount(1);
  }

  public function testSetInvalidMonth(): void {
    $this->expectException(\RangeException::class);
    $date = Calendar::parseString("6/2/1994");
    $date->setMonth(13);
  }

  public function testSetValidYear(): void {
    $date = Calendar::parseString("6/2/1994");
    $date->setYear(2018);
    $this->addToAssertionCount(1);
  }

  public function testSetInvalidYear(): void {
    $this->expectException(\RangeException::class);
    $date = Calendar::parseString("6/2/1994");
    $date->setYear(-100);
  }

  public function testSetValidDay(): void {
    $date = Calendar::parseString("1/1/2001");
    $date->setDay(1);
    $this->addToAssertionCount(1);

    // January
    $date->setMonth(1);
    $date->setDay(31);
    $this->addToAssertionCount(1);

    // Febuary - 28 (not testing leap year)
    $date->setMonth(2);
    $date->setDay(28);
    $this->addToAssertionCount(1);

    // March
    $date->setMonth(3);
    $date->setDay(31);
    $this->addToAssertionCount(1);

    // April
    $date->setMonth(4);
    $date->setDay(30);
    $this->addToAssertionCount(1);

    // May
    $date->setMonth(5);
    $date->setDay(31);
    $this->addToAssertionCount(1);

    // June
    $date->setMonth(6);
    $date->setDay(30);
    $this->addToAssertionCount(1);

    // July
    $date->setMonth(7);
    $date->setDay(31);
    $this->addToAssertionCount(1);

    // August
    $date->setMonth(8);
    $date->setDay(31);
    $this->addToAssertionCount(1);

    // September
    $date->setMonth(9);
    $date->setDay(30);
    $this->addToAssertionCount(1);

    // October
    $date->setMonth(10);
    $date->setDay(31);
    $this->addToAssertionCount(1);

    // November
    $date->setMonth(11);
    $date->setDay(30);
    $this->addToAssertionCount(1);

    // December
    $date->setMonth(12);
    $date->setDay(31);
    $this->addToAssertionCount(1);
  }

  public function testSetDayLeapYear(): void {
    $date = Calendar::parseString("2/1/1994");
    $date->setDay(29);
    $this->addToAssertionCount(1);
  }

  public function testSetDayNonLeapYear(): void {
    $this->expectException(\RangeException::class);
    $date = Calendar::parseString("2/1/1995");
    $date->setDay(29);
  }
}
