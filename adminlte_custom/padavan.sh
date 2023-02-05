#!/bin/sh
#copyright by simonchen

basedir=$(cd $(dirname $0) && pwd)
basename=$(basename $0)

source $basedir/sh_link.sh

decode_ss_ssr_link() {
link_tmp="$1"
if [ -z $link_tmp ]; then
  exit 1
fi

link_de_protocol "$link_tmp" "0ss0ssr0"
if [ "$link_protocol" != "ss" ] && [ "$link_protocol" != "ssr" ] ; then
  exit 1
fi
logger -t "【ss】" "应用 $link_protocol 配置： $link_name"
if [ "$link_protocol" == "ss" ] ; then
ss_type=0
fi
if [ "$link_protocol" == "ssr" ] ; then
ss_type=1
fi
ss_server="$ss_link_server"
ss_server_port="$ss_link_port"
ss_key="$ss_link_password"
ss_method="$ss_link_method"
ssr_type_protocol="$ss_link_protocol"
ssr_type_obfs="$ss_link_obfs"
ssr_type_protocol_custom="$ss_link_protoparam"
ssr_type_obfs_custom="$ss_link_obfsparam"
ss_plugin_name="$ss_link_plugin"
ss_plugin_config="$ss_link_plugin_opts"

cat << SSJSON
{
"link_protocol": "$link_protocol",
"link_name": "$link_name",
"server": "$ss_server",
"server_port": "$ss_server_port",
"local_address": "0.0.0.0",
"local_port": "1090",
"password": "$ss_key",
"timeout": "180",
"method": "$ss_method",
"protocol": "$ssr_type_protocol",
"protocol_param": "$ssr_type_protocol_custom",
"obfs": "$ssr_type_obfs",
"obfs_param": "$ssr_type_obfs_custom",
"plugin": "$ss_plugin_name",
"plugin_opts": "$ss_plugin_config",
"reuse_port": true,
"mode": "tcp_only"
}

SSJSON
}

case "$1" in
  decode_ss_ssr_link)
    decode_ss_ssr_link "$2"
    ;;
  *)
  echo "Usage: $0 {decode_ss_ssr_link} {link}"
  exit 1
esac 