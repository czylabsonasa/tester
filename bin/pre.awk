#!/usr/bin/awk -f

BEGIN {
  FS="_" ;
  getline<"../head";
  print "## " $3 ;

}

{ print $0; }

END {
  print "\n";
  print "### Példa bemenet:\n";
  print "```\n";
  system(sprintf("cat %s","../io/pub/1_in"));
  print "\n```\n";
  print "\n";

  print "### Példa kimenet:\n";
  print "```\n";
  system(sprintf("cat %s","../io/pub/1_out"));
  print "```\n";


}

