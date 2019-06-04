<?php
// src/Controller/CountdownController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Utils\DateClass;

class CountdownController extends AbstractController
{
    protected $dateClass;

    public function __construct(DateClass $dateClass)
    {
        $this->dateClass = $dateClass->setBirthday('1987-07-10');
    }

    public function countdown()
    {
        $birthdayDiff = $this->dateClass->getNextBirthdayDiff();
        $currentAge = $this->dateClass->getCurrentage();

        return $this->render(
            'default/countdown.html.twig',
            [
                'nextBirthdayStringFormatted' => $this->dateClass->getReadableNextBirthdayString(),
                'birthdayStringFormatted' => $this->dateClass->getReadableBirthdayString(),
                'currentAge' => $currentAge,
                'nextAgePretty' => $this->dateClass->ordinal($currentAge + 1),
                'nextBirthdayMonths' => $birthdayDiff->m,
                'nextBirthdayDays' => $birthdayDiff->d,
                'nextBirthdayHours' => $birthdayDiff->h,
                'nextBirthdayMinutes' => $birthdayDiff->i,
                'nextBirthdaySeconds' => $birthdayDiff->s,
            ]
        );
    }
}
