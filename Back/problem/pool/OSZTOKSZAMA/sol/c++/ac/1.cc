#include <cstdio>
int main(){
  
  int a; 
  while(1==scanf("%d",&a)){
    int d=0;
    for(int k=1;k<=a; k++){
      if(0==a%k){
        d+=1;
      }
    }
    printf("%d ",d);
  }
  printf("\n");
//  fflush(stdout);

  return 0;
}