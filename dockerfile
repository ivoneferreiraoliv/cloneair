# Use a imagem do PHP 5.6 com Apache
FROM php:5.6-apache

# Instale as extensões necessárias do PHP, incluindo mysqli
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ative o módulo de regravação do Apache
RUN a2enmod rewrite

# Copie o código do projeto para o diretório root do Apache
COPY . /var/www/html/

# Dê permissões ao diretório de cache e logs do CodeIgniter
RUN chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs

# Exponha a porta 80
EXPOSE 80
