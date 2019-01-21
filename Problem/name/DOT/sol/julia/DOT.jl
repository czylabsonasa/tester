let
ip=split(read(stdin,String))
a=[ parse(Int,x) for x in ip ]
n=div(length(a),2)
# a=[parse(Int, x) for x in split(readline())]
# b=[parse(Int, x) for x in split(readline())]
ret=0
for i in 1:n
  ret+=a[i]*a[n+i]
end
#print(sum(a[1:n] .* a[(n+1):2n]))
print(ret)
end