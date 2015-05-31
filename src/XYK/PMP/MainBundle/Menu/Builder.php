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
        
        $exam =$menu->addChild('Examenes', array(
                'uri' => '#',
                'dropdown' => true,
                'caret' => true,
                ));
        
        $exam->addChild('Nuevo Examen', 
                           array('route' => 'exam'));
        $exam->addChild('Examen por Area', 
                            array('route' => 'searchArea'));
        $exam->addChild('Pregunta', 
                            array('route' => 'search'));
        
        $menu->addChild('Historial', array(
                'route' => 'history',
                ));

//        if ($security->isGranted('ROLE_ADMIN') || $security->isGranted('ROLE_SCHEDULE') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//            $scheduleMenu = $menu->addChild($this->translate('Menu.schedule.label'), array('uri' => '#'));
//
//            if ($security->isGranted('ROLE_SCHEDULE') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $scheduleMenu->addChild($this->translate('Menu.schedule.create'),
//                    array('route' => '_grid_schedule_rules'));
//
//                $scheduleMenu->addChild($this->translate('Menu.schedule.room'),
//                    array('route' => '_grid_room'));
//            }
//            if ($security->isGranted('ROLE_SCHEDULE') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $scheduleMenu->addChild($this->translate('Menu.schedule.appointment'),
//                    array('route' => 'schedule_appointment'));
//            }
//            if ($security->isGranted('ROLE_SCHEDULE') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $scheduleMenu->addChild($this->translate('Menu.appointmentSchedule'),
//                    array('route' => '_grid_schedule_appointment'));
//            }
//        }
//
//        if ($security->isGranted('ROLE_ADMIN') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//            $menu->addChild($this->translate('Menu.modify'),
//                array('route' => 'patient_modifyDataPatient'));
//        }
//
//
//        if ($security->isGranted('ROLE_PATIENT_SEARCH') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//            $menu->addChild($this->translate('Menu.findPatient'),
//                array('route' => 'main_grid'));
//        }
//
//
//        if ($security->isGranted('ROLE_RECEIVE') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//            $menu->addChild($this->translate('receive.receive_name'),
//                array('route' => 'receive_homepage'));
//        }
//
//
//        if ($security->isGranted('ROLE_ASISTENTIAL') || $security->isGranted('ROLE_READING') || $security->isGranted('ROLE_TRANSCRIPTION') || $security->isGranted('ROLE_VALIDATION') || $security->isGranted('ROLE_ADENDUM') || $security->isGranted('ROLE_CONCORDANCE') || $security->isGranted('ROLE_CLINICAL_FILE') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//            $workMenu = $menu->addChild($this->translate('Menu.flux'), array('uri' => '#'));
//            if ($security->isGranted('ROLE_ASISTENTIAL') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $workMenu->addChild($this->translate('Menu.actuali'),
//                    array('route' => 'UpdateStudyData_Worklist'));
//            }
//
//            if ($security->isGranted('ROLE_READING') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $workMenu->addChild($this->translate('Menu.reading'),
//                    array('route' => 'reading_DictationWorklist'));
//            }
//
//            if ($security->isGranted('ROLE_TRANSCRIPTION') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $workMenu->addChild($this->translate('Menu.ultrasoundworklist'),
//                    array('route' => '_grid_ultrasound'));
//                $workMenu->addChild($this->translate('Menu.transcrip'),
//                    array('route' => 'reading_TranscriptionWorklist'));
//
//            }
//            if ($security->isGranted('ROLE_VALIDATION') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $workMenu->addChild($this->translate('Menu.validate'),
//                    array('route' => 'reading_ValidateWorklist'));
//            }
//
//            if ($security->isGranted('ROLE_ADENDUM') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $workMenu->addChild($this->translate('Menu.adendum1'),
//                    array('route' => 'adendum_adendumWorklist'));
//            }
//
//            if ($security->isGranted('ROLE_CONCORDANCE') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $workMenu->addChild($this->translate('Menu.concordancia'),
//                    array('route' => 'grid_concorcance'));
//            }
//            if ($security->isGranted('ROLE_READING') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $workMenu->addChild($this->translate('Menu.clinicalfile'),
//                    array('route' => '_grid_clinical_file'));
//            }
//
//        }
//
//        if ($security->isGranted('ROLE_DELIVERY_RESULTS') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//            $menu->addChild($this->translate('Menu.delivery'),
//                array('route' => 'appointment_DeliveryResultsWorklist'));
//        }
//
//        if ($security->isGranted('ROLE_INDICATORS') || $security->isGranted('ROLE_DASHBOARD') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//            $indicatorMenu = $menu->addChild($this->translate('Menu.indicator'), array('uri' => '#'));
//            if ($security->isGranted('ROLE_DASHBOARD') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $indicatorMenu->addChild($this->translate('Dashboard.dashboard'),
//                    array('route' => 'indicator_dashBoard'));
//            }
//            if ($security->isGranted('ROLE_INDICATORS') || $security->isGranted('ROLE_SUPER_ADMIN')) {
//                $indicatorMenu->addChild($this->translate('Indicator_technologist.menu'),
//                    array('route' => 'indicator_technologist_view'));
//
//                $indicatorMenu->addChild($this->translate('Reading_indicator.reading_indicator'),
//                    array('route' => 'reading_indicator'));
//
//                $indicatorMenu->addChild($this->translate('Indicator_transcription.indicator_transcription'),
//                    array('route' => 'indicator_transcription'));
//
//                $indicatorMenu->addChild($this->translate('Indicator_delivery_result.menu'),
//                    array('route' => 'indicator_delivery_result'));
//
//                $indicatorMenu->addChild($this->translate('Indicator_modalidad_convenios.menu'),
//                    array('route' => 'indicator_modality_agreement'));
//
//                $indicatorMenu->addChild($this->translate('Indicator_studies_agreement.menu'),
//                    array('route' => 'indicator_studies_agreement'));
//
//                $indicatorMenu->addChild($this->translate('Indicator_estudios_radiologo.menu'),
//                    array('route' => 'indicator_studies_radiologist'));
//
//                $indicatorMenu->addChild($this->translate('Indicator_modality_provenances.menu'),
//                    array('route' => 'indicator_modality_provenances_view'));
//
//                $indicatorMenu->addChild($this->translate('Indicator_oportunity_process.menu'),
//                    array('route' => 'indicator_oportunity_process_view'));
//
//                $indicatorMenu->addChild($this->translate('indicator_birads.menu'),
//                    array('route' => 'indicator_birads'));
//                
//                $indicatorMenu->addChild($this->translate('indicator_sms_notifications.menu'),
//                    array('route' => 'indicator_sms_notifications'));
//
//            }
//
//        }
//
//
//        $userMenu = $menu->addChild($this->translate('sonata_profile_title', 'SonataUserBundle'),
//            array('route' => 'sonata_user_profile_show'));
//        $userMenu->addChild($this->translate('sonata_user_profile_breadcrumb_edit', 'SonataUserBundle'),
//            array('route' => 'sonata_user_profile_edit'));
//
//        $userMenu->addChild($this->translate('title_user_edit_authentication', 'SonataUserBundle'),
//            array('route' => 'sonata_user_profile_edit_authentication'));
//
//        $userMenu->addChild($this->translate('sonata_change_password_link', 'SonataUserBundle'),
//            array('route' => 'sonata_user_change_password'));
//
//        $userMenu->addChild('Authenticator', array('route' => 'steeps_info'));
//
//
//        $menu->addChild($this->translate('changeHeadquarter.headquarterChange'),
//
//            array('uri' => '#',
//                'attributes' => array('id' => 'change_head')));

//        // Add a regular child with an icon, icon- is prepended automatically
//        $layout = $menu->addChild('Layout', array(
//            'route' => 'main_homepage',
//        ));
//
//        // Create a dropdown with a caret
//        $dropdown = $menu->addChild('Forms', array(
//            'dropdown' => true,
//            'caret' => true,
//        ));
//
//        // Create a dropdown header
//        $dropdown->addChild('Some Header', array('dropdown-header' => true));
//        $dropdown->addChild('Example 1', array('route' => 'appointment_DeliveryResultsWorklist'));

        return $menu;
    }


}
