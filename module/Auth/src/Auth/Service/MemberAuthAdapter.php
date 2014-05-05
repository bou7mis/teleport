<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 04/05/14
 * Time: 21:15
 */

namespace Auth\Service;


use Zend\Authentication\Adapter\AdapterInterface;

class MemberAuthAdapter implements AdapterInterface
{

    protected $identity;

    protected $credential;

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $login = $this->getIdentity();
        $password = $this->getCredential();

        if ($login && $login == $password) {
            $code = Result::SUCCESS;
            $messages = [];
        } else {
            $code = Result::FAILURE;
            if ($login) {
                $messages = ['Wrong user and/or password'];
            } else {
                $messages = ['No login provided'];
            }
        }

        return new Result($code, $login, $messages);
    }

    /**
     * @param mixed $credential
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
    }

    /**
     * @return mixed
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * @param mixed $identity
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    /**
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->identity;
    }
}