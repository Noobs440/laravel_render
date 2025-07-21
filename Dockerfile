# Étape 1 — PHP + Apache + extensions Laravel
FROM php:8.2-apache

# Installe extensions requises par Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Active mod_rewrite pour les routes Laravel
RUN a2enmod rewrite

# Copie le projet dans le conteneur
COPY . /var/www/html/

# Change le dossier web root vers /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Donne les droits d'accès corrects
RUN chown -R www-data:www-data /var/www/html

# Installe Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installe les dépendances Laravel et optimise
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache

# Expose le port 80 pour le serveur Apache
EXPOSE 80
