<?php
/**
 * @Author: Sebastian Castro
 * @Date:   2017-03-28 15:29:03
 * @Last Modified by:   Sebastian Castro
 * @Last Modified time: 2017-07-28 10:46:05
 */
namespace Biopen\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ConfigurationAdmin extends AbstractAdmin
{
    protected $datagridValues = array(
        '_page' => 1,
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $featureStyle = array('class' => 'col-md-6 col-lg-3');
        $contributionStyle = array('class' => 'col-md-6 col-lg-4');
        $featureFormOption = ['delete' => false, 'required'=> false, 'label_attr'=> ['style'=> 'display:none']];
        $featureFormTypeOption = ['edit' => 'inline'];
        $formMapper
            ->tab('Fonctionalités')
                ->with('Favoris', $featureStyle)
                    ->add('favoriteFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Partage de l\'URL', $featureStyle)
                    ->add('shareFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Export Iframe', $featureStyle)
                    ->add('exportIframeFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Calcul Itinéraire', $featureStyle)
                    ->add('directionsFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Signalement d\'une erreur', $featureStyle)
                    ->add('reportFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Affichage des acteurs en attente de validation', $featureStyle)
                    ->add('pendingFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
            ->end()
            ->tab('Contributions/Modération')
                ->with('Pouvoir ajouter un acteur', $contributionStyle)
                    ->add('addFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Pouvoir editer un acteur', $contributionStyle)
                    ->add('editFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Pouvoir supprimer un acteur', $contributionStyle)
                    ->add('deleteFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Modération directe', $contributionStyle)
                    ->add('directModerationFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()
                ->with('Modération collaborative (votes)', $contributionStyle)
                    ->add('collaborativeModerationFeature','sonata_type_admin', $featureFormOption, $featureFormTypeOption)->end()                
                ->with('Paramètres pour la modération collaborative' , array('class' => 'col-md-4'))
                    ->add('minVoteToChangeStatus', null, ['required'=>false, 'label' => "Nombre votes pour valider/refuser automatiquement"])
                    ->add('maxOppositeVoteTolerated', null, ['required'=>false, 'label' => "Nombres maximum de vos contradictoires tolérés"])
                    ->add('minDayBetweenContributionAndCollaborativeValidation', null, ['required'=>false, 'label' => "Nombre de jours minimum avant une validation/refus collaboratif"])
                ->end()
            ->end()
            ->tab('Carte')  
                ->with('Map', array('class' => 'col-md-6'))
                    ->add('defaultTileLayer', 'sonata_type_model', array(
                            'class'=> 'Biopen\CoreBundle\Document\TileLayer', 
                            'required' => true, 
                            'label' => 'Fond de carte par défaut'))
                    ->add('defaultNorthEastBoundsLat')
                    ->add('defaultNorthEastBoundsLng')
                    ->add('defaultSouthWestBoundsLat')
                    ->add('defaultSouthWestBoundsLng')
                ->end()
            ->end()
            ->tab('Style')     
                ->with('Style principal', array('class' => 'col-md-6'))
                    ->add('mainFont', null, array('label' => 'Police principale'))  
                    ->add('titleFont', null, array('label' => 'Police de titre')) 

                    ->add('neutralDarkColor', 'xmon_color_picker', array('label' => 'Couleur Neutre sombre'))  
                    ->add('neutralSoftDarkColor', 'xmon_color_picker', array('label' => 'Couleur Neutre sombre adoucie'))  
                    ->add('neutralColor', 'xmon_color_picker', array('label' => 'Couleur Neutre'))  
                    ->add('neutralLightColor', 'xmon_color_picker', array('label' => 'Couleur Neutre claire'))  
                    ->add('secondaryColor', 'xmon_color_picker', array('label' => 'Couleur Secondaire'))  
                    ->add('primaryColor', 'xmon_color_picker', array('label' => 'Couleur Primaire'))  
                    ->add('backgroundColor', 'xmon_color_picker', array('label' => 'Couleur de fond de page'))  
                    ->add('textColor', 'xmon_color_picker', array('label' => 'Couleur de texte'))      
                ->end()
                    // CUSTOM COLORS & FONTS
                ->with('Style avancé', array('class' => 'col-md-6'))
                    ->add('headerColor', 'xmon_color_picker', array('label' => 'Couleur header'))  
                    ->add('searchBarColor', 'xmon_color_picker', array('label' => 'Couleur search bar'))  
                    ->add('disableColor', 'xmon_color_picker', array('label' => 'Couleur désactivé'))  
                    ->add('neutralDarkTransparentColor', 'xmon_color_picker', array('label' => 'Couleur neutre sombre semi transparente')) 
                    ->add('listTitleColor', 'xmon_color_picker', array('label' => 'Couleur titre liste'))  
                    ->add('listTitleBackBtnColor', 'xmon_color_picker', array('label' => 'Couleur titre liste bouton retour'))  
                    ->add('listTitleBackgroundColor', 'xmon_color_picker', array('label' => 'Couleur fond titre liste'))  
                    ->add('pendingColor', 'xmon_color_picker', array('label' => 'Couleur pending'))  
                    ->add('interactiveSectionColor', 'xmon_color_picker', array('label' => 'Couleur Interactive section'))  
                    
                    ->add('taxonomyMainTitleFont', null, array('label' => 'Police titre taxonomie'))    

                    ->add('customCSS', 'textarea', array('label' => 'Custom CSS')) 
                ->end()
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array()
                )
            ));
    }
}