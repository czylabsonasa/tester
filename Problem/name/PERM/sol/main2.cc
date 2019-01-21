// felesleges a string, scanf+char[] egyszerubb lenne
#include <cstdio>
#include <algorithm>
#include <cstring>

using namespace std;

int main(){
  char w[64]; scanf("%s",w);
  int nw=strlen(w);
  sort(w,w+nw);
  
  printf("%s\n",w);
  while(next_permutation(w,w+nw)){
    printf("%s\n",w);
  }



//  char* const pw=
//  auto sw=sort(w.begin(),w.end());
//  cout<<sw<<"\n";


  return 0;
}
