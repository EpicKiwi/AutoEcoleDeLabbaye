<?php

namespace lelycan\indexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use lelycan\indexBundle\Entity\projet;
use lelycan\indexBundle\Entity\fichier;
use lelycan\indexBundle\Entity\upload;
use lelycan\indexBundle\Entity\commentaire;

use lelycan\indexBundle\Form\uploadType;

class DefaultController extends Controller
{
    function indexAction()
    {
    return $this->redirect( $this->generateUrl('projet', array('id' => 2)) );
    }
    
    function projetAction($id)
    {
    $doctrine = $this->getDoctrine()
                      ->getManager();
        
    $repository = $doctrine->getRepository('lelycanindexBundle:projet');
 
    $projet = $repository->loadAll($id);
    
    $listeFichiers = $projet->getfichiers();
    
    $formCommentaire = new commentaire;
    
    
    $formBuilder = $this->createFormBuilder($formCommentaire);
    $formBuilder
            ->add('nom','text')
            ->add('contenu','textarea');
    $form = $formBuilder->getForm();
    
    return $this->render('lelycanindexBundle:index:projet.html.twig', array('id'  => $id, "projet" => $projet, 'listeFichiers' => $listeFichiers, "formCommentaire" => $form->createView()));
    }
    
    function ajouterCommentaireAction($id)
    {
    $doctrine = $this->getDoctrine()
                      ->getManager();
        
    $projetrepository = $doctrine->getRepository('lelycanindexBundle:projet');
    $projet = $projetrepository->find($id);
    
    $formCommentaire = new commentaire;
    
    $formBuilder = $this->createFormBuilder($formCommentaire);
    $formBuilder
            ->add('nom','text')
            ->add('contenu','textarea');
    $form = $formBuilder->getForm();
    
    $request = $this->get('request');
    if ($request->getMethod() == 'POST')
    {
        $form->bind($request);
        if ($form->isValid())
        {
            $formCommentaire->setProjet($projet);
            $formCommentaire->setDate(new \DateTime);
            $doctrine->persist($formCommentaire);
            $doctrine->flush();
            
            return $this->redirect($this->generateUrl('projet',array("id"=>$id)));
        }
    }
    
            
    return $this->redirect($this->generateUrl('projet',array("id"=>$id)));  
    }
    
    function mettreAjourAction($id,$fichierId)
    {
    $doctrine = $this->getDoctrine()
                      ->getManager();
        
    $projetrepository = $doctrine->getRepository('lelycanindexBundle:projet');
    $projet = $projetrepository->find($id);
    $fichierrepository = $doctrine->getRepository('lelycanindexBundle:fichier');
    $fichier = $fichierrepository->find($fichierId);
    
    
    $upload = new upload;
    $form = $this->createForm(new uploadType, $upload);
    
    $request = $this->get('request');
    if ($request->getMethod() == 'POST')
    {
        $form->bind($request);
        if ($form->isValid())
        {
            $upload->setFichier($fichier);
            $upload->setDate(new \DateTime);
            $doctrine->persist($upload);
            $doctrine->flush();
            
            return $this->redirect($this->generateUrl('projet',array("id"=>$id)));
        }
    }
    
    return $this->render('lelycanindexBundle:index:update.html.twig', array('id'  => $id, "projet" => $projet, 'fichierId' => $fichierId, "fichier" => $fichier,"form" => $form->createView()));   
    }
    
    function supprimerAction($id,$updateId)
    {
    $doctrine = $this->getDoctrine()
                      ->getManager();
        
    $projetrepository = $doctrine->getRepository('lelycanindexBundle:projet');
    $projet = $projetrepository->find($id);
    $upload = new upload;
    $uploadrepository = $doctrine->getRepository('lelycanindexBundle:upload');
    $upload = $uploadrepository->find($updateId);
    $form = $this->createFormBuilder()->getForm();
    
    $request = $this->get('request');
    if ($request->getMethod() == 'POST')
    {
        $form->bind($request);
        if ($form->isValid())
        {
            $doctrine->remove($upload);
            $doctrine->flush();
            
            return $this->redirect($this->generateUrl('projet',array("id"=>$id)));
        }
    }
    
    return $this->render('lelycanindexBundle:index:supprimer.html.twig', array('id'  => $id, "projet" => $projet, "upload" => $upload,"form" => $form->createView()));   
    }
    
    function editerDescriptionAction($id)
    {
    $projet = new projet;
    $doctrine = $this->getDoctrine()
                      ->getManager();
        
    $projetrepository = $doctrine->getRepository('lelycanindexBundle:projet');
    $projet = $projetrepository->find($id);
    
    $formBuilder = $this->createFormBuilder($projet);
    $formBuilder->add('description','textarea');
    $form = $formBuilder->getForm();
    
    $request = $this->get('request');
    if ($request->getMethod() == 'POST')
    {
        $form->bind($request);
        if ($form->isValid())
        {
            $doctrine->persist($projet);
            $doctrine->flush();
            
            return $this->redirect($this->generateUrl('projet',array("id"=>$id)));
        }
    }
    
    return $this->render('lelycanindexBundle:index:editerDescription.html.twig', array('id'  => $id, "projet" => $projet,"form" => $form->createView(),"titre"=>"Modifier la déscription"));   
    }
    
        function ajouterFichierAction($id)
    {
    $fichier = new fichier;
    $doctrine = $this->getDoctrine()
                      ->getManager();
        
    $projetrepository = $doctrine->getRepository('lelycanindexBundle:projet');
    $projet = $projetrepository->find($id);
    
    $formBuilder = $this->createFormBuilder($fichier);
    $formBuilder->add('nom','text')
                ->add('type','text');
    $form = $formBuilder->getForm();
    
    $request = $this->get('request');
    if ($request->getMethod() == 'POST')
    {
        $form->bind($request);
        if ($form->isValid())
        {
            $fichier->setDate(new \DateTime);
            $fichier->setProjet($projet);
            $doctrine->persist($fichier);
            $doctrine->flush();
            
            return $this->redirect($this->generateUrl('projet',array("id"=>$id)));
        }
    }
    
    return $this->render('lelycanindexBundle:index:ajouterFichier.html.twig', array('id'  => $id, "projet" => $projet,"form" => $form->createView(),"titre"=>"Ajouter un fichier"));   
    }
	
	public function loginAction()
	{
    // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      return $this->redirect($this->generateUrl('index'));
    }
 
    $request = $this->getRequest();
    $session = $request->getSession();
 
    // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    } else {
      $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
      $session->remove(SecurityContext::AUTHENTICATION_ERROR);
    }
 
    return $this->render('lelycanindexBundle:index:login.html.twig', array(
      // Valeur du précédent nom d'utilisateur entré par l'internaute
      'last_username' => $session->get(SecurityContext::LAST_USERNAME),
      'error'         => $error
    ));
	}
}
