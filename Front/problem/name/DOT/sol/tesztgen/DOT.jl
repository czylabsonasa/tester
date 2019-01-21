n=rand(50:100)
a=rand(-100:100,n)
b=rand(-100:100,n)

function mstring(x)
  sx=""
  for t in x
    sx*=string(t)*" "
  end
  sx
end

println(mstring(a))
println(mstring(b))
println(sum( a.* b ))




