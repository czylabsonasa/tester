#!/bin/bash

declare pname=""
declare pid=0
declare pinfo=""
declare ptitle=""
declare tmp
declare tmp2
declare -i cnt=0

if ! test -f name/list
then
  echo '. missing list in name.'
  exit 1
fi

cnt=0

while read pinfo || [[ -n ${pinfo} ]]
do
  echo ${pinfo}'...'
  cnt=$(( cnt + 1 ))  

  pid=$(echo ${pinfo}|cut -d'_' -f1 )
  pname=$(echo ${pinfo}|cut -d'_' -f2 )
  ptitle=$(echo ${pinfo}|cut -d'_' -f3 )
  
  if (( ${cnt} != ${pid} ))
  then
    echo "non continous sequence in name/list"
    exit -1
  fi

  tmp='name/'${pname}
  if ! test -d ${tmp}
  then
    echo 'missing problemdir: '${pname}
    exit 2
  fi


  tmp=${tmp}'/info'
  if ! test -f ${tmp}
  then
    echo 'missing info in name/'${pname}
    exit 3
  fi

  rid="$( cat ${tmp}|cut -d'_' -f1 )"
  rname="$( cat ${tmp}|cut -d'_' -f2 )"
  rtitle="$( cat ${tmp}|cut -d'_' -f3 )"

  if [ "${rid}" != "${pid}" ] || [ "${rname}" != "${pname}" ] || [ "${rtitle}" != "${ptitle}" ]
  then
    echo 'inconsistency: name/list vs. '${tmp}
    exit 4
  fi

  tmp=$( readlink -f 'id/'${pid} )
  tmp2=$( readlink -f 'name/'${pname} )

  if [ ${tmp} != ${tmp2} ]
  then
    echo "id/"${pid}" points to wrong place."
    exit 5
  fi
  echo "...done"
done < "name/list"


read < "count"
if (( ${REPLY} != ${cnt} ))
then
  echo "wrong count file"
  exit 6
fi

exit 0
