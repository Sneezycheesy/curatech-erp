FROM php-8.2

RUN apt-get update -y && apt-get install -y libmcrypt-dev nodejs npm php8.2-mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

WORKDIR /app
COPY . /app

RUN composer install
RUN npm install
RUN npm run build


EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
