function osztokSzama(x)
  d=0
  for k in 1:x
#  k=1
#  while k<x
#    k+=1
    if 0==mod(x,k) d+=1 end
  end
  d
end

for x in split(readline())
  print(osztokSzama(parse(Int,x))," ")
end
println()