# Basecom CronUI Bundle

<img src="docs/logo.svg" width="400">

The basecom CronUI is an extension for [Akeneo](https://akeneo.com) community and 
enterprise edition. It adds a new user interface which can be used to create, manage 
and delete cronjobs. Also, it allows the developers to create cronjobs through code.

<img src="docs/index.png" width="300">  <img src="docs/edit.png" width="300">

## Table of contents
1. [Installation](#installation)   
  1.1 [Requirements](#requirements)   
  1.2 [Install the bundle](#install-the-bundle)
2. [Usage](#usage)   
  2.1 [Define cronjobs in code](#define-cronjobs-in-code)   
  2.2 [Define cronjobs in ui](#define-cronjobs-in-ui)
3. [Examples](#examples)   
  3.1 [Run an export job every hour](#run-an-export-job-every-hour)   
  3.2 [Make an mysql backup and copy it via ssh](#make-an-mysql-backup-and-copy-it-via-ssh)
4. [Screenshots](#screenshots)
5. [Contributing](#contributing)
6. [Authors](#authors)
7. [License](#license)

## Installation

### Requirements

This bundle requires **[Akeneo 2.3 Community Edition](http://akeneo.com)** or higher. 
Also it requires **[PHP 7.1](http://php.net)** or higher.

### Install the bundle

1. Install this package via composer:
```bash
composer require basecom/akeneo-cron-ui
```

2. Follow the installation steps of the [Custom entity bundle](https://github.com/akeneo-labs/CustomEntityBundle) if not
already installed.

3. Add the bundle to the `AppKernel.php`:
```php
protected function registerProjectBundles()
{
	return [
		new \Basecom\Bundle\CronUiBundle\BasecomCronUiBundle(),
	];
}
```

4. Run the doctrine schema update to create the new cronjobs table
```bash
php ./bin/console doctrine:schema:update --dump-sql --env=prod
php ./bin/console doctrine:schema:update --force --env=prod

```

5. Add the `cronjobs:run` command to the crontab:
```crontab
* * * * * cd /path-to-your-project && php ./bin/console cronjobs:run >> /dev/null 2>&1
```

6. Clear all caches and regenerate front-end assets:
```bash
php ./bin/console cache:clear --env=prod --no-warmup
php ./bin/console cache:warmup --env=prod
php ./bin/console pim:installer:assets --symlink --clean --env=prod
yarn run webpack
```

## Usage

There are two ways to create cronjobs. You can create them via the user interface, 
and you may define them in code. The benefit of creating them via code is that you can 
execute regular PHP code. The cronjobs defined in the user interface can perform any 
shell command, including but not limited to the Symfony commands.

### Define cronjobs in code

> explain interface and abstract basic classes

### Define cronjobs in ui

> screenshots and step-for-step tutorial for the akeneo datagrid

## Examples

> short introduction to examples

### Run an export job every hour

> detailed code example how to make this   
> also explanation

### Make an mysql backup and copy it via ssh

> detailed code example how to make this   
> also explanation

## Screenshots

> some nice screenshots

## Contributing

> feel free to submit an issue or pr... security related issue e-mail... 

## Authors

> basecom logo (+ text) and profile picture of maintainer (me)

## License

Copyright basecom GmbH & Co. KG

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit
persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
