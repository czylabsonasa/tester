declare tarF 
declare subId 
declare problemId 
declare problemName 
declare userId 
declare userName 
declare langName 
declare xCode 

declare compC
declare runC


declare ut
declare maxMS
declare allMS
declare MS

declare verdict="_"


function pre {
echo "tarF="${tarF}
  verdict="IE"
  cp "fromFront/"${tarF} ${base}"/sub/pre"
  rm -rf testBed/*
  mv "fromFront/"${tarF} testBed
  cd testBed
  subId=$(echo ${tarF}|cut -d'_' -f1)  
  tar xf ${tarF}
  mv ${subId}_data data
  mv ${subId}_src src
  source data
#
  echo "subId="${subId} 
  cp data ${subId}"_res"
  echo "procBeg="\"$(date)\" >> ${subId}"_res"
  ln -s ${base}"/problem/"${problemId}"/io"
  if test -e ${base}"/problem/"${problemId}"/checker"
  then
    cp ${base}"/problem/"${problemId}"/checker/checker" .
  else
    cp ${base}"/problem/checker/default/checker" .
  fi
  if test -e ${base}"/problem/"${problemId}"/limit"
  then
    cp ${base}"/problem/"${problemId}"/limit" .
  else
    cp ${base}"/problem/limit/default/limit" .
  fi
  
  verdict="_"
}

function compile {
  cd testBed
  declare compC="_"
  confP=${base}"/lang/"${langName}"/config"
  if test -e ${confP}
  then
    source ${confP}
  fi

  if [ ${compC} = "_" ]
  then
    xCode=-1
  else
    (
      ${compC}
    )
    xCode=$?
  fi
  if (( ${xCode} != 0 ))
  then
    verdict="CE"
    echo 'verdict="CE"' >> ${subId}"_res"
  fi

  return ${xCode}
}

function run {
  cd testBed
  source limit
  verdict="_"

#echo "runC="${runC}
#echo "compC="${compC}

  allMS=0
  for fin in $( find io/ -name "*_in" -printf "%f " )
  do
    st=$( date +%s%N )
    
    ( 
      ulimit -t ${ut} -n 512
      ${runC} < "io/"${fin} > out
    ) 
    xCode=$?
    
    et=$( date +%s%N )
    MS=$(( et-st ))
#echo ${MS}
    MS=$(( MS/1000000 ))
#echo ${MS}
    allMS=$(( allMS+MS ))
    echo ${fin}"_ms="${MS} >> ${subId}"_res"
    echo ${fin}"_run="${xCode} >> ${subId}"_res"


    if [ ${xCode} != 0 ]
    then
      if test ${xCode} -eq 137
      then
        echo ${fin}"_ver=te" >> ${subId}"_res"
        echo 'verdict="TE"' >> ${subId}"_res"
        verdict="TE"
      else
        echo ${fin}"_ver=re" >> ${subId}"_res"
        echo 'verdict="RE"' >> ${subId}"_res"
        verdict="RE"
      fi  
      echo "all_ms="${allMS} >> ${subId}"_res"
      break
    fi


    if (( MS>maxMS ))
    then
      echo ${fin}"_ver=te" >> ${subId}"_res"
      echo 'verdict="TE"' >> ${subId}"_res"
      verdict="TE"
      echo "all_ms="${allMS} >> ${subId}"_res"
      break;
    fi


    pre=$( echo ${fin}|cut -d'_' -f1 )

    (
      ./checker "io/"${pre}"_out" out
    )
    xCode=$?

    if (( xCode!=0 ))
    then
      echo ${fin}"=wa" >> ${subId}"_res"
      verdict="WA"
      echo 'verdict="WA"' >> ${subId}"_res"
      break
    fi

    echo ${fin}"=ac" >> ${subId}"_res"

  done # input file loop

  if [ ${verdict} = "_" ]
  then
      verdict="AC"
      echo 'verdict="AC"' >> ${subId}"_res"
      echo "all_ms="${allMS} >> ${subId}"_res"
  fi

  return ${xCode}
}


function post {
  cd testBed
  echo "procEnd="\"$(date)\" >> ${subId}"_res"
  cp ${subId}"_res" ${base}"/sub/res"
  cp ${subId}"_res" ${work}"/toFront"
}
