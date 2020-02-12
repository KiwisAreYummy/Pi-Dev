<?php

namespace AuditionBundle\Controller;


use AuditionBundle\Entity\Audition;
use AuditionBundle\Form\AuditionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuditionController extends Controller
{
    public function ajouterAuditionAction(Request $request )
    {
        $audition=new Audition();
        $form = $this->createForm('AuditionBundle\Form\AuditionningType',$audition);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($audition);
            $em->flush();
            return $this->redirectToRoute('audition_showpage');

        }
        return $this->render('@Audition/audition/ajouterAudition.html.twig',array('Form'=>$form->createView()));
    }

    public function listerAuditionAction()
    {
        $em=$this->getDoctrine()->getManager();
        $auditions=$em->getRepository("AuditionBundle:Audition")->findAll();
        return $this->render("@Audition/audition/listerAudition.html.twig",array('auditions'=>$auditions));
    }

    public function supprimerAuditionAction(Request $request, $id)
    {
        $audition= new Audition();
        $em=$this->getDoctrine()->getManager();
        $audition=$em->getRepository("AuditionBundle:Audition")->findOneById($id);
        $em->remove($audition);
        $em->flush();
        return $this->redirectToRoute("audition_showpage");
    }

    public function modifierAuditionAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $audition=$em->getRepository("AuditionBundle:Audition")->find($id);
        $form=$this->createForm(AuditionType::class,$audition);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em->persist($audition);
            $em->flush();
            return $this->redirectToRoute("audition_showpage");
        }
        return $this->render("@Audition/audition/modifierAudition.html.twig",array('form'=>$form->createView()));

    }
}
