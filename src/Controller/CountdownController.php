<?php
// App/Controller/CountdownController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Utils\DateClass;

/**
 * Main birthday controller
 *
 * @category Controllers
 * @package  App\Controller\CountdownController
 * @author   Elliott Landsborough <elliott.landsborough@gmail.com>
 * @license  https://opensource.org/licenses/MIT  MIT License
 * @link     https://gitlab.com/elliottlan/countdown-test
 */
class CountdownController extends AbstractController
{
    protected $dateClass;

    /**
     * [__construct description]
     *
     * @param DateClass $dateClass Util class for date manipulation
     */
    public function __construct(DateClass $dateClass)
    {
        $this->dateClass = $dateClass->setBirthday('1987-07-10');
    }

    /**
     * Shows some birthday stats, root url of project
     *
     * @return \Symfony\Component\HttpFoundation\Response Twig template + data
     */
    public function countdown()
    {
        $nextBirthdayString = $this->dateClass->getReadableNextBirthdayString();
        $birthdayString = $this->dateClass->getReadableBirthdayString();
        $birthdayDiff = $this->dateClass->getNextBirthdayDiff();
        $currentAge = $this->dateClass->getCurrentage();

        return $this->render(
            'default/countdown.html.twig',
            [
                'nextBirthdayStringFormatted' => $nextBirthdayString,
                'birthdayStringFormatted' => $birthdayString,
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
