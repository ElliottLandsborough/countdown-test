<?php
// src/Controller/CountdownController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use DateTime;
use App\Utils\DateClass;

class CountdownController extends AbstractController
{
    protected $dateClass;

    function __construct(DateClass $dateClass)
    {
        $this->dateClass = $dateClass;
    }

    public function countdown()
    {
        $today = date('Y-m-d');

        // birthday - in 'yyyy-mm-dd' format
        $birthday = '1987-07-10';

        // my next birthday string
        $nextBirthDayString = date('Y') . '-' . substr($birthday, 5, 5);

        // convert next birthday into time
        $nextBirthdayTime = strtotime($nextBirthDayString);

        // if birthday has happend this year (or is today), skip to next year
        if ($today >= $nextBirthDayString) {
            // make a new date based on next year
            $nextBirthDayString = date('Y-' . substr($birthday, 5, 5) . '', strtotime($nextBirthDayString . ' +1 year'));
        }

        // convert next birthday into date
        $nextBirthDayDate = date($nextBirthDayString);

        // create a next birthday object
        $nextBirthdayObject = new DateTime($nextBirthDayString);

        // format my next birthday in a readable way
        $nextBirthdayStringFormatted = $nextBirthdayObject->format('l jS F Y');

        // my birthday string
        $birthdayString = $birthday;

        // create a birthday object
        $birthdayObject = new DateTime($birthdayString);

        // format my birthday in a readable way
        $birthdayStringFormatted = $birthdayObject->format('l jS F Y');

        // compare birthday with today/now
        $birthdayDiff = $birthdayObject->diff(new DateTime('now'));

        // my current age
        $currentAge = $birthdayDiff->y;

        // compare NEXT birthday with today/now
        $birthdayDiff = $nextBirthdayObject->diff(new DateTime('now'));

        // get time until next birthday
        $nextBirthdayMonths = $birthdayDiff->m;
        $nextBirthdayDays = $birthdayDiff->d;
        $nextBirthdayHours = $birthdayDiff->h;
        $nextBirthdayMinutes = $birthdayDiff->i;
        $nextBirthdaySeconds = $birthdayDiff->s;

        // my next age
        $nextAge = intval($currentAge) + 1;

        return $this->render(
            'default/countdown.html.twig',
            [
                'birthdayStringFormatted' => $birthdayStringFormatted,
                'nextBirthdayStringFormatted' => $nextBirthdayStringFormatted,
                'currentAge' => $currentAge,
                'nextAgePretty' => $this->dateClass->ordinal($nextAge),
                'nextBirthdayMonths' => $nextBirthdayMonths,
                'nextBirthdayDays' => $nextBirthdayDays,
                'nextBirthdayHours' => $nextBirthdayHours,
                'nextBirthdayMinutes' => $nextBirthdayMinutes,
                'nextBirthdaySeconds' => $nextBirthdaySeconds,
            ]
        );
    }
}
