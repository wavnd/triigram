/*
 * @file    scanner.c
 * @brief   The scanner for SIMPL-2018.
 * @author  W. H. K. Bester (whkbester@cs.sun.ac.za)
 * @date    2018-07-07
 */

#include <ctype.h>
#include <limits.h>
#include <stdlib.h>
#include <string.h>
#include "boolean.h"
#include "error.h"
#include "scanner.h"
#include "token.h"

/* --- type definitions and constants --------------------------------------- */

typedef struct {
	char      *word;                   /* the reserved word, i.e., the lexeme */
	TokenType  type;                   /* the associated token type           */
} ReservedWord;

/* -------------------------------------------------------------------------- */

static FILE *src_file;                 /* the source file pointer             */
static char  ch;                       /* the next source character           */
static int   column_number;            /* the current column number           */

static ReservedWord reserved[] = {{"and", TOK_AND}, {"array", TOK_ARRAY}, {"begin", TOK_BEGIN}, {"boolean", TOK_BOOLEAN},{"chill", TOK_CHILL},{"define", TOK_DEFINE}, {"do", TOK_DO}, {"else", TOK_ELSE}, {"elsif", TOK_ELSIF}, {"end",TOK_END}, {"exit", TOK_EXIT}, {"false", TOK_FALSE}, {"if", TOK_IF}, {"integer", TOK_INTEGER}, {"mod", TOK_MOD}, {"not", TOK_NOT}, {"or", TOK_OR}, {"program", TOK_PROGRAM}, {"read", TOK_READ}, {"then", TOK_THEN}, {"true", TOK_WHILE}, {"while", TOK_WHILE}, {"write", TOK_WRITE}
	 /* reserved words                      */
	/* Populate this array with the appropriate pairs of reserved word
	 * strings and token types, sorted alphabetically by reserved word string.
	 */
};

#define NUM_RESERVED_WORDS (sizeof(reserved) / sizeof(ReservedWord))
#define MAX_INITIAL_STRLEN (1024)

/* --- function prototypes -------------------------------------------------- */
static void next_char(void);
static void process_number(Token *token);
static void process_string(Token *token);
static void process_word(Token *token);
static void skip_comment(void);

/* --- scanner interface ---------------------------------------------------- */

void init_scanner(FILE *in_file){
	src_file = in_file;
	position.line = 1;
	position.col = column_number = 0;
	next_char();
}

void get_token(Token *token){
	/* remove whitespace */
	/* Skip all whitespace characters before the start of the token. */
	while(isspace(ch)){
		next_char();
	}
	/* remember token start */
	position.col = column_number;
	/* get next token */
	if (ch != EOF) {
		if (isalpha(ch) || ch == '_') {
			/* process a word */
			process_word(token);
		} else if (isdigit(ch)) {
			/* process a number */
			process_number(token);
		} else switch (ch) {
			/* process a string */
			case '"':
				position.col = column_number;
				next_char();
				process_string(token);
			case '#':
				token->type = TOK_NE;
				break;
			case '>':
				next_char();
				if (ch == '='){
					token->type = TOK_GE;
				}else{
					token->type = TOK_GT;
				}
				break;
			case '<':
				next_char();
				if (ch == '='){
					token->type = TOK_LE;
				}else if(ch == '-'){
					token->type = TOK_GETS;
				}else{
					token->type = TOK_LT;
				}
				break;
			case '-':
				next_char();
				if(ch == '>'){
					token->type = TOK_TO;
				}else{
					token->type = TOK_MINUS;
				}
				break;
			case '/':
				token->type = TOK_DIV;
				break;
			case '*':
				token->type = TOK_MUL;
				break;
				/* trigger comment skipping. */
			case '(':
				next_char();
				if(ch == '*'){
					skip_comment();
				}else{
				token->type = TOK_LPAR;
				}
				break;
			case ')':
				token->type = TOK_RPAR;
				break;
			case '=':
				token->type = TOK_EQ;
				break;
			case '|':
				token->type = TOK_OR;
				next_char();
				break;
			case '&':
				token->type = TOK_AND;
				next_char();
				break;
			case '%':
				token->type = TOK_MOD;
				break;
			case '[':
				token->type = TOK_LBRACK;
				break;
			case ']':
				token->type = TOK_RBRACK;
				break;
			case ',':
				token->type = TOK_COMMA;
				break;
			case '.':
				token->type = TOK_DOT;
				break;
			case ';':
				token->type = TOK_SEMICOLON;
				break;
		}
	}else{
		token->type = TOK_EOF;
	}
}

/* --- utility functions ---------------------------------------------------- */

