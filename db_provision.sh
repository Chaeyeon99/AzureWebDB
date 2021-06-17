#!/bin/bash
#provision db

rm -f postinstall.sh

apt-get update
# mysql username: root
# mysql password: rootpass
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password rootpass'
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password rootpass'
apt-get -y install mysql-server php5-mysql

sed -i "s/bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" "/etc/mysql/my.cnf"

# Allow root access from any host
echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'rootpass' WITH GRANT OPTION; FLUSH PRIVILEGES;" | mysql -u root --password=rootpass
#echo "GRANT PROXY ON ''@'' TO 'root'@'%' WITH GRANT OPTION" | mysql -u root --password=rootpass
sudo service mysql restart

# Create response1, response2
mysql -uroot -p'rootpass' -e "DROP DATABASE IF EXISTS formresponses; 
	CREATE DATABASE formresponses; 
	USE formresponses; 
	CREATE TABLE response1 (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
		hostname VARCHAR(30));
	CREATE TABLE response2 (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		hostname VARCHAR(30));"
sudo service mysql restart

echo cd / >> /home/vagrant/.bashrc
