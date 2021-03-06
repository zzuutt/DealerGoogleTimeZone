<?php
/**
 * This class has been generated by TheliaStudio
 * For more information, see https://github.com/thelia-modules/TheliaStudio
 */

namespace DealerGoogleTimeZone\Loop;

use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Type\BooleanOrBothType;
use Dealer\Model\DealerShedules;
use Dealer\Model\DealerShedulesQuery;
use Dealer\Dealer;


/**
 * Class DealerGoogletimezone
 * @package DealerGoogleTimeZone\Loop\Base
 * @author TheliaStudio
 */
class DealerGoogletimezoneSchedules extends BaseLoop implements PropelSearchLoopInterface
{

    /**
     * @param LoopResult $loopResult
     *
     * @return LoopResult
     */
    public function parseResults(LoopResult $loopResult)
    {
        /** @var DealerShedules $schedules */
        foreach ($loopResult->getResultDataCollection() as $schedules) {
            $loopResultRow = new LoopResultRow($schedules);

            $loopResultRow
                ->set('ID', $schedules->getId())
                ->set('DEALER_ID', $schedules->getDealerId())
                ->set('DAY', $schedules->getDay())
                ->set('DAY_LABEL', $this->getDayLabel($schedules->getDay()))
                ->set('BEGIN', $schedules->getBegin())
                ->set('END', $schedules->getEnd())
                ->set('PERIOD_BEGIN', $schedules->getPeriodBegin())
                ->set('PERIOD_END', $schedules->getPeriodEnd());


            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }

    /**
     * Definition of loop arguments
     *
     * example :
     *
     * public function getArgDefinitions()
     * {
     *  return new ArgumentCollection(
     *
     *       Argument::createIntListTypeArgument('id'),
     *           new Argument(
     *           'ref',
     *           new TypeCollection(
     *               new Type\AlphaNumStringListType()
     *           )
     *       ),
     *       Argument::createIntListTypeArgument('category'),
     *       Argument::createBooleanTypeArgument('new'),
     *       ...
     *   );
     * }
     *
     * @return \Thelia\Core\Template\Loop\Argument\ArgumentCollection
     */
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(

            Argument::createIntListTypeArgument('id'),
            Argument::createIntListTypeArgument('dealer_id'),
            Argument::createBooleanTypeArgument('default_period'),
            Argument::createBooleanTypeArgument('hide_past',false),
            Argument::createBooleanTypeArgument('closed',false),
            Argument::createIntListTypeArgument('day'),
            Argument::createAnyTypeArgument('datetime_dealer'),
            Argument::createIntTypeArgument('max_period'),
            Argument::createEnumListTypeArgument('order', [
                'id',
                'id-reverse',
                'day',
                'day-reverse',
                'begin',
                'begin-reverse',
            ], 'id')

        );
    }

    /**
     * this method returns a Propel ModelCriteria
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildModelCriteria()
    {
        $query = DealerShedulesQuery::create();

        if ($id = $this->getId()) {
            $query->filterById($id);
        }

        if ($day = $this->getDay()) {
            $query->filterByDay($day);
        }

        if ($dealer_id = $this->getDealerId()) {
            $query->filterByDealerId($dealer_id);
        }

        if ($this->getDefaultPeriod()) {
            $query->filterByPeriodNull();
        } else {
            $query->filterByPeriodNotNull();
            if($this->getHidePast()) {
                if($datetime_dealer = $this->getDatetimeDealer()){
                    $query->filterByPeriodEnd(new \DateTime($datetime_dealer), Criteria::GREATER_THAN);
                    if($max_period = $this->getMaxPeriod()) {
                        $lastdate = new \DateTime($datetime_dealer);
                        $lastdate->modify('+'.$max_period.' day');
                        $query->filterByPeriodEnd($lastdate, Criteria::LESS_THAN);
                    }
                }
                else {
                    $query->filterByPeriodEnd(new \DateTime(), Criteria::GREATER_THAN);
                    if($max_period = $this->getMaxPeriod()) {
                        $lastdate = new \DateTime();
                        $lastdate->modify('+'.$max_period.' day');
                        $query->filterByPeriodEnd($lastdate, Criteria::LESS_THAN);
                    }
                }
            }
        }

        $query->filterByClosed($this->getClosed());

        foreach ($this->getOrder() as $order) {
            switch ($order) {
                case 'id':
                    $query->orderById();
                    break;
                case 'id-reverse':
                    $query->orderById(Criteria::DESC);
                    break;
                case 'day':
                    $query->orderByDay();
                    break;
                case 'day-reverse':
                    $query->orderByDay(Criteria::DESC);
                    break;
                case 'begin':
                    $query->orderByBegin();
                    break;
                case 'begin-reverse':
                    $query->orderByBegin(Criteria::DESC);
                    break;
                default:
                    break;
            }
        }

        return $query;
    }

    protected function getDayLabel($int = 0)
    {
        return [
            $this->translator->trans("Monday", [], Dealer::MESSAGE_DOMAIN),
            $this->translator->trans("Tuesday", [], Dealer::MESSAGE_DOMAIN),
            $this->translator->trans("Wednesday", [], Dealer::MESSAGE_DOMAIN),
            $this->translator->trans("Thursday", [], Dealer::MESSAGE_DOMAIN),
            $this->translator->trans("Friday", [], Dealer::MESSAGE_DOMAIN),
            $this->translator->trans("Saturday", [], Dealer::MESSAGE_DOMAIN),
            $this->translator->trans("Sunday", [], Dealer::MESSAGE_DOMAIN)
        ][$int];
    }
}
