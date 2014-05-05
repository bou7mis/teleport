<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 04/05/14
 * Time: 21:15
 */

namespace Auth\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MemberAuthAdapter
 * @package Auth\Service
 */
class MemberAuthAdapter implements AdapterInterface, ServiceLocatorAwareInterface
{
    /**
     * @var
     */
    protected $identity;

    /**
     * @var
     */
    protected $credential;

    /**
     * @var ServiceLocatorInterface
     */
    protected $sl;

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
        $member = null;
        $code = Result::FAILURE;
        $messages = [];

        if ($login) {
            $em = $this->sl->get('Doctrine\ORM\EntityManager');
            $member = $em->getRepository('Application\Entity\Member')->findOneBy(['email' => $login]);

            if (!is_null($member) && $member->getPassword() == md5($password)) {
                $code = Result::SUCCESS;
                $messages = [];
                $member->setLastLoggedIn(new \DateTime());
                $em->persist($member);
            } else {
                $messages = ['Wrong login/password combination'];
            }
        } else {
            $messages = ['No login provided'];
        }

        return new Result($code, $member, $messages);
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

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->sl = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->sl;
    }
}