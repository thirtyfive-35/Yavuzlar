# PHP 8.0 ve Apache içeren resmi Docker imajını kullan
FROM php:8.0-apache

# Çalışma dizini ayarlama
WORKDIR /var/www/html

# Proje dosyalarınızı kopyalama
COPY . .

# Gerekli uzantıları yükleyin
RUN docker-php-ext-install pdo pdo_mysql

# Apache ayarlarını yapılandırma (isteğe bağlı)
# COPY ./your-apache-config.conf /etc/apache2/sites-available/000-default.conf

# Apache'yi başlat
CMD ["apache2-foreground"]
