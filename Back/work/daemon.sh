function off {
  if test -e pid/${1}
  then
  	kill -9 $(cat pid/${1})
  	rm -f pid/${1}
  fi
}

function on {
  if ! test -e pid/${1}
  then
  	rm -f log/${1}
  	touch log/${1}
  	nohup ./${1} 1>> log/${1} 2>&1 &
    echo "$!" > pid/${1}
  fi
}
