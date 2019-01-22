#include <cstdio>
int main(){
  int n,m;
  scanf("%d%d",&n,&m);
  for(int i=0;i<m;i++){
    printf("%s%d ",((i%2)?"-":""),(n+i));
  }
  printf("\n");
  
  return 0;
}