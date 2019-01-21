#!/bin/bash

declare -i id=1
declare pname=""
declare tmp=""

> name/list

if ! test -f name/prelist
then
  echo '. missing prelist.'
  exit 1
fi

while read pname || [[ -n ${pname} ]]
do
  echo ${pname}'...'

  if ! test -d 'name/'${pname}
  then
    echo 'missing problemdir: '${pname}
    exit 2
  fi


  if ! test -f 'name/'${pname}'/preinfo'
  then
    echo 'missing preinfo in name/'${pname}
    exit 3
  fi

  tmp='name/'${pname}'/preinfo'
  tpname=$(cat ${tmp} | cut -d'_' -f1 )
#  echo ${pname}' vs '${tpname}
  tptitle=$(cat ${tmp} | cut -d'_' -f2 )
  if [ ! ${pname}==${tpname} ]
  then
    echo 'dirname and preinfo name differs.'
    exit 4
  fi

  tmp=${id}_${pname}_${tptitle}
  echo ${tmp} > 'name/'${pname}'/info'
  echo ${tmp} >> 'name/list'

  id=$(( id+1 ))
  echo "...done"
done < "name/prelist"

exit 0
