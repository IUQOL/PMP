<?php

namespace XYK\PMP\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    private $translator;

    private function translate($label, $bundle = 'LocalizationBundle', $options = array())
    {
        return $this->translator->trans($label, $options, $bundle);
    }


    public function mainMenu(FactoryInterface $factory, array $options)
    {

        // $container = $this->getConfigurationPool()->getContainer();
        $this->translator = $this->container->get('translator');
        $admin_pool = $this->container->get('sonata.admin.pool');
        $security = $this->container->get('security.context'); //->isGranted('ROLE_SUPER_ADMIN');
        $token = $security->getToken();
        $user = $token->getUser();//
       // "attributes" => array("id" => 'nav'):
        $menu = $factory->createItem('root', array(
            'navbar' => true,
          //  'childrenAttributes' => array('class' => 'nav navbar-nav')
        ));

        if ($token != null && ($security->isGranted('ROLE_SONATA_ADMIN') || $security->isGranted('ROLE_SUPER_ADMIN'))) {
            $adminMenu = $menu->addChild('Administración', array(
                'uri' => '#',
                'dropdown' => true,
                'caret' => true,
                ));
            
            if ($security->isGranted('ROLE_SUPER_ADMIN'))
            {
                $adminMenu->addChild('Listado examenes', 
                               array('route' => 'userReport'));
            }

            foreach ($admin_pool->getDashboardGroups() as $group) {
                $display = (count($group['roles']) == 0) || $security->isGranted('ROLE_SUPER_ADMIN');
                if (!$display) {
                    foreach ($group['roles'] as $role) {
                        $display = $security->isGranted($role);
                    }

                }
                $item_count = 0;
                if ($display) {
                    foreach ($group['items'] as $admin) {
                        if ($admin->hasRoute('list') && $admin->isGranted('LIST')) {
                            $item_count++;
                        }
                    }
                }

                if ($display && ($item_count > 0)) {
                    $adminChild = $adminMenu->addChild($this->translate($group['label'], $group['label_catalogue']), 
                            array('uri' => '#',));

                    for ($i = 0; $i < sizeof($group['items']); $i++) {
                        $child = $adminChild->addChild($this->translate($group['items'][$i]->getLabel(), $group['items'][$i]->getTranslationDomain()),
                            array('route' => $group['items'][$i]->getBaseRouteName() . '_list',
                            ));
                    }

                }

            }
           
        }
        if ($security->isGranted('ROLE_EXAMNS') || $security->isGranted('ROLE_CATEGORY_EXAM') || $security->isGranted('ROLE_SEARCH_QUESTION') || $security->isGranted('ROLE_SUPER_ADMIN'))
        {
            $exam =$menu->addChild('Examenes', array(
                    'uri' => '#',
                    'dropdown' => true,
                    'caret' => true,
                    ));
            if ($security->isGranted('ROLE_EXAMNS') || $security->isGranted('ROLE_SUPER_ADMIN'))
            {
            $exam->addChild('Nuevo Examen', 
                               array('route' => 'getExam'));
            }
            if ($security->isGranted('ROLE_CATEGORY_EXAM') || $security->isGranted('ROLE_SUPER_ADMIN'))
            {
                
                $typeExam = $types = $this->container->get('doctrine')
                    ->getRepository('EntityBundle:ExamType')
                    ->findAll();
                $idExam = $user->getExamType()->getId();
                foreach($typeExam as $type)
                {
                   if ($security->isGranted('ROLE_SUPER_ADMIN') || $idExam == $type->getId() )
                   { 
                        if($type->getSubGroup())
                        {

                        $exam->addChild('Examen '.$type->getGroupName(), 
                                    array('route' => 'searchArea',
                                          'routeParameters' => array('idType' => 1, 'idTypeExam' => $type->getId()),
                                        ));

                        $exam->addChild('Examen '.$type->getAreaName(), 
                                    array('route' => 'searchArea',
                                          'routeParameters' => array('idType' => 2, 'idTypeExam' => $type->getId()),
                                        ));
                        }
                   }
                }
                
            
            }
            if ($security->isGranted('ROLE_SEARCH_QUESTION') || $security->isGranted('ROLE_SUPER_ADMIN'))
            {
            $exam->addChild('Buscar pregunta', 
                                array('route' => 'search'));
            }
        }
        if ($security->isGranted('ROLE_HISTORY') || $security->isGranted('ROLE_SUPER_ADMIN'))
        {
        $menu->addChild('Historial', array(
                'route' => 'history',
                ));
        }
//         $menu->addChild('Juego', array(
//                'route' => 'game',
//                ));
        return $menu;
    }


}
