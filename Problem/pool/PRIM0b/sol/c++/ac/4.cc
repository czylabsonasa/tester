#include <cstdio>
bool isPrime(int x){
  if(x<2){return false;}//0,1
  for(int d=2;d<x;d++){
    if(0==x%d){
      return false;
    }
  }
  return true;
}

int main(){
  int x;
  while(1==scanf("%d",&x)){
//printf("%d: ",x);
    printf("%s\n",isPrime(x)?"prím":"nem prím");
  }

  return 0;
}