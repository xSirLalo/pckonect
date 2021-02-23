#!"C:\laragon\bin\git\usr\bin\perl.exe" -w -T
####XAMPP###!"C:\xampp\perl\bin\perl.exe" -w -T
####LINUX###!/usr/bin/perl -w
# Por: Ing. Eduardo Cauich Herrera.
use strict;
use warnings;

# use CGI qw(-utf8);
use IO::Socket;
# print CGI::header();
print "Content-Type: text/html;charset=UTF-8\n\n";

# Test link. http://cgi-bin.test/socket.cgi?pc=1&acc=1
# my $parametros="http://pckonect.test/cyber/cgi-bin/socket.cgi?pc=1&acc=1";
# Obtiene las variables del enlace.
my $parametros=$ENV{"QUERY_STRING"};

# Separa los parametros
my @pares = split(/&/, $parametros);
my @PC = split(/=/, $pares[0]);
my @ACC = split(/=/, $pares[1]);

# Conexion al Socket de Java donde se encuentre iniciado.
my $host = "192.168.1.2";
my $port = 3519;
my $sock = IO::Socket::INET->new(
	PeerAddr => $host,
	PeerPort => $port,
	Proto    => "tcp",
	Timeout  =>  10,
) || die "Failure: $!";
# ) or die print "Location: http://pckonect.test/cyber/errorSocket\n\n";

my $command.="OS1--".$PC[1]."--".$ACC[1]."--OS1";
print $sock $command;
close $sock or die "Can't close socket: $!";

# print "Location: http://pckonect.test/cyber\n\n";
# DEBUG "Imprimir variables y comportamiento del mensaje"
# print "Content-Type: text/html\n\n";
# print "RECIBE:\n";
# print "$parametros\n\n";

# print "SEPARA:\n";
# print "PC  = $PC[1]\n";
# print "ACC = $ACC[1]\n\n";

# print "ENVIA:\n";
print '<pre style="
	left: 0;
    line-height: 200px;
    margin-top: -100px;
    position: absolute;
    text-align: center;
    top: 50%;
    width: 100%;">';
print "$command";
print "</pre>";

