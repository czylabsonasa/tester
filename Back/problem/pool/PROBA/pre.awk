BEGIN {
  FS = ":" ;
}

{ 
  if ($1=="HERE" && $3=="HERE") { 
    system(sprintf("cat %s",$2));
  } else {
    print $0 ;
  }
}
