<?php

declare(strict_types=1);

namespace Bobdenotter\RssExtension;

use Bolt\Entity\Content;
use Bolt\Utils\Html;
use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFilter;

class Twig extends AbstractExtension
{
    /**
     * Register Twig filters.
     */
    public function getFilters(): array
    {
        $safe = [
            'is_safe' => ['html'],
        ];

        return [
            new TwigFilter('rss', [$this, 'rss'], $safe),
        ];
    }

    public function rot13($string): string
    {
        return str_rot13($string);
    }

    /**
     * Creates RSS safe content. Wraps it in CDATA tags, strips style and
     * scripts out. Can optionally also return a (cleaned) excerpt.
     */
    public function rss(string $result): Markup
    {
        $result = '<![CDATA[ ' . $result . ' ]]>';

        return new Markup($result, 'utf-8');
    }
}
