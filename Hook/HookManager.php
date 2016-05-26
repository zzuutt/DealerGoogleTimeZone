<?php
/*************************************************************************************/

namespace DealerGoogleTimeZone\Hook;

use DealerGoogleTimeZone\DealerGoogleTimeZone;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\ModuleConfig;
use Thelia\Model\ModuleConfigQuery;

class HookManager extends BaseHook
{

    public function onModuleConfigure(HookRenderEvent $event)
    {

        if (null !== $params = ModuleConfigQuery::create()->findByModuleId(DealerGoogleTimeZone::getModuleId())) {
            /** @var ModuleConfig $param */
            foreach ($params as $param) {
                $vars[ $param->getName() ] = $param->getValue();
            }
        }

        $event->add(
            $this->render('module-configuration.html', $vars)
        );
    }
}
