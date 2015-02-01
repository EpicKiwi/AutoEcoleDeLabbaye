<?php

namespace Abbaye\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
//Entity Doctrine
use Abbaye\IndexBundle\Entity\Agences;
use Abbaye\IndexBundle\Entity\Tarifs;
use Abbaye\IndexBundle\Entity\FlashNew;
//Classes Formulaire
use Abbaye\IndexBundle\Form\AgencesType;
use Abbaye\IndexBundle\Form\TarifsType;
use Abbaye\IndexBundle\Form\FlashNewType;

class AdminController extends Controller
{
	//---------[ Actions par routing ]---------//
	//            Garder en premier !          //
	
	public function affichageAction()
	{
		$request=$this->get('request');
		
		$FlashNew = new FlashNew();
		
		$form = $this->createForm(new FlashNewType, $FlashNew);
		
		$Repository = $this	->getDoctrine()
							->getManager()
							->getRepository('AbbayeIndexBundle:Agences');
							
		$Contenu = $Repository->findall();
		
		if($request->getMethod() == 'POST')
			{
			
			$form->bind($request);
					if($form->isValid())
					{
						$em = $this->getDoctrine()->getManager();
						$FlashNew->setDate($this->date = new \Datetime());
						$em->persist($FlashNew);
						$em->flush();
						
						$FlashNew = new FlashNew();
						$form = $this->createForm(new FlashNewType, $FlashNew);
						return $this->render("AbbayeIndexBundle:Admin:Liste.html.twig",array("contenu"=>$Contenu, "form"=>$form->createView(),"publie"=>true));
					}
			}
		
		return $this->render("AbbayeIndexBundle:Admin:Liste.html.twig",array("contenu"=>$Contenu, "form"=>$form->createView(),"publie"=>false));
	}
	
