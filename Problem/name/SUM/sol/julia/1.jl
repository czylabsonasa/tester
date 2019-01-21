in=[parse(Int, x) for x in split(readline())]
println(sum(in))
n=10000000
s=zeros(n)
s=collect(1:n)
s=s.^2
println(sum(s))
