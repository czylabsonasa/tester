// az elso az elvart a masodik az elleenorzendo output file.
// ./checkeR jo.out  vajomilyen.out
//
// reszleges ujrairasa a checker.cc-nek
// int problemas, kivettem
// double es string tokenek sorozatának ellenőrzése
// (future: F 1e-12 S 0 I 1 I 0 alaku segedfile letrehozasa...)

#include <cstdio>
#include <cstring>
#include <cmath>
#include <cstdlib>
#include <cctype>

int main(int npar, char** par){

   if(npar<2){
      fprintf(stderr,"Usage: %s GoodOutput OutputToCheck\n",par[0]);
      exit(42);
   }

   FILE* fileJ=fopen(par[1],"r");
   FILE* fileC=fopen(par[2],"r");

   int exitCode=0; // ok

   char tokJ[32*1024];
   char tokC[32*1024];// buff overflow(scanf)!

   while(1==fscanf(fileJ,"%s",tokJ)){
      if( 1 != fscanf(fileC,"%s",tokC)){
         fprintf(stderr,"incomplete output\n");
         exitCode=1;
         break;
      }

      if(strcmp(tokJ,tokC)){
         exitCode=2;
         fprintf(stderr,"string mismatch\n");
         break;
      }
   }

  fclose(fileJ) ;
  fclose(fileC);

  return exitCode ;
}
