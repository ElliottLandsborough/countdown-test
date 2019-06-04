<?php
// src/Utils/DateClass.php
namespace App\Utils;

use DateTime;

class DateClass
{
    protected $today;
    protected $birthdayString; // birthday - in 'yyyy-mm-dd' format
    protected $birthdayObject;
    protected $nextBirthdayString;
    protected $nextBirthdayObject;
    protected $currentAge;

    public function __construct()
    {
        $this->today = date('Y-m-d');
    }

    public function setBirthday(string $string)
    {
        $this->setBirthdayString($string);
        $this->setBirthdayObject();
        $this->setNextBirthdayString();
        $this->setNextBirthdayObject();
        $this->setCurrentAge();

        return $this;
    }

    public function setBirthdayString(string $string)
    {
        $this->birthdayString = $string;

        return $this;
    }

    public function getBirthdayString()
    {
        return $this->birthdayString;
    }

    public function getBirthdayObject()
    {
        return $this->birthdayObject;
    }

    public function setBirthdayObject()
    {
        $this->birthdayObject = new DateTime($this->getBirthdayString());

        return $this;
    }

    public function getNextBirthdayString()
    {
        return $this->nextBirthdayString;
    }

    public function setNextBirthdayString()
    {
        // my next birthday string
        $nextBirthdayString = date('Y') . '-' . substr($this->birthdayString, 5, 5);

        // convert next birthday into time
        $nextBirthdayTime = strtotime($nextBirthdayString);

        // if birthday has happend this year (or is today), skip to next year
        if ($this->today >= $nextBirthdayString) {
            // make a new date based on next year
            $nextBirthdayString = date('Y-' . substr($this->birthdayString, 5, 5) . '', strtotime($nextBirthdayString . ' +1 year'));
        }

        $this->nextBirthdayString = $nextBirthdayString;

        return $this;
    }

    public function getNextBirthdayObject()
    {
        return $this->nextBirthdayObject;
    }

    public function setNextBirthdayObject()
    {
        $this->nextBirthdayObject = new DateTime($this->getNextBirthdayString());

        return $this;
    }

    public function getReadableNextBirthdayString()
    {
        return $this->getNextBirthdayObject()->format('l jS F Y');
    }

    public function getReadableBirthdayString()
    {
        return $this->getBirthdayObject()->format('l jS F Y');
    }

    // compare birthday with today/now
    public function getBirthdayDiff()
    {
        return $this->getBirthdayObject()->diff(new DateTime('now'));
    }

    public function getNextBirthdayDiff()
    {
        return $this->getNextBirthdayObject()->diff(new DateTime('now'));
    }

    public function setCurrentAge()
    {
        // my current age
        $this->currentAge = $this->getBirthdayDiff()->y;

        return $this;
    }

    public function getCurrentage()
    {
        return $this->currentAge;
    }

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
