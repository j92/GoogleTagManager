<?php
// Google Tag Manager extension for Bolt

namespace Bolt\Extension\Ctors\GoogleTagManager;

use Bolt\Extensions\Snippets\Location as SnippetLocation;
use Bolt\Extension\Ctors\GoogleTagManager\GoogleDataLayer;

class Extension extends \Bolt\BaseExtension
{
    public function getName()
    {
        return "Google Tag Manager";
    }

    function initialize()
    {
        $this->addSnippet(SnippetLocation::START_OF_BODY, 'insertTagManager');

        // Define a twig function to push data to the DataLayer
        $this->addTwigFunction('GoogleDataLayerPush', 'twigGoogleDataLayerPush');

        // Insert the DataLayer at start of the body, before the TagManager
        $this->addSnippet(SnippetLocation::START_OF_BODY, 'insertDataLayer');
    }

    public function insertTagManager()
    {
        if (empty($this->config['gtm_container_id'])) {
            $this->config['gtm_container_id'] = "GTM-XXXXXX";
        }

        $html = <<< EOM

    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=%gtm_container_id%"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','%gtm_container_id%');</script>
    <!-- End Google Tag Manager -->
EOM;

        $html = str_replace("%gtm_container_id%", $this->config['gtm_container_id'], $html);

        return new \Twig_Markup($html, 'UTF-8');
    }

    public function insertDataLayer()
    {
        // Get DataLayer Service
        $googleDataLayerService = $this->app['GoogleDataLayer'];

        return new \Twig_Markup($googleDataLayerService->getDataLayerScript(), 'UTF-8');
    }

    /**
     * Enable users to push data to DataLayer from within their templates
     */
    public function twigGoogleDataLayerPush($key, $value = '')
    {

        // Get DataLayer Service
        $googleDataLayerService = $this->app['GoogleDataLayer'];

        // Push and validate the data
        $googleDataLayerService->pushData($key, $value);

    }

}
