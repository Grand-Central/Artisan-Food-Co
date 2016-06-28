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
        $htmlClass = 'homepage';
        $navSelected = 'Home';
        $pageTitle = 'Homepage | ' . $this->getParameter('project_name');
        $pageDescription = 'The homepage of our CMS project.';

        $this->container->get('sonata.seo.page')
            ->addHtmlAttributes('class', $htmlClass)
            ->setTitle($pageTitle)
            ->addMeta('property', 'og:title', $pageTitle)
            ->addMeta('name', 'keywords', 'homepage, content management, project')
            ->addMeta('name', 'description', $pageDescription)
            ->addMeta('property', 'og:description', $pageDescription)
        ;

        return array(
            'navSelected' => $navSelected
        );
    }
}
