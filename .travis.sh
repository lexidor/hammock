#!/bin/sh
set -ex
apt update -y
DEBIAN_FRONTEND=noninteractive apt install -y php-cli zip unzip
hhvm --version
php --version

(
  cd $(mktemp -d)
  curl https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
)

runtime=$(hhvm --php -r "echo HHVM_VERSION[0] === '3' ? 'hhvm' : 'php';")
if [ "$runtime" = "hhvm" ]; then
  hhvm /usr/local/bin/composer install
else
  php /usr/local/bin/composer install
fi

use_polyfill=$(hhvm --php -r "echo HHVM_VERSION_ID < 42600 ? 'old' : 'new';")
if [ "$use_polyfill" = "old" ]; then
  rm src/__Private/fb_intercept_polyfill_new.php
else
  rm src/__Private/fb_intercept_polyfill_old.php
fi

hh_client

vendor/bin/hacktest tests/
