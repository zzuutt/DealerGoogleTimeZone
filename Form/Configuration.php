<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace DealerGoogleTimeZone\Form;

use DealerGoogleTimeZone\DealerGoogleTimeZone;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\ConfigQuery;

/**
 * Class Configuration
 * @package DealerGoogleTimeZone\Form
 */
class Configuration extends BaseForm {

    protected function buildForm()
    {
        $form = $this->formBuilder;

        $form->add(
            "googletimezoneapi_key",
            "text",
            array(
                'data'  => DealerGoogleTimeZone::getConfigValue("googletimezoneapi_key"),
                'label' => Translator::getInstance()->trans("Google TimeZone Api Key"),
                'label_attr' => array(
                    'for' => "googletimezoneapi_key"
                ),
            )
        );

    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return "dealergoogletimezone";
    }


} 