let
  n=rand(1:30)
  m=rand(3:20)
  ret=""
  for i in 0:(m-1)
    ret*=string((-1)^i * (n+i))*" "
  end

  println(n," ",m)
  println(ret)
end
