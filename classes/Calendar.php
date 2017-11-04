<?php
/**
 * A Simple Calendar object for creating and managing a date.
 * @author Jake Humphrey
 */
namespace Jake;

/**
 * Allows for date parsing and some simple date functions.
 */
class Calendar
{
  /**
   * The month of the date
   * @access private
   */
  private $_month;

  /**
   * The day of the date
   * @access private
   */
  private $_day;

  /**
   * The year of the date
   * @access private
   */
  private $_year;

  /**
   * Constructs a new Calendar object
   * @param int|string $year The year of the date.
   * @param int|string $month The month of the date.
   * @param int|string $day The day of the date.
   */
  function __construct($year, $month, $day)
  {
    $this->setYear(intval($year));
    $this->setMonth(intval($month));
    $this->setDay(intval($day));
  }

  /**
   * Parses a string date into a Calendar object.
   * @param string $stringDate A string representation of a date as either MM/DD/YYYY or MM-DD-YYYY
   * @return Calendar
   */
  public static function parseString(string $stringDate): Calendar {
    preg_match('/^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/', $stringDate, $matches);

    if (count($matches) == 6) {
        $year = intval($matches[5]);
        $month = intval($matches[1]);
        $day = intval($matches[3]);
        return new self($year, $month, $day);
    }else{
      throw new InvalidDateException("Invalid date format.  Required: MM/DD/YYYY or MM-DD-YYYY");
    }
  }

  /**
   * Determines if the calendar instance's year is a leap year.
   * @return bool
   */
  public function isLeapYear(): bool {
    if (($this->_year % 2) == 0) {
      if (($this->_year % 100) == 0) {
        if (($this->_year % 400) == 0) {
          return true;
        }else{
          return false;
        }
      }else{
        return true;
      }
    }else{
      return false;
    }
  }

  /**
   * Returns the instance's year
   * @return int
   */
  public function getYear(): int {
    return $this->_year;
  }

  /**
   * Returns the instance's month
   * @return int
   */
  public function getMonth(): int {
    return $this->_month;
  }

  /**
   * Returns the instance's day
   * @return int
   */
  public function getDay(): int {
    return $this->_day;
  }

  /**
   * Sets the calendar object's month.  Will throw an error if out of range
   * @param int $month The new month to be assigned
   * @return void
   */
  public function setMonth(int $month): void {
    if ($month > 0 && $month < 13) {
      $this->_month = $month;
    }else{
      throw new \RangeException("Invalid month. Can only be between 1 and 12");
    }
  }

  /**
   * Sets the calendar object's year.  Will throw an error if out of range
   * @param int $year The new year to be assigned
   * @return void
   */
  public function setYear(int $year): void {
    if ($year > 0) {
      $this->_year = $year;
    }else{
      throw new \RangeException("Invalid year. Must be positive");
    }
  }

  /**
   * Sets the calendar object's day.  Will throw an error if out of range
   * @param int $day The new day to be assigned
   * @return void
   */
  public function setDay(int $day): void {
    if ($day > 0 && $day <= $this->daysInMonth()) {
      $this->_day = $day;
    }else{
      throw new \RangeException("Invalid day. Must be at least 1 and less than or equal to the maximun number of days in the current month");
    }
  }

  /**
   * Returns the number of days in the current month, includes leap year.
   * @return int
   */
  public function daysInMonth(): int {
    $longMonths = Array(1,3,5,7,8,10,12);
    $shortMonths = Array(4,6,9,11);

    if (in_array($this->_month, $longMonths)) {
      return 31;
    }elseif (in_array($this->_month, $shortMonths)) {
      return 30;
    }else{
      if ($this->isLeapYear()) {
        return 29;
      }else{
        return 28;
      }
    }
  }
}
