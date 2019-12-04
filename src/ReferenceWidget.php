<?php

declare(strict_types=1);

namespace Bobdenotter\RssExtension;

use Bolt\Widget\BaseWidget;
use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\Injector\Target;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ReferenceWidget extends BaseWidget
{
    protected $name = 'autodiscovery widget';
    protected $target = Target::END_OF_HEAD;
    protected $zone = RequestZone::FRONTEND;
    protected $priority = 200;

    protected function run(array $params = []): ?string
    {
        $config = $this->getExtension()->getConfig();

        if (! $config['autodiscovery']) {
            return '';
        }

        $router = $this->getExtension()->getService('router');

        $snippet = [];
        if ($config['feeds']['rss']) {
            $snippet[] = sprintf(
                '<link rel="alternate" type="application/rss+xml" title="RSS feed" href="%srss/feed.xml">',
                $router->generate('homepage', [], UrlGeneratorInterface::ABSOLUTE_URL)
            );
        }
        if ($config['feeds']['json']) {
            $snippet[] = sprintf(
                '<link rel="alternate" type="application/json" title="JSON feed" href="%sjson/feed.json">',
                $router->generate('homepage', [], UrlGeneratorInterface::ABSOLUTE_URL)
            );
        }
        if ($config['feeds']['atom']) {
            $snippet[] = sprintf(
                '<link rel="alternate" type="application/atom+xml" title="Atom feed" href="%satom/feed.xml">',
                $router->generate('homepage', [], UrlGeneratorInterface::ABSOLUTE_URL)
            );
        }

        return implode("\n", $snippet);
    }
}
