<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 04/05/14
 * Time: 17:39
 */

namespace Auth\Controller;

use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
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