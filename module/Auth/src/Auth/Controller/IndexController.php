<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 04/05/14
 * Time: 17:39
 */

namespace Auth\Controller;

use Zend\Debug\Debug;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Auth\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * @return array|Response
     */
    public function loginAction()
    {
        $data = $this->prg();

        if ($data instanceof Response) {
            return $data;
        }

        if (is_array($data)) {
            $authHandler = $this->getServiceLocator()->get('auth.handler');

            $authHandler->setLogin($data['login']);
            $authHandler->setPassword($data['password']);

            $result = $authHandler->authenticate();

            if ($result->isValid()) {
                return $this->redirect()->toRoute('home');
            } else {
                foreach ($result->getMessages() as $message)
                    $this->flashmessenger()->addErrorMessage($message);
                return $this->redirect()->refresh();
            }
        }
    }
} 