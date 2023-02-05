#!/bin/sh
#copyright by simonchen
#setup AdminLTE 

basedir=$(cd $(dirname $0) && pwd)
basename=$(basename $0)

logger -t "【安装定制Web服务pihole】" "重新设置web服务根目录/home/root/www > /tmp/AdminLTE"

gz_path=$basedir/AdminLTE-5.18.3.tar.gz
custom_dir=$basedir/adminlte_custom
ex_path=/tmp/AdminLTE
www=/home/root/www
mkdir $ex_path

tar -xzvf $gz_path -C $ex_path
rm -rf $www
ln -s $ex_path $www

#config files
mkdir /etc/pihole
rm -f /etc/pihole/setupVars.conf
ln -s $ex_path/setupVars.conf /etc/pihole/setupVars.conf
rm -f /etc/pihole/pihole-FTL.conf
ln -s $ex_path/pihole-FTL.conf /etc/pihole/pihole-FTL.conf

#customized scripts
rm -f $ex_path/init_db.php
ln -s $custom_dir/init_db.php $ex_path/init_db.php
rm -f /etc/pihole/pihole-FTL.db
ln -s $custom_dir/pihole-FTL.db /etc/pihole/pihole-FTL.db
rm -f $ex_path/api_padavan.php
ln -s $custom_dir/api_padavan.php $ex_path/api_padavan.php
rm -f $ex_path/ss.php
ln -s $custom_dir/ss.php $ex_path/ss.php
rm -f $ex_path/scripts/pi-hole/php/sysinfo.php
ln -s $custom_dir/scripts/pi-hole/php/sysinfo.php $ex_path/scripts/pi-hole/php/sysinfo.php
rm -f $ex_path/scripts/pi-hole/php/ss_config.php
ln -s $custom_dir/scripts/pi-hole/php/ss_config.php $ex_path/scripts/pi-hole/php/ss_config.php

#Padavan shell scripts
rm -f $ex_path/sh_link.sh
chmod +x $custom_dir/sh_link.sh && ln -s $custom_dir/sh_link.sh $ex_path/sh_link.sh
rm -f $ex_path/padavan.sh
chmod +x $custom_dir/padavan.sh && ln -s $custom_dir/padavan.sh $ex_path/padavan.sh
