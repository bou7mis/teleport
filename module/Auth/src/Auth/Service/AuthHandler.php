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

/**
 * Class AuthHandler
 * @package Auth\Service
 */
class AuthHandler extends AuthenticationService
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param AdapterInterface $adapter
     * @return \Zend\Authentication\Result
     */
    public function authenticate(AdapterInterface $adapter = null)
    {
        if (is_null($adapter)) {
            $adapter = $this->getAdapter();
        }

        $adapter->setIdentity($this->getLogin());
        $adapter->setCredential($this->getPassword());

        $result = parent::authenticate($adapter);

        if ($result->isValid()) {
            $this->getStorage()->write($result->getIdentity());
        }

        return $result;
    }

    /**
     * @param AdapterInterface $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}