void next_char(void){
	static char last_read = '\0';
	last_read = ch;
	ch = fgetc(src_file);
	column_number = column_number + 1;
	if(last_read == '\n'){
		position.line = position.line + 1;
		column_number = 0;
	}
	/* TODO:
	 * - Get the next character from the source file.
	 * - Increment the line number if the previous character is EOL.
	 * - Reset the global column number when necessary.
	 * - DO NOT USE feof!!!
	 */
}

void process_number(Token *token){
	int flag = 1;;
	int v = 0;;
	do{
			int d =	ch - '0';
		if(d <= (INT_MAX - (10*v))){
			v = d + (10*v);
			token->type = TOK_NUM;
			token->value = v;
		}else{
			flag = 0;
		}
	if(flag == 0){
        leprintf("%s", "Number too large");
		break;
    }
	next_char();
	}while(isdigit(ch) && (flag == 1));
	/*
	 * - Build numbers up to the specificied maximum magnitude.
	 * - Store the value in the appropriate token field.
	 * - Set the appropriate token type.
	 * - "Remember" the correct column number globally.
	 */
}

void process_string(Token *token){
	size_t i, nstring = MAX_INITIAL_STRLEN;
	i = 0;
	char *arrwords = malloc(MAX_INITIAL_STRLEN);
	int flagq = 0;
	int strquo = 1;
	int unsigned counter = 0;
	while((ch != EOF) && (flagq != 1) && (ch != ' ') && (!(isspace(ch)))){
		if(ch == '\\'){
			next_char();
			if((ch != '\\') && (ch != '"') && (ch != 't') && (ch != 'n')){
				position.col = column_number;
				leprintf("%s", "Illegal escape code in string");
				break;
            }
		}else if (ch == '"'){
			flag = 1;
		}else{
			if (i == nstring) {
				nstring = i + MAX_INITIAL_STRLEN;
				arrwords = realloc(arrwords, nstring);
			}else{
				arrwords[i] = ch;
				i = i + 1;
				next_char();
			}
		}
	}
	if (flagq != 1) {
		leprintf("%s", "String not closed");
	}else{
		token->type = TOK_STR;
		strcpy(token->string, arrwords);
	}
	free(arrwords);
	arrwords = NULL;
	/*
	 * - Allocate heap space of the maximum initial string length.
	 * - If a string is about to overflow while scanning it, double the amount
		 *   of space available.
	 * - ONLY printable ASCII characters are allowed; see man 3 isalpha.
	 * - Check the legality of escape codes.
	 * - Set the appropriate token type.
	 */
}

void process_word(Token *token){
	char lexeme[MAX_ID_LENGTH+1];
	int i, cmp, low, mid, high;
	//first build lexeme (string) then do binary search
	i = 0;
	int flag = 0;
	while(ch != EOF && flag != 1 && ch != ' ' && (!(isspace(ch)))){
		if(i < MAX_ID_LENGTH){
		lexeme[i] = ch;
		lexeme[i+1] = '\0';
		next_char();
		i++;
		if((!(isalpha(ch))) && (!(isdigit(ch))) && ch != '_'){
			if(ch == '\n'){
			flag = 1;
			}
		}
		}else{
		leprintf("Identifier too long");
		break;
		}
	}
	/* check that the id length is less than the maximum */
	int found = 0;
	low = 0;
	high = 22;
	while((low <= high)){
		mid = (low+high)/2;
		cmp = strcmp(reserved[mid].word, lexeme);
		if(cmp > 0){
			high = mid-1;
		}else if(cmp < 0){
			low = mid+1;
		}else if(cmp == 0){
			found = 1;
			break;
		}
	}
	/* do a binary search through the array of reserved words */
	/*check if id was recognised as a reserve word, if not then make categorize it as an identifier*/
	if(found == 0){
		token->type = TOK_ID;
		strcpy(token->lexeme, lexeme);
	}else{
		token->type = reserved[mid].type;
	}
}

void skip_comment(void){
	/*skips comments*/
	int countopen = 1;
	int countclose = 0;
	while((ch != EOF) && (ch != '\n')){
		next_char()
		if(ch == '('){
			next_char();
			if(ch == '*'){
				countopen = countopen+1;
			}
		}
		if(ch == '*'){
			next_char();
			if(ch == ')'){
				if(countopen > 0){
					countclose = countclose - 1;
				}
			}
		}
	}
	if(countopen != countclose){
		leprintf("%s", "Comment not closed");
	}
}
	/*
	 * - Skip nested comments RECURSIVELY, which is to say, counting strategies
	 *   are not allowed.
	 * - Terminate with an error if comments are not nested properly.
	 */
