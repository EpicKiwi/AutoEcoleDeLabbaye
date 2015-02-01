<?php

namespace Abbaye\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
//Entity Doctrine
use Abbaye\IndexBundle\Entity\Agences;
use Abbaye\IndexBundle\Entity\Tarifs;

class IndexController extends Controller
{

	//---------[ Actions par routing ]---------//
	//            Garder en premier !          //
	
    public function indexAction()
    {		//chargement de l'entity mnanager
		$Repository = $this	->getDoctrine()
							->getManager()
							->getRepository('AbbayeIndexBundle:Agences');
								
		//chargement du repository agences
		
		//On recupere une agence de permalien egal a l'adresse
		$Agence = $Repository->findOneBy(array('defaut' => true));
		if($Agence === null)
		  {
			throw $this->createNotFoundException('pas d\'agence par défaut');
		  }
		
		//chargement du repository tarifs
		$RepositoryTarifs = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Tarifs');
		
		//On recupere les tarifs de l'agence
		$Tarif = $RepositoryTarifs->findBy(array('agences' => $Agence->getId()));
		//On retourne le tout
		foreach($Tarif as $tari)
		{
		$tari->translateContenu();
		}
		return $this->render("AbbayeIndexBundle:Rouge:Acceuil.html.twig",array("Agence"=>$Agence,
																			   "Tarifs"=>$Tarif));
    }

    public function safetyAction()
	{
	
		$Agence = new Agences();
		$Repository = $this	->getDoctrine()
							->getManager()
							->getRepository('AbbayeIndexBundle:Agences');
		$Agence = $Repository->findOneBy(array('defaut' => true));
			if($Agence == NULL)
		{
			$AgenceSafety = new Agences();
			
			$em = $this->getDoctrine()->getManager();
			
			$AgenceSafety->setNom("Agence par défaut");
			$AgenceSafety->setDescription("Aucune agence par défaut n'a été séléctionnée celle ci a donc été crée. Vous pouvez la modifier dans le panneau d'administration.");
			$AgenceSafety->setTel("-");
			$AgenceSafety->setFax("-");
			$AgenceSafety->setAdresse("-");
			$AgenceSafety->setEmail("-");
			$AgenceSafety->setPermalien("Default");
			$AgenceSafety->setLogo("css/default.png");
			$AgenceSafety->setDefaut(true);
			
			$em->persist($AgenceSafety);
			$em->flush();
		}
	    return $this->redirect( $this->generateUrl('Acceuil') );
	}

	public function agenceAction($agence)
	{
		//chargement de l'entity mnanager
		$Repository = $this	->getDoctrine()
							->getManager()
							->getRepository('AbbayeIndexBundle:Agences');
								
		//chargement du repository agences
		
		//On recupere une agence de permalien egal a l'adresse
		$Agence = $Repository->findOneBy(array('permalien' => $agence));
		if($Agence === null)
		  {
			throw $this->createNotFoundException('L\'agence '.$agence.' n\'existe pas');
		  }
		
		//chargement du repository tarifs
		$RepositoryTarifs = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Tarifs');
		
		//On recupere les tarifs de l'agence
		$Tarif = $RepositoryTarifs->findBy(array('agences' => $Agence->getId()));
		//On retourne le tout
		foreach($Tarif as $tari)
		{
		$tari->translateContenu();
		}
		return $this->render("AbbayeIndexBundle:Rouge:Acceuil.html.twig",array("Agence"=>$Agence,
																			   "Tarifs"=>$Tarif));
	}
	
	public function tarifAction($agence,$tarif)
	{
		//chargement de l'entity mnanager
		$Repository = $this	->getDoctrine()
							->getManager()
							->getRepository('AbbayeIndexBundle:Agences');
								
		//chargement du repository agences
		
		//On recupere une agence de permalien egal a l'adresse
		$Agence = $Repository->findOneBy(array('permalien' => $agence));
		if($Agence === null)
		  {
			throw $this->createNotFoundException('L\'agence '.$agence.' n\'existe pas');
		  }
		
		//chargement du repository tarifs
		$RepositoryTarifs = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Tarifs');
		
		//On recupere les tarifs de l'agence
		$Tarif = $RepositoryTarifs->findOneBy(array('agences' => $Agence->getId(),'permalien' => $tarif));
		if($Tarif === null)
		  {
			throw $this->createNotFoundException('Le tarif '.$tarif.' n\'existe pas');
		  }
		$Tarif->translateContenu();
		
		//On retourne le tout
		return $this->render("AbbayeIndexBundle:Rouge:Tarif.html.twig",array("Agence"=>$Agence,
																			  "Tarif"=>$Tarif));
	}
	
	public function afficherflashnewsAction()
	{
	$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:FlashNew');
									
		$FlashNews = $Repository->FlashFindAll();
		return $this->render("AbbayeIndexBundle:Rouge:afficherflashnews.html.twig",array('flashnews'=>$FlashNews));
	}
	
	//----------[ Actions standards ]----------//
	//            Garder en dernier !          //
	
	public function menuAction()
	{
		$repository = $this->getDoctrine()
						   ->getManager()
						   ->getRepository('AbbayeIndexBundle:Agences');
		 
		$listeArticles = $repository->findAll();
		
		return $this->render("AbbayeIndexBundle:Rouge:menu.html.twig",array('listeArticles'=>$listeArticles));
	}
	
	public function flashnewsAction()
	{
		$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:FlashNew');
									
		$FlashNews = $Repository->FlashFindTen();
		return $this->render("AbbayeIndexBundle:Rouge:flashnews.html.twig",array('flashnews'=>$FlashNews));
	}
}
