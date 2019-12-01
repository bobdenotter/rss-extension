<?php

declare(strict_types=1);

namespace Bobdenotter\RssExtension;

use Bolt\Extension\BaseExtension;
use Symfony\Component\Routing\Annotation\Route;


class Extension extends BaseExtension
{
    /**
     * Return the full name of the extension
     */
    public function getName(): string
    {
        return 'RSS Extension';
    }

    /**
     * Add the routes for this extension.
     *
     * Note: These are cached by Symfony. If you make modifications to this, run
     * `bin/console cache:clear` to ensure your routes are parsed.
     */
    public function getRoutes(): array
    {
        return [
            'rss_extension' => new \Symfony\Component\Routing\Route(
                '/feed/{type}.xml',
                ['_controller' => 'Bobdenotter\RssExtension\Controller::index'],
                ['type' => '(rss|atom)']
            ),
        ];
    }

    /**
     * Ran automatically, you can use this method to set up things in your
     * extension.
     *
     * Note: This runs on every request. Make sure what happens here is quick
     * and efficient.
     */
    public function initialize(): void
    {
        $this->registerWidget(new ReferenceWidget());
        $this->registerTwigExtension(new Twig());

        $this->addTwigNamespace('reference-extension');

    }

}
