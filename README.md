# Bolt RSS Extension 

Author: Bob den Otter

This Bolt extension can be used to create RSS, Atom and JSON feeds for your 
Bolt website. 

Installation:

```bash
composer require bobdenotter/rss-extension 
```

After installation, configure the workings of the extension in 
`config/extensions/bobdenotter-rssextension.yaml`. 

-------

The part below is only for _developing_ the extension. Not required for general
usage of the extension in your Bolt Project.

## Running PHPStan and Easy Codings Standard

First, make sure dependencies are installed:

```bash
COMPOSER_MEMORY_LIMIT=-1 composer update
```

And then run ECS:

```bash
vendor/bin/ecs check src --fix
```
