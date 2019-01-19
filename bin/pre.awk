#!/usr/bin/awk -f

BEGIN {
  FS="_" ;
  getline<"../head";
  print "## " $3 ;

}

{ print $0; }

END {
  print "\n";
  print "### Példa bemenet:";
  print "```";
  system(sprintf("cat %s","../io/pub/1_in"));
  print "```";

  print "### Példa kimenet:";
  print "```";
  system(sprintf("cat %s","../io/pub/1_out"));
  print "```";


}

