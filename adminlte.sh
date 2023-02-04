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
rm -f /etc/pihole/pihole-FTL.db
ln -s $custom_dir/pihole-FTL.db /etc/pihole/pihole-FTL.db
rm -f $ex_path/scripts/api_padavan.php
ln -s $custom_dir/api_padavan.php $ex_path/scripts/api_padavan.php
rm -f $ex_path/scripts/ss.php
ln -s $custom_dir/ss.php $ex_path/scripts/ss.php
rm -f $ex_path/scripts/pi-hole/php/sysinfo.php
ln -s $custom_dir/scripts/pi-hole/php/sysinfo.php $ex_path/scripts/pi-hole/php/sysinfo.php
