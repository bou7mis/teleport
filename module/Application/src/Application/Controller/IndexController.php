<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Member;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
//        return new ViewModel();
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $member = new Member();
        $member->setFirstName('Ahmed')->setLastName('ZERZERI')->setEmail('ahmed.zerzeri@gmail.com')
            ->setPassword(md5('123456'))->setLastLoggedIn(new \DateTime());
        $entityManager->persist($member);
        $entityManager->flush();
        die(var_dump($member->getId()));
    }
}
