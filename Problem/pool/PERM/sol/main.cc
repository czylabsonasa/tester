// felesleges a string, scanf+char[] egyszerubb lenne
#include <iostream>
#include <algorithm>
#include <string>
#include <vector>
#include <cstring>



using namespace std;

int main(){
  string w1; cin>>w1;
  int nw1=w1.size();

  char w2[nw1+1];
  strcpy(w2,w1.c_str());
  sort(w2,w2+nw1);
  vector<char> w3(w2,w2+nw1);

  auto ir=[](vector<char>& x){
    for(auto c:x){
      cout<<c;
    }
    cout<<"\n";
  };

  ir(w3);
  while(next_permutation(w3.begin(),w3.end())){
    ir(w3);
  }



//  char* const pw=
//  auto sw=sort(w.begin(),w.end());
//  cout<<sw<<"\n";


  return 0;
}