	public function afficherAction($type,$id)
	{
			if($type == 'agence')
			{
				$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Agences');
									
				$Agence = $Repository->find($id);
				
				$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Tarifs');
									
				$Tarifs = $Repository->findBy(array("agences"=>$Agence->getId()));
				
				return $this->render("AbbayeIndexBundle:Admin:AfficherAgence.html.twig",array("Agence"=>$Agence,"Tarifs"=>$Tarifs,"type"=>$type));
			}
			else if($type == 'tarif')
			{
				$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Tarifs');
									
				$Tarif = $Repository->find($id);
				
				$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Agences');
									
				$Agence = $Repository->findOneBy(array("id"=>$Tarif->getAgences()));
			$Tarif->translateContenu();
				
				return $this->render("AbbayeIndexBundle:Admin:AfficherTarif.html.twig",array("Agence"=>$Agence,"Tarif"=>$Tarif,"type"=>$type));
			}
			else
			{
			throw $this->createNotFoundException('Le type '.$type.' n\'est pas un type connu');
			}
	}
	public function creerAction($type,$id)
	{
			//On recupere la requete
			$request=$this->get('request');
			
			//Si ce n'est pas de type POST
			if($type == 'agence')
			{
				//on crée une nouvelle agence
				$Agence = new Agences();
				
				//on recupere le FormBuilder
				$form = $this->createForm(new AgencesType, $Agence);
							
				
			}
			else if($type == 'tarif')
			{
				//on crée une nouvelle agence
				$Tarif = new Tarifs();
				
				//on recupere le FormBuilder
				$form = $this->createForm(new TarifsType, $Tarif);
							
				
			}
			else
			{
			throw $this->createNotFoundException('Le type '.$type.' n\'est pas un type connu');
			}
			
			//Si c'est de type POST
			if($request->getMethod() == 'POST')
			{
			
			$form->bind($request);
				if($type == 'agence')
				{
					if($form->isValid())
					{
						$em = $this->getDoctrine()->getManager();
						$Agence->upload();
						$Agence->translatePermalien();
						$em->persist($Agence);
						$em->flush();
					return $this->redirect( $this->generateUrl('AdminAfficher', array('type' => 'agence','id' => $Agence->getId())) );
					}
				}
				else if($type == 'tarif')
				{
					if($form->isValid())
					{
						$em = $this->getDoctrine()->getManager();
						$Tarif->translatePermalien();
						$em->persist($Tarif);
						$em->flush();
					return $this->redirect( $this->generateUrl('AdminAfficher', array('type' => 'tarif','id' => $Tarif->getId())) );
					}
				}
			}
				
				//On lance le rendu
				return $this->render("AbbayeIndexBundle:Admin:Creer.html.twig",array("form"=>$form->createView(),"type"=>$type));
			
	}
	public function modifierAction($type,$id)
	{
			//On recupere la requete
			$request=$this->get('request');
			
			if($type == 'agence')
			{
				//on crée une nouvelle agence
				$Agence = new Agences();
				
				$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Agences');
									
				$Agence = $Repository->find($id);
				//on recupere le FormBuilder
				$form = $this->createForm(new AgencesType, $Agence);
							
				
			}
			else if($type == 'tarif')
			{
				//on crée une nouvelle agence
				$Tarif = new Tarifs();
				$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:Tarifs');
									
				$Tarif = $Repository->find($id);
				//on recupere le FormBuilder
				$Tarif->translatePermalien();
				$form = $this->createForm(new TarifsType, $Tarif);
							
				
			}
			else
			{
			throw $this->createNotFoundException('Le type '.$type.' n\'est pas un type connu');
			}
			
			//Si c'est de type POST
			if($request->getMethod() == 'POST')
			{
			
			$form->bind($request);
				if($type == 'agence')
				{
					if($form->isValid())
					{
						$em = $this->getDoctrine()->getManager();
						$Agence->upload();
						$Agence->translatePermalien();
						$em->persist($Agence);
						$em->flush();
					return $this->redirect( $this->generateUrl('AdminAfficher', array('type' => 'agence','id' => $Agence->getId())) );
					}
				}
				else if($type == 'tarif')
				{
					if($form->isValid())
					{
						$em = $this->getDoctrine()->getManager();
						$em->persist($Tarif);
						$em->flush();
					return $this->redirect( $this->generateUrl('AdminAfficher', array('type' => 'tarif','id' => $Tarif->getId())) );
					}
				}
			}
				
				//On lance le rendu
				return $this->render("AbbayeIndexBundle:Admin:Creer.html.twig",array("form"=>$form->createView(),"type"=>$type));
			
	}
	public function supprimerAction($type,$id)
	{
			$form = $this->createFormBuilder()->getForm();
			$request = $this->getRequest();
			if($type == 'agence')
			{
				$Agence = $this	->getDoctrine()
								->getRepository('Abbaye\IndexBundle\Entity\Agences')
								->find($id);
				
				if($request->getMethod() == 'POST')
				{
					$form->bind($request);
					if($form->isValid())
					{
					$em = $this->getDoctrine()->getManager();
					$em->remove($Agence);
					$RepositoryTarifs = $this	->getDoctrine()
												->getManager()
												->getRepository('AbbayeIndexBundle:Tarifs');
					$Tarif = $RepositoryTarifs->findBy(array('agences' => $Agence->getId()));
					foreach($Tarif as $tari)
					{
					$em->remove($tari);
					}
					$em->flush();
					return $this->redirect( $this->generateUrl('AdminAffichage', array('type' => 'agence')) );
					}
				}
			return $this->render("AbbayeIndexBundle:Admin:Supprimer.html.twig",array("form"=>$form->createView(),"type"=>$type,'id' =>$id));
			
			}
			else if($type == 'tarif')
			{
				$Tarifs = $this	->getDoctrine()
								->getRepository('Abbaye\IndexBundle\Entity\Tarifs')
								->find($id);
				
				if($request->getMethod() == 'POST')
				{
					$form->bind($request);
					if($form->isValid())
					{
					$em = $this->getDoctrine()->getManager();
					$em->remove($Tarifs);
					$em->flush();
					return $this->redirect( $this->generateUrl('AdminAffichage', array('type' => 'agence')) );
					}
				}
			return $this->render("AbbayeIndexBundle:Admin:Supprimer.html.twig",array("form"=>$form->createView(),"type"=>$type,'id' =>$id));
			
			}
			else if($type == 'flashnew')
			{
				$flashnew = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:FlashNew')
									->find($id);
				
				if($request->getMethod() == 'POST')
				{
					$form->bind($request);
					if($form->isValid())
					{
					$em = $this->getDoctrine()->getManager();
					$em->remove($flashnew);
					$em->flush();
					return $this->redirect( $this->generateUrl('AdminFlashNews') );
					}
				}
			return $this->render("AbbayeIndexBundle:Admin:Supprimer.html.twig",array("form"=>$form->createView(),"type"=>$type,'id' =>$id));
			
			}
			else
			{
			throw $this->createNotFoundException('Le type '.$type.' n\'est pas un type connu');
			}
	}
			
			public function FlashNewsAction()
			{
				$Repository = $this	->getDoctrine()
									->getManager()
									->getRepository('AbbayeIndexBundle:FlashNew');
									
				$FlashNews = $Repository->FlashFindAll();
				return $this->render("AbbayeIndexBundle:Admin:Flashnews.html.twig",array('contenu'=>$FlashNews));
			}
}
