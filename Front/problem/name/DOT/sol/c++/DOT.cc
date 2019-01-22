#include <cstdio>

// ket vektor belso szorzata
int const N=2048;
int x[N];

int main(){
  int n=0;
  while(1==scanf("%d",&x[n])){
    n++;
  }
  n/=2;
  int*y=x+n;  
  int ans=0;
  for(int i=0;i<n;i++){
    ans+=x[i]*y[i];
  }
  printf("%d\n",ans);

  return 0;
}
