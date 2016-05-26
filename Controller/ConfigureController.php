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

namespace DealerGoogleTimeZone\Controller;

use DealerGoogleTimeZone\DealerGoogleTimeZone;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Thelia;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Tools\URL;
use Thelia\Tools\Version\Version;

/**
 * Class ConfigureController
 * @package DealerGoogleTimeZone\Controller
 */
class ConfigureController extends BaseAdminController
{

    public function configureAction()
    {
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, 'dealergoogletimezone', AccessManager::UPDATE)) {
            return $response;
        }

        $configurationForm = $this->createForm('dealer_googletimezone.configuration.form');
        $message = null;

        try {
            $form = $this->validateForm($configurationForm);

            // Get the form field values
            $data = $form->getData();

            DealerGoogleTimeZone::setConfigValue('googletimezoneapi_key',$data['googletimezoneapi_key']);


            // Redirect to the success URL,
            if ($this->getRequest()->get('save_mode') == 'stay') {
                // If we have to stay on the same page, redisplay the configuration page/
                $url = '/admin/module/DealerGoogleTimeZone';
            } else {
                // If we have to close the page, go back to the module back-office page.
                $url = '/admin/modules';
            }

            return $this->generateRedirect(URL::getInstance()->absoluteUrl($url));
        } catch (FormValidationException $ex) {
            $message = $this->createStandardFormValidationErrorMessage($ex);
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
        }

        $this->setupFormErrorContext(
            $this->getTranslator()->trans("DealerGoogleTimeZone configuration", [], DealerGoogleTimeZone::MESSAGE_DOMAIN),
            $message,
            $configurationForm,
            $ex
        );

        // Before 2.2, the errored form is not stored in session
        if (Version::test(Thelia::THELIA_VERSION, '2.2', false, "<")) {
            return $this->render('module-configure', [ 'module_code' => 'DealerGoogleTimeZone' ]);
        } else {
            return $this->generateRedirect(URL::getInstance()->absoluteUrl('/admin/module/DealerGoogleTimeZone'));
        }
    }
}
