<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 04/05/14
 * Time: 17:59
 */

namespace Auth\Service;


use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;

class AuthHandler extends AuthenticationService
{
    protected $adapter;

    protected $login;

    protected $password;

    public function authenticate(AdapterInterface $adapter = null)
    {
        if(is_null($adapter)) {
            $adapter = $this->getAdapter();
        }

        $adapter->setIdentity($this->getLogin());
        $adapter->setCredential($this->getPassword());

        $result = parent::authenticate($adapter);

        if($result->isValid()) {
            var_dump($result);
        }
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
} 