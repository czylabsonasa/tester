na=rand(1:50)+50
nb=rand(1:50)+50
a=String(rand("123456789",na))
b=String(rand("123456789",nb))

if rand(0:1)>0
  a="-"*a
end
if rand(0:1)>0
  b="-"*b
end

a=parse(BigInt,a)
b=parse(BigInt,b)

println(a," ",b)
println(a+b)