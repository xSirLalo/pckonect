#!"C:\laragon\bin\git\usr\bin\perl.exe" -w -T
# Por: Ing. Eduardo Cauich Herrera.
use strict;
use warnings;
use CGI qw(-unique_headers);
use CGI::Carp qw(fatalsToBrowser);
use IO::Socket;
my $q = CGI->new;
print $q->header(-type => "text/html", -charset => 'utf8');

print $q->header();
print '<head><title>Socket - CGI</title></head>';
print "<style>
.texto-centrado {
        left: 0;
        line-height: 200px;
        margin-top: -100px;
        position: absolute;
        text-align: center;
        top: 50%;
        width: 100%;
}</style>";
print $q->header();

print $q->start_html();
# Test link. http://cgi-bin.test/socket.cgi?pc=1&acc=1
# my $parametros="http://pckonect.test/cyber/cgi-bin/socket.cgi?pc=1&acc=1";
# Obtiene las variables del enlace.
my $parametros=$ENV{"QUERY_STRING"};

# Separa los parametros
my @pares = split(/&/, $parametros);
my @PC = split(/=/, $pares[0]);
my @ACC = split(/=/, $pares[1]);

# Conexion al Socket de Java donde se encuentre iniciado.
my $url = "http://pckonect.test/cyber";
my $host_remote = "192.168.100.123";
my $port_remote = 3519;
my $sock = IO::Socket::INET->new(
    PeerAddr => $host_remote,
    PeerPort => $port_remote,
    Proto    => "tcp",
    Type => SOCK_STREAM,
    Reuse => 1,
    Timeout  => 1,
) or die "Couldn't connect to $host_remote:$port_remote : $!\n\n";
my $command.="OS1--".$PC[1]."--".$ACC[1]."--OS1";
print $sock $command;
print "<meta http-equiv=refresh content=\"0;URL=http://pckonect.test/cyber\">\n";

#my %headers = map { $_ => $q->http($_) } $q->http();
#print "Got the following headers:\n";
#for my $header ( keys %headers ) {
#print "<p>";
#    print "$header: $headers{$header}\n";
#print "</p>";
#}

print '<pre class="texto-centrado" >';
print "$command";
print "</pre>";

print $q->end_html();
