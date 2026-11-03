FROM php:8.2-apache-bookworm
RUN apt-get update && apt-get install -y --no-install-recommends mariadb-server mariadb-client && docker-php-ext-install mysqli && rm -rf /var/lib/apt/lists/*
COPY mortorSport/ /var/www/html/
RUN rm -rf /var/www/html/database && mkdir -p /run/mysqld && chown mysql:mysql /run/mysqld
COPY deploy/ /opt/demo/
RUN printf 'display_errors=Off\nlog_errors=On\nauto_prepend_file=/opt/demo/guard.php\n' > /usr/local/etc/php/conf.d/demo.ini && chmod +x /opt/demo/start.sh
EXPOSE 10000
CMD ["/opt/demo/start.sh"]
