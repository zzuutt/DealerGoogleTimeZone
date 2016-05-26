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
/*************************************************************************************/

namespace DealerGoogleTimeZone\Hook;

use Dealer\Model\DealerQuery;
use Dealer\Model\Map\DealerTableMap;
use DealerGoogleTimeZone\DealerGoogleTimeZone;
use DealerGoogleTimeZone\Model\DealerGoogletimezoneQuery;
use DealerGoogleTimeZone\Model\Map\DealerGoogleTimeZoneTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\Join;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Translation\Translator;

/**
 * Class AdminHook
 * @package DealerGoogleTimeZone\Hook
 */
class AdminHook extends BaseHook
{
    protected $container;


    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function transQuick($id, $locale, $parameters = [])
    {
        if ($this->translator === null) {
            $this->translator = Translator::getInstance();
        }

        return $this->trans($id, $parameters, DealerGoogleTimeZone::MESSAGE_DOMAIN, $locale);
    }

    public function onDealerEditTab(HookRenderBlockEvent $event)
    {
        if ($this->checkAuth(DealerGoogleTimeZone::RESOURCES_GOOGLETIMEZONE, [], AccessManager::VIEW)) {
            $lang = $this->getSession()->getLang();

            $args = $event->getArguments();

            $event->add(
                [
                    "id" => "dealergoogletimezone",
                    "class" => "",
                    "title" => $this->transQuick("TimeZone", $lang->getLocale()),
                    "dealer_id" => $args["dealer_id"],
                    "content" => $this->render("dealergoogletimezone.html", $event->getArguments()),

                ]
            );
        }
    }

    public function onDealerEditJs(HookRenderEvent $event)
    {
        $lat = $lng = '';
        if($this->getRequest()->query->has('dealer_id')) {
            $dearler_id = $this->getRequest()->query->get('dealer_id');
            if($dearler_id != '') {
                $dealer = DealerQuery::create()->findOneById($dearler_id);
                $lat = $dealer->getLatitude();
                $lng = $dealer->getLongitude();
            }
        }

        $event->add(
            $this->render(
                "js/dealergoogletimezone-js.html",
                [
                    'dealer_lat' => $lat,
                    'dealer_lng' => $lng,
                    'googletimezoneapi_key' => DealerGoogleTimeZone::getConfigValue('googletimezoneapi_key')
                ]
                )
        );
    }

    protected function checkAuth($resources, $modules, $accesses)
    {
        $resources = is_array($resources) ? $resources : array($resources);
        $modules = is_array($modules) ? $modules : array($modules);
        $accesses = is_array($accesses) ? $accesses : array($accesses);

        if ($this->getSecurityContext()->isGranted(array("ADMIN"), $resources, $modules, $accesses)) {
            // Okay !
            return true;
        }

        return false;

    }

    /**
     * Return the security context, by default in admin mode.
     *
     * @return \Thelia\Core\Security\SecurityContext
     */
    protected function getSecurityContext()
    {
        return $this->container->get('thelia.securityContext');
    }
}