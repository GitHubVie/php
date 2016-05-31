FROM ubuntu:14.04

MAINTAINER YCZ <chenzhong@iscas.ac.cn>

# install apache2 php5 curl
RUN apt-get update && apt-get install -y curl vim apache2 php5 mysql-client php5-mysql php5-curl

# apache2 configuration file
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY mime.conf /etc/apache2/mods-available/mime.conf
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

ADD . /var/www/html

RUN chown www-data:www-data -R /var/www/html
RUN chmod 775 -R /var/www/html

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", " -D", "FOREGROUND"]
