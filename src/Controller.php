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

        if (!empty($config['feed_template'])) {
            $template = $config['feed_template'];
        }

        if ($type === 'rss') {
            $template = '@rss-extension/rss.xml.twig';
            if (!empty($config['rss_template'])) {
                $template = $config['rss_template'];
            }
            $headerContentType = 'application/rss+xml;charset=UTF-8';
        } elseif ($type === 'atom') {
            $template = '@rss-extension/atom.xml.twig';

            if (!empty($config['atom_template'])) {
                $template = $config['atom_template'];
            }
            $headerContentType = 'application/atom+xml;charset=UTF-8';
        } else {
            $template = '@rss-extension/json.twig';

            if (!empty($config['json_template'])) {
                $template = $config['json_template'];
            }
            $headerContentType = 'application/json';
        }

        $response = $this->render($template, $context);
        $response->headers->set('Content-Type', $headerContentType);

        return $response;
    }
}
