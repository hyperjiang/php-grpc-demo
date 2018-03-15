#!/usr/bin/env bash

proto_bin=$(which "protoc")
if [ -z $proto_bin ]; then
    echo 'Please install protoc!'
    exit
fi

grpc_php_plugin=$(which "grpc_php_plugin")
if [ -z $grpc_php_plugin ]; then
    echo 'Please install grpc_php_plugin!'
    exit
fi

home_dir=$(cd "$(dirname "$0")"; pwd)
protos_dir=$home_dir/protos
server_dir=$home_dir/server/pb
client_dir=$home_dir/clients/pb

if [ ! -d $client_dir ]; then
    mkdir -p $client_dir
fi

if [ ! -d $server_dir ]; then
    mkdir -p $server_dir
fi

# remove old codes
rm -rf $server_dir/*
rm -rf $client_dir/*

echo -e "\n\033[0;32mGenerating codes...\033[39;49;0m\n"

for file in $protos_dir/*.proto; do
    echo -en "from: $file"
    $proto_bin -I $protos_dir --go_out=plugins=grpc:$server_dir $file
    $proto_bin -I $protos_dir --php_out=$client_dir --grpc_out=$client_dir --plugin=protoc-gen-grpc=$grpc_php_plugin $file
    echo -en "\t\033[0;32m[DONE]\033[39;49;0m\n"
done

echo -e "\n\033[0;32mGenerate codes successfully!\033[39;49;0m\n"
