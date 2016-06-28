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
        //SEO related
        $seoPage = $this->container->get('sonata.seo.page');
        $pageTitle = 'Homepage | ' . $this->getParameter('project_name');
        $seoPage
            ->setTitle($pageTitle)
            ->addMeta('property', 'og:title', $pageTitle)
            ->addMeta('name', 'keywords', 'homepage, content management, project')
            ->addMeta('name', 'description', 'The homepage of our CMS project.')
        ;

        return array();
    }
}
