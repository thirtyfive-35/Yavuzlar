# PHP 8.0 ve Apache içeren resmi Docker imajını kullan
FROM php:8.0-apache

# Çalışma dizini ayarlama
WORKDIR /var/www/html

# Proje dosyalarınızı kopyalama
COPY . .

# Gerekli uzantıları yükleyin
RUN docker-php-ext-install pdo pdo_mysql

RUN chown -R www-data:www-data /var/www/html

RUN mkdir -p /var/www/html/uploads/company_logos

RUN chown -R www-data:www-data /var/www/html/uploads

# Apache'yi başlat
CMD ["apache2-foreground"]
