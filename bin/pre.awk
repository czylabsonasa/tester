#!/usr/bin/awk -f

BEGIN {
  FS="_" ;
  getline<"../info";
  print "## " $3 ;

}

{ print $0; }

END {
  print "\n";
  print "### Példa bemenet:\n";
  print "```\n";
  system(sprintf("cat %s","../io/front/1_in"));
  print "\n```\n";
  print "\n";

  print "### Példa kimenet:\n";
  print "```\n";
  system(sprintf("cat %s","../io/front/1_out"));
  print "```\n";


}

