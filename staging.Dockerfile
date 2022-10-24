FROM laravelphp/vapor:php82

COPY ./vapor/php.ini /usr/local/etc/php/conf.d/overrides.ini

COPY . /var/task
