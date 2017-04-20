<?php
namespace Edu\Cnm\DataDesign;

/**
 *Trait valadates a mySQL Date
 *
 * Thanks to Dylan McDonald
 */

trait validateDate {
    /**
     * custom filter for mySQL date
     *
     */
    private static function validateDate($newDate) : \DateTime {
        if(is_object($newDate) === true && get_class($newDate) === "DateTime") {
            return ($newDate);
        }
        //treat the date as a mySQL date string: Y-m-d
        //p is pearl provided by Dylan
        $newDate = trim($newDate);
        if((preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $newDate, $matches)) !== 1) {
            throw(new \InvalidArgumentException("date is not a valid date"));
        }
        // verify the date is really a valid calender date
        $year = intval($matches[1]);
        $month = intval($matches [2]);
        $day = intval($matches [3]);
        if (checkdate($month, $day, $year) === false) {
            throw(new \RangeException("date is not a Gregorian date"));
        }
        //The date is clean.
        $newDate = \DateTime::createFromFormat("Y-m-d H:i:s", $newDate . "00:00:00");
        return($newDate);
    }

}
