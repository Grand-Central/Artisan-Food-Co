<?php

namespace Application\ContactFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Application\ContactFormBundle\Form\ContactType;
use Application\ContactFormBundle\Entity\Contact;

class ContactFormController extends Controller
{
    /**
     * @Route("/contact-form/", name="applicaiton_contact_form")
     * @Template()
     */
    public function formAction(Request $request)
    {

        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact, array(
            'action' => $this->generateUrl('applicaiton_contact_form')
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject($this->container->getParameter('application_contact_form.email_subject'))
                ->setFrom($this->container->getParameter('application_contact_form.email_from'))
                ->setTo($this->container->getParameter('application_contact_form.email_to'))
                ->setBody(
                    $this->container->get('templating')->render(
                        'ApplicationContactFormBundle:ContactForm:email.html.twig',
                        array('contact' => $contact)
                    ),
                    'text/html'
                )
            ;
            $this->container->get('mailer')->send($message);

            return $this->render('ApplicationContactFormBundle:ContactForm:success.html.twig');
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
