<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace DealerGoogleTimeZone\Form\Type\Base;

use Thelia\Core\Form\Type\Field\AbstractIdType;
use DealerGoogleTimeZone\Model\DealerGoogletimezoneQuery;

/**
 * Class DealerGoogletimezone
 * @package DealerGoogleTimeZone\Form\Base
 * @author TheliaStudio
 */
class DealerGoogletimezoneIdType extends AbstractIdType
{
    const TYPE_NAME = "dealer_googletimezone_id";

    protected function getQuery()
    {
        return new DealerGoogletimezoneQuery();
    }

    public function getName()
    {
        return static::TYPE_NAME;
    }
}