function isPrime(x)
  ans=false
  if x>1 
    ans=true
    for d in 2:(x-1)
      if 0==mod(x,d)
        ans=false
        break
      end
    end
  end
  ans
end

for x in split(readline())
  if true==isPrime(parse(Int,x))
    println("prím")
  else
    println("nem prím")
  end
end
