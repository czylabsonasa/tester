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

if test -z ${skel}
then
  skel="skel0"
fi

if ! test -e $base"/name/"${skel}
then
  echo "FROM="${skel}" does not exist."
  exit 3
fi




read cnt < ${base}"/count"
cnt=$(( cnt + 1 ))
echo ${cnt} > ${base}"/count"
echo 'sorszám: '${cnt}

# mkdir ${pdir}
cp -R ${base}"/name/"${skel} ${pdir}
> ${pdir}"/view"
echo ${cnt}_${pname}_"${ptitle}" > ${pdir}"/info"
echo ${cnt}_${pname}_"${ptitle}" >> ${base}"/name/list"


cd ${base}"/id"
ln -s "../name/"${pname} ${cnt}
cd -
