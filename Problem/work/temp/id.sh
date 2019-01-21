#!/bin/bash

declare prob
declare pid
declare pname

if ! test -d 'id'
then
  echo 'missing id dir. exiting'
  exit 1
fi

> 'id/'list

while read prob || [[ -n ${prob} ]]
do
  pid=$(echo ${prob}|cut -d'_' -f1)
  pname=$(echo ${prob}|cut -d'_' -f2)
  cd 'id'
  rm -f ${pid}
  ln -s '../name/'${pname} ${pid}
  echo ${prob} >> 'list'
  cd ..
done < 'name/list' ;
