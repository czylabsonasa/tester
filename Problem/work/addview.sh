#!/bin/bash

source def.sh

declare -i cnt
declare -r vname=${1}
declare -r vdir=${base}"/view/"${vname}
declare -r vtitle="${2}"
declare skel="${3}"

#echo "1: "${1}
#echo "2: "${2}" ..."
#echo "3: "${3}
#exit 0

if [ -z "${vname}" ] || [ -z "${vtitle}" ]
then
  echo "usage: ./addview NAME TITLE [FROM]"
  echo "NAME,TITLE: nonempty strings"
  echo "the optional FROM is a previously added view, it will be cloned"
  exit 1
fi


if test -e ${vdir}
then
  echo ${vname}" exists already, exiting."
  exit 2
fi



if test -z ${skel}
then
  skel="skel.tar"
else
  if ! test -e ${base}"/view/"${skel}
  then
    echo "FROM="${skel}" does not exist."
    exit 3
  fi
fi



# mkdir ${pdir}
if [[ ${skel} == "skel.tar" ]]
then
  tar xf ${base}"/view/skel.tar"
  mv skel ${vdir}
else
  cp -R ${base}"/view/"${skel} ${vdir}
fi

echo ${vname}_"${vtitle}" > ${vdir}"/info"
echo ${vname}_"${vtitle}" >> ${base}"/view/list"

exit 0

