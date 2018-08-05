<?php

namespace App\Controller;

use App\Entity\Advertisment;
use App\Entity\User;
use App\Controller\RegistrationController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ArticleController extends Controller
{
    /**
    * @Route("/", name="advertisment_list")
    * @Method({"GET"})
    */
    public function index()
    {
        $advertisments = $this->getDoctrine()->getRepository(Advertisment::class)->findAll();
        return $this->render('advertisments/index.html.twig', array
        ('advertisments' => $advertisments));
    }

    /**
     * @Route("/advertisment/new", name="new_advertisment")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function new(Request $request)
    {

        $advertisment = new Advertisment();

        $advertisment->setDate(new \DateTime('now'));
        $advertisment->setUser($this->getUser());

        $form = $this->createFormBuilder($advertisment)
          ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
          ->add('body', TextareaType::class, array(
            'required' => false,
            'attr' => array('class' => 'form-control')
          ))
          ->add('save', SubmitType::class, array(
            'label' => 'Create',
            'attr' => array('class' => 'btn btn-primary mt-3')
          ))
          ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $advertisment = $form->getData();
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($advertisment);
          $entityManager->flush();
          return $this->redirectToRoute('advertisment_list');
        }
        return $this->render('advertisments/new.html.twig', array(
          'form' => $form->createView()
        ));
    }
      

    /**
     * @Route("/advertisment/{id}", name="advertisment_show")
     */
    public function show($id) {
        $advertisment = $this->getDoctrine()->getRepository(Advertisment::class)->find($id);

        return $this->render('advertisments/show.html.twig', array
        ('advertisment' => $advertisment));
      }

    /**
     * @Route("/advertisment/delete/{id}", name="advertisment_delete")
     * @METHOD({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
      $advertisment = $this->getDoctrine()->getRepository(Advertisment::class)->find($id);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($advertisment);
      $entityManager->flush();

      $respones = new Response();
      $response->send();
    }
    /**
    * @Route("/own_list", name="own_list")
    * @Method({"GET"})
    */
    public function Own_adv(Request $request)
    {
      $advertisments = $this->getDoctrine()->getRepository(Advertisment::class)->findAll();
      return $this->render('advertisments/own.html.twig', array
      ('advertisments' => $advertisments));
    }

//    /**
//   * @Route("/advertisment/save")
//    */
//    public function save()
//    {
//        $entityManager = $this->getDoctrine()->getManager();

//        $advertisment = new Advertisment();
//        $advertisment->setTitle('Adv one');
//        $advertisment->setBody('This is body');

//        $entityManager->persist($advertisment);
        
//        $entityManager->flush();

//        return new Response('Saved adv
//        '.$advertisment->getId());
//   }

}