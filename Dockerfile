FROM richarvey/nginx-php-fpm:1.7.2

# تحديد مجلد العمل داخل الحاوية
WORKDIR /var/www/html

# نسخ الملفات إلى المسار الصحيح
COPY . /var/www/html/

# تثبيت مكتبات Laravel أثناء البناء
RUN composer install --no-dev --optimize-autoloader && \
    rm -rf /root/.composer/cache

# إعدادات Laravel
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# إعدادات Laravel الأساسية
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# السماح لـ Composer بالعمل كمستخدم root
ENV COMPOSER_ALLOW_SUPERUSER 1

# تشغيل Laravel عند بدء الحاوية
CMD ["/start.sh"]
