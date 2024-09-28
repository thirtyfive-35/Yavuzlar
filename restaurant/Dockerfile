# Temel imaj olarak PHP ve Apache içeren bir imaj kullanın
FROM php:8.1-apache

# Gerekli uzantıları yükleyin (örneğin, PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Proje dosyalarınızı konteyner içine kopyalayın
COPY . /var/www/html/

# Apache yapılandırma dosyasını ayarlayın (isteğe bağlı)
# COPY ./my-apache-config.conf /etc/apache2/sites-available/000-default.conf

# Apache'yi başlat
CMD ["apache2-foreground"]
