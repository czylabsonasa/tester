#!/bin/bash

source def.sh

declare -i cnt
declare -r pname=${1}
declare -r pdir=${base}"/name/"${pname}
declare -r ptitle=${2}
declare skel="${3}"

#echo "1: "${1}
#echo "2: "${2}" ..."
#echo "3: "${3}
#exit 0

if [ -z "${pname}" ] || [ -z "${ptitle}" ]
then
  echo "usage: ./addprob NAME TITLE [FROM]"
  echo "NAME,TITLE: nonempty strings"
  echo "the optional FROM is a previously added problem, it will be cloned"
  exit 1
fi

if test -e ${pdir}
then
  echo ${pname}" exists already, exiting."
  exit 2
fi

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
