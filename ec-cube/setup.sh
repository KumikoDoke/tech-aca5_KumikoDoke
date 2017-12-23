#!/bin/sh

# ---------------
# yum install
#
# パッケージを取得してインストール/アップデートをする
#   -y 問い合わせがあったときにすべて「y」と答える
# ---------------

yum update -y
yum install automake autoconf
yum install unzip -y
yum install httpd -y
yum install mysql mysql-server -y
yum install postgresql postgresql-server -y
yum install php php-gd php-mbstring php-pdo php-mysql php-pgsql php-xml php-soap -y

# ---------------
# set up iptables
#
# ファイアウォールを停止
# ---------------

service iptables stop
chkconfig iptables off

# ---------------
# set up pgsql
# ---------------

sudo -u postgres initdb -D /var/lib/pgsql/data --no-locale --encoding=UTF8
cp -f /vagrant/etc/pgsql/pg_hba.conf /var/lib/pgsql/data/pg_hba.conf
cp -f /vagrant/etc/pgsql/postgresql.conf /var/lib/pgsql/data/postgresql.conf
service postgresql start
chkconfig postgresql on

# ---------------
# set up mysql
# ---------------

cp -f /vagrant/etc/mysql/my.cnf /etc/my.cnf
service mysqld start
chkconfig mysqld on

# ---------------
# set up httpd
# ---------------

rm -rf /var/www/html
mkdir -p /vagrant/www
ln -s /vagrant/www /var/www/html
cp -f /vagrant/etc/httpd/httpd.conf /etc/httpd/conf/httpd.conf
cp -f /vagrant/etc/php/php.ini /etc/php.ini
service httpd start
chkconfig httpd on

# ---------------
# set up ec-cube
# ---------------

# pgsql user setup

# createuser [option...] [username]
#   -s 新しいユーザはスーパーユーザになる
sudo -u postgres createuser eccube_db_user -s
# ロール（ユーザ）のパスワードを変更
sudo -u postgres psql -c "ALTER ROLE eccube_db_user WITH PASSWORD 'password';"

# mysql user setup
# GRANT構文の実行権限をもつユーザを作成
# mysql> GRANT ALL PRIVILEGES ON *.* TO ユーザー名@localhost IDENTIFIED BY 'パスワード' WITH GRANT OPTION;
mysql -uroot -e "GRANT ALL PRIVILEGES ON *.* TO eccube_db_user@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;"
mysql -uroot -e "FLUSH PRIVILEGES;"

# download 2.13.5
if [ ! -d ./eccube-2.13.5.zip ]; then
  wget http://downloads.ec-cube.net/src/eccube-2.13.5.zip
fi

# install 2.13.5 (pgsql)
rm -rf /vagrant/www/eccube-2.13.5-pgsql
unzip eccube-2.13.5.zip
mv eccube-2.13.5 /vagrant/www/eccube-2.13.5-pgsql
# 新しいPostgreSQLデータベースを作成する
# createdb [connection-option...] [option...] [dbname [description]]
#   -O 新しいデータベースの所有者となるデータベースユーザを指定
sudo -u postgres createdb eccube_2135_db -O eccube_db_user

# 2.13.5 (mysql)
rm -rf /vagrant/www/eccube-2.13.5-mysql
unzip eccube-2.13.5.zip
mv eccube-2.13.5 /vagrant/www/eccube-2.13.5-mysql
# データベースのキャラクタセットおよび照合順序
# CREATE DATABASE db_name [DEFAULT CHARACTER SET character_set_name [COLLATE collation_name]]
mysql -uroot -e "CREATE DATABASE eccube_2135_db DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;"

# 次回起動時の共有ディレクトリのマウントの設定
# この設定がないとマウントとhttpdの起動の順序が変わりhttpdの起動に失敗する
echo vagrant /vagrant vboxsf defaults 0 0 >> /etc/fstab
