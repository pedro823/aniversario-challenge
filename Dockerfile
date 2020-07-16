FROM php:apache

RUN apt update
RUN apt install -y sqlite3

# Create the database
WORKDIR /db
RUN chmod 777 .
RUN chown www-data .
COPY db_init.sql ./
RUN sqlite3 website.db < db_init.sql && rm db_init.sql
RUN chmod 666 website.db
RUN chown www-data website.db

COPY src/ /var/www/html/
