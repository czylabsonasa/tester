BEGIN {
  FS="_" ;
  getline<"list";
  print "# " $3 ;

}

{ print $0; }

END {
  print "# Példa bemenet:";
  print "```";
  system(sprintf("cat %s","io/pub/in1"));
  print "```";

  print "# Példa kimenet:";
  print "```";
  system(sprintf("cat %s","io/pub/out1"));
  print "```";
}



