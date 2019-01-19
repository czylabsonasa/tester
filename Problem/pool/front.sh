#!/bin/bash 

cp -p ${1}/io/pub/*_in ${1}/io/pub/*_out  ${1}/io/pub/IO.tgz  ~/public_html/tester/Front/problem/pool/${1}/io/pub
cp -p ${1}/statement/statement ~/public_html/tester/Front/problem/pool/${1}/statement/statement
cp -p ${1}/head  ~/public_html/tester/Front/problem/pool/${1}

