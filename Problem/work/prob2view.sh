#!/bin/bash

source def.sh

declare -r pname=${1}
declare -r pdir=${base}"/name/"${pname}
declare -r vname=${2}
declare -r vdir=${base}"/view/"${vname}
declare pinfo

#echo "1: "${1}
#echo "2: "${2}" ..."
#echo "3: "${3}
#exit 0

if [ -z "${pname}" ] || [ -z "${vname}" ] || [ ! -e ${pdir} ] || [ ! -e ${vdir} ]
then
  echo "usage: ./addprog PROB VIEW"
  echo "PROB,VIEW: already existing problem and view"
  exit 1
fi

read pinfo < ${pdir}"/info"
echo ${pinfo} >> ${vdir}"/list"


exit 0
