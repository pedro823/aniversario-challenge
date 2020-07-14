FROM php:apache

RUN apt update
RUN apt install -y sqlite3

# Create the database
WORKDIR /db
COPY db_init.sql ./
RUN sqlite3 website.db < db_init.sql && rm db_init.sql

COPY src/ /var/www/html/
