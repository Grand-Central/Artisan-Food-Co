<?php

namespace GrandCentral\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function homepageAction()
    {
        //SEO & Layout config
        $this->get('application.page.meta')
            ->setHtmlClass('homepage')
            ->setNavSelected('Home')
            ->setPageTitle($this->getParameter('project_name') . ' | Duck Fritons & Chorizo Thins')
            ->setMetaDescription('We are a small start up based in Twyford, Berkshire making premium, artisan pub snacks for top end pubs, bars and hotels.')
            ->setMetaKeywords($this->getParameter('project_name') . ', Duck Fritons, Chorizo Thins, Twyford, pub snacks')
            ->setPageMeta()
        ;

        return array();
    }
}
