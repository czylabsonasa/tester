 declare -r base="/home/teszt/public_html/tester/Front"
# declare -r base="/home/nosy/public_html/tester/Front"
declare -r target="/home/teszt/public_html/tester/Back/work/fromFront"
# declare -r target="/home/nosy/public_html/tester/Back/work/fromFront"

declare -r cpMethod="cp"


declare -r work=${base}"/work"
declare -r toBack=${work}"/toBack"
declare -r fromBack=${work}"/fromBack"
declare -r sub=${base}"/sub"


function on {
  if ! test -e pid/${1}
  then
    rm -f log/${1}
    touch log/${1}
    nohup ./${1} 1>> log/${1} 2>&1 &
    echo "$!" > pid/${1}
  fi
}



function off {
  if test -e pid/${1}
  then
    kill -9 $(cat pid/${1})
    rm -f pid/${1}
  fi
}

