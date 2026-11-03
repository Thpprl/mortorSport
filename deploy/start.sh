#!/bin/sh
set -eu
mkdir -p /run/mysqld
chown mysql:mysql /run/mysqld
mariadbd --user=mysql --skip-networking --innodb-buffer-pool-size=32M --max-connections=12 &
dbpid=$!
trap 'kill "$dbpid" 2>/dev/null || true' EXIT
i=0
until mariadb-admin ping --silent; do
 i=$((i+1))
 if [ "$i" -ge 60 ]; then exit 1; fi
 sleep 1
done
mariadb < /opt/demo/schema.sql
sed -i "s/Listen 80/Listen ${PORT:-10000}/" /etc/apache2/ports.conf
sed -i "s/:80>/:\${PORT:-10000}>/" /etc/apache2/sites-available/000-default.conf
exec apache2-foreground
