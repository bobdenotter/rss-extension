<?php

declare(strict_types=1);

namespace Bobdenotter\RssExtension;

use Bolt\Extension\ExtensionController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends ExtensionController
{
    public function feed($type = 'foo', $extension = 'xml'): Response
    {
        $config = $this->getConfig()->get('sitewide');
        $contentType = (array) $config['content_types'];

        $context = [
            'type' => $type,
            'contenttype' => $contentType,
            'feed_records' => $config['feed_records'],
            'content_length' => $config['content_length'],
        ];

        if ($type === 'rss') {
            $template = '@rss-extension/rss.xml.twig';
            $headerContentType = 'application/rss+xml;charset=UTF-8';
        } elseif ($type === 'atom') {
            $template = '@rss-extension/atom.xml.twig';
            $headerContentType = 'application/atom+xml;charset=UTF-8';
        } else {
            $template = '@rss-extension/json.twig';
            $headerContentType = 'application/json';
        }

        if ($config['feed_template']) {
            $template = $config['feed_template'];
        }

        $response = $this->render($template, $context);
        $response->headers->set('Content-Type', $headerContentType);

        return $response;
    }
}
