<?php
namespace GrandCentral\PageBundle\Utils;

use Sonata\SeoBundle\Seo\SeoPage as SeoPage;
use Twig_Environment as Environment;

class PageMeta
{
    private $seoPage;
    private $twig;
    private $htmlClass;
    private $navSelected;
    private $pageTitle;
    private $metaDescription;
    private $metaKeywords;

    public function __construct(SeoPage $seoPage, Environment $twig){
        $this->seoPage = $seoPage;
        $this->twig = $twig;
    }

    public function setPageMeta(){
        if(isset($this->htmlClass)) $this->seoPage->addHtmlAttributes('class', $this->htmlClass);
        if(isset($this->pageTitle)){
            $this->seoPage->setTitle($this->pageTitle);
            $this->seoPage->addMeta('property', 'og:title', $this->pageTitle);
        }
        if(isset($this->metaDescription)){
           $this->seoPage->addMeta('name', 'description', $this->metaDescription);
           $this->seoPage->addMeta('property', 'og:description', $this->metaDescription);
        }
        if(isset($this->metaKeywords)) $this->seoPage->addMeta('name', 'keywords', $this->metaKeywords);
        $this->twig->addGlobal('navSelected', $this->navSelected);
    }


    public function getHtmlClass() {
        return $this->htmlClass;
    }

    public function setHtmlClass($htmlClass) {
        $this->htmlClass = $htmlClass;

        return $this;
    }


    public function getNavSelected() {
        return $this->navSelected;
    }

    public function setNavSelected($navSelected) {
        $this->navSelected = $navSelected;

        return $this;
    }


    public function getPageTitle() {
        return $this->pageTitle;
    }

    public function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;

        return $this;
    }


    public function getMetaDescription() {
        return $this->metaDescription;
    }

    public function setMetaDescription($metaDescription) {
        $this->metaDescription = $metaDescription;

        return $this;
    }


    public function getMetaKeywords() {
        return $this->metaKeywords;
    }

    public function setMetaKeywords($metaKeywords) {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }
}
