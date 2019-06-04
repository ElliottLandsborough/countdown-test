<?php
// src/Utils/DateClass.php
namespace App\Utils;

use DateTime;

/**
 * Utility class for date manipulation
 *
 * @category Utilities
 * @package  App\Utils\DateClass
 * @author   Elliott Landsborough <elliott.landsborough@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://gitlab.com/elliottlan/countdown-test
 */
class DateClass
{
    protected $today;
    protected $birthdayString; //
    protected $birthdayObject;
    protected $nextBirthdayString;
    protected $nextBirthdayObject;
    protected $currentAge;

    /**
     * Constructor, sets todays date
     */
    public function __construct()
    {
        $this->today = date('Y-m-d');
    }

    /**
     * Initialize all the vars we need
     *
     * @param string $string birthday - in 'yyyy-mm-dd' format
     *
     * @return \App\Utils\DateClass $this
     */
    public function setBirthday(string $string)
    {
        $this->setBirthdayString($string);
        $this->setBirthdayObject();
        $this->setNextBirthdayString();
        $this->setNextBirthdayObject();
        $this->setCurrentAge();

        return $this;
    }

    /**
     * Sets the birthday string
     *
     * @param string $string birthday - in 'yyyy-mm-dd' format
     *
     * @return \App\Utils\DateClass $this
     */
    protected function setBirthdayString(string $string)
    {
        $this->birthdayString = $string;

        return $this;
    }

    /**
     * Returns the birthday string
     *
     * @return String 'Y-m-d'
     */
    protected function getBirthdayString()
    {
        return $this->birthdayString;
    }

    /**
     * Returns the birthdate DateTime object
     *
     * @return DateTime Birthday
     */
    protected function getBirthdayObject()
    {
        return $this->birthdayObject;
    }

    /**
     * Sets the birthdate DateTime object
     *
     * @return \App\Utils\DateClass $this
     */
    protected function setBirthdayObject()
    {
        $this->birthdayObject = new DateTime($this->getBirthdayString());

        return $this;
    }

    /**
     * Returns the string of the next birthday
     *
     * @return String 'Y-m-d'
     */
    protected function getNextBirthdayString()
    {
        return $this->nextBirthdayString;
    }

    /**
     * Sets the next birthday string
     *
     * @return \App\Utils\DateClass $this
     */
    protected function setNextBirthdayString()
    {
        // my next birthday string
        $nextBirthdayString = date('Y') . '-' . substr($this->birthdayString, 5, 5);

        // convert next birthday into time
        $nextBirthdayTime = strtotime($nextBirthdayString);

        // if birthday has happend this year (or is today), skip to next year
        if ($this->today >= $nextBirthdayString) {
            // add a year
            $plusOneYear = strtotime($nextBirthdayString . ' +1 year');
            // get the month/day
            $monthDay = substr($this->birthdayString, 5, 5);
            // make a new date based on next year
            $nextBirthdayString = date('Y-' . $monthDay, $plusOneYear);
        }

        $this->nextBirthdayString = $nextBirthdayString;

        return $this;
    }

    /**
     * Gets the next birthday object
     *
     * @return DateTime Next birthday
     */
    protected function getNextBirthdayObject()
    {
        return $this->nextBirthdayObject;
    }

    /**
     * Sets the next birthday object
     *
     * @return \App\Utils\DateClass $this
     */
    protected function setNextBirthdayObject()
    {
        $this->nextBirthdayObject = new DateTime($this->getNextBirthdayString());

        return $this;
    }

    /**
     * Formats the next birthday object to be human readable
     *
     * @return String date('l jS F Y')
     */
    public function getReadableNextBirthdayString()
    {
        return $this->getNextBirthdayObject()->format('l jS F Y');
    }

    /**
     * Formats the birthday object to be human readable
     *
     * @return String date('l jS F Y')
     */
    public function getReadableBirthdayString()
    {
        return $this->getBirthdayObject()->format('l jS F Y');
    }

    /**
     * Returns difference between birthday and today
     *
     * @return \DateInterval object
     */
    protected function getBirthdayDiff()
    {
        return $this->getBirthdayObject()->diff(new DateTime('now'));
    }

    /**
     * Returns difference between next birthday and today
     *
     * @return \DateInterval object
     */
    public function getNextBirthdayDiff()
    {
        return $this->getNextBirthdayObject()->diff(new DateTime('now'));
    }

    /**
     * Sets the current age based on the birthday
     *
     * @return \App\Utils\DateClass $this
     */
    protected function setCurrentAge()
    {
        // my current age
        $this->currentAge = $this->getBirthdayDiff()->y;

        return $this;
    }

    /**
     * Gets the current age based on the birthday
     *
     * @return int Current age
     */
    public function getCurrentage()
    {
        return $this->currentAge;
    }

    /**
     * Returns a number with its en_gb ordinal suffix
     * Source: https://stackoverflow.com/a/3110033
     *
     * @param int $number The number to be formatted
     *
     * @return String The number with its suffix e.g 24th, 31st
     */
    public function ordinal(int $number)
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13)) {
            return $number. 'th';
        } else {
            return $number. $ends[$number % 10];
        }
    }
}
