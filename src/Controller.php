<?php


namespace Bobdenotter\RssExtension;


use Bolt\Extension\ExtensionController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends ExtensionController
{
    public function index($name = 'foo'): Response
    {
        $context = [
            'title' => 'AcmeCorp Reference Extension',
            'name' => $name,
        ];


//        $config = $this->extension->getConfig();

        dump($this->getConfig());



        return $this->render('@reference-extension/page.html.twig', $context);
    }

}