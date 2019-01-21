#!/bin/bash

declare vname=""
declare pname=""
declare tmp=""
declare line
declare line2


>"view/list"
while read line || [[ -n ${line} ]]
do
  read vname < "view/"${line}"/info" 
  echo ${vname} >> "view/list"
done < "view/prelist"


while read line || [[ -n ${line} ]]
do
  vname=$( echo ${line}|cut -d'_' -f1 )
  >"view/"${vname}"/list"
  cp "name/head" "view/"${vname}
done < "view/list"


while read line || [[ -n ${line} ]]  # <name/list
do
  pname=$(echo ${line}|cut -d'_' -f2)

  echo ${pname}'...'

  while read vname || [[ -n ${vname} ]]
  do
    read tmp < "name/"${pname}"/info" 
    echo ${tmp} >> "view/"${vname}"/list"
  done < "name/"${pname}"/view"
  
  echo "...done"

done < 'name/list'

exit 0
