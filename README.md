# php-grpc-demo
Demo of how to make gRPC client in PHP

## Installation

Before you start, make sure the following libraries and plugins are properly installed.

[Protocol Buffers](https://github.com/google/protobuf/blob/master/src/README.md)

[gRPC](https://github.com/grpc/grpc/blob/master/INSTALL.md)

[gRPC PHP extension](https://github.com/grpc/grpc/tree/master/src/php)

[gRPC-go](https://github.com/grpc/grpc-go)

For linux user, you may need to build the php extension from source, for Mac user, you can use [brew](https://github.com/Homebrew/brew) to install it, e.g. if you have installed php 7.1 by brew, you can use the following command to install the gRPC extension:

 ```
brew install php71-grpc
 ```

## Generate source files

Just run `./generate.sh` and you will generate the source files of Golang and PHP.

## Server

The server is written by Golang, you can run it by the commands below:

```
cd server/
go run main.go
```

## Client

After you launch the server, you can try the php client:

```
cd clients/
composer install
php helloworld_client.php [name]
```

Tips: you can view the [gRPC PHP Client Library](https://github.com/grpc/grpc-php) which supports Composer installation.

