
#include <string.h>
#include <stdio.h>


#define DUMMY "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" \
 "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" \
 "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" \
 "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" \
 "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" \
 "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA"

int angel(int ac, char *av[]);
int devil(int ac, char *av[]);

char *str1 = DUMMY "A";
char *str2 = DUMMY "B";

int main(int ac, char *av[]) {
  if (strcmp(str1, str2) != 0) {
    return angel(ac, av);
  } else {
    return devil(ac, av);
  }
}


int angel(int ac, char *av[]) {
  char buf[10];
    fprintf(stdout, ".                                       ,\n");
    fprintf(stdout, ")).               -===-               ,((\n");
    fprintf(stdout, "))).                                 ,(((\n");
    fprintf(stdout, "))))).            .:::.           ,((((((\n");
    fprintf(stdout, "))))))))).        :. .:        ,(((((((('\n");
    fprintf(stdout, "`))))))))))).     : - :    ,((((((((((((\n");
    fprintf(stdout, "))))))))))))))))_:' ':_((((((((((((((('\n");
    fprintf(stdout, " `)))))))))))).-' \\___/ '-._(((((((((((\n");
    fprintf(stdout, "  `))))_._.-' __)(     )(_  '-._._(((('\n");
    fprintf(stdout, "   `))'---)___)))'\\_ _/'((((__(---'(('\n");
    fprintf(stdout, "     `))))))))))))|' '|(((((((((((('\n");
    fprintf(stdout, "      `)))))))))/'   '\\((((((((('\n");
    fprintf(stdout, "         `)))))))|     |((((((('\n");
    fprintf(stdout, "          `))))))|     |(((((('\n");
    fprintf(stdout, "                /'     '\\\n");
    fprintf(stdout, "               /'       '\\\n");
    fprintf(stdout, "              /'         '\\\n");
    fprintf(stdout, "             /'           '\\\n");
    fprintf(stdout, "             '---..___..---'\\\n");
  return 0;
}

int devil(int ac, char *av[]) {
  char buf[10];
    fprintf(stdout, "        _.---**""**-.\n");
    fprintf(stdout, "._   .-'           /|`.\n");
    fprintf(stdout, " \\`.'             / |  `.\n");
    fprintf(stdout, "  V              (  ;    \\\n");
    fprintf(stdout, "  L       _.-  -. `'      \\\n");
    fprintf(stdout, " / `-. _.'       \\         ;\n");
    fprintf(stdout, ":            __   ;    _   |\n");
    fprintf(stdout, ":`-.___.+-*\"': `  ;  .' `. |\n");
    fprintf(stdout, " |`-/     `--*'   /  /  /`.\\|\n");
    fprintf(stdout, ": :              \\    :`.| ;\n");
    fprintf(stdout, "| |   .           ;/ .' ' /\n");
    fprintf(stdout, ": :  / `             :__.'\n");
    fprintf(stdout, " \\`._.-'       /     |\n");
    fprintf(stdout, "  : )         :      ;\n");
    fprintf(stdout, "  :----.._    |     /\n");
    fprintf(stdout, " : .-.    `.       /\n");
    fprintf(stdout, "  \\     `._       /\n");
    fprintf(stdout, "  /`-            /\n");
    fprintf(stdout, " :             .'\n");
    fprintf(stdout, "  \\ )       .-'\n"); 
    fprintf(stdout, "   `-----*\"'\n");
  return 0;
}