<?php

namespace Application\PageBundle\Controller;

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
            ->setPageTitle('Homepage | ' . $this->getParameter('project_name'))
            ->setMetaDescription('The homepage of our CMS project.')
            ->setMetaKeywords('homepage, cms, project')
            ->setPageMeta()
        ;

        return array();
    }
}
