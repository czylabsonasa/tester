számok=[ parse(Int, x) for x in split(readline()) ]
for x in számok
  d=0
  for k in 1:x
    if 0==mod(x,k) d+=1 end
  end
  print(d," ")
end
println()


