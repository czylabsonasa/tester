function re()
  [parse(Int, x) for x in split(readline())]
end
print(sum(re() .* re()))
