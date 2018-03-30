package main

import (
	"log"
	"net"
	"time"

	google_protobuf "github.com/golang/protobuf/ptypes/timestamp"
	"github.com/hyperjiang/php-grpc-demo/server/pb"
	"golang.org/x/net/context"
	"google.golang.org/grpc"
	"google.golang.org/grpc/reflection"
)

const (
	port = ":50051"
)

// greeterServer implements helloworld.GreeterServer
type greeterServer struct{}

// addressBookServer implements addressbook.AddressBookServiceServer
type addressBookServer struct{}

// we store the address book in memory
var book pb.AddressBook

// SayHello implements helloworld.GreeterServer
func (s *greeterServer) SayHello(ctx context.Context, in *pb.HelloRequest) (*pb.HelloReply, error) {
	return &pb.HelloReply{Message: "Hello " + in.Name}, nil
}

// AddPerson implements addressbook.AddPerson
func (s *addressBookServer) AddPerson(ctx context.Context, in *pb.AddPersonRequest) (*pb.AddPersonResponse, error) {

	person := in.Person
	person.Id = int32(len(book.People) + 1)
	person.LastUpdated = &google_protobuf.Timestamp{
		Seconds: time.Now().Unix(),
		Nanos:   int32(time.Now().UnixNano()),
	}

	book.People = append(book.People, person)

	res := &pb.AddPersonResponse{
		Success: true,
		Message: "Add a person successfully",
	}
	return res, nil
}

// GetAddressBook implements addressbook.GetAddressBook
func (s *addressBookServer) GetAddressBook(ctx context.Context, in *pb.GetAddressBookRequest) (*pb.GetAddressBookResponse, error) {
	res := &pb.GetAddressBookResponse{AddressBook: &book}
	return res, nil
}

func main() {
	lis, err := net.Listen("tcp", port)
	if err != nil {
		log.Fatalf("failed to listen: %v", err)
	}
	s := grpc.NewServer()
	pb.RegisterGreeterServer(s, &greeterServer{})
	pb.RegisterAddressBookServiceServer(s, &addressBookServer{})

	// Register reflection service on gRPC server.
	// https://github.com/grpc/grpc-go/blob/master/Documentation/server-reflection-tutorial.md
	reflection.Register(s)

	log.Println("Server started")

	if err := s.Serve(lis); err != nil {
		log.Fatalf("failed to serve: %v", err)
	}
}
