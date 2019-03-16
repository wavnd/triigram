/**
 * @file    token.c
 * @brief   Utility functions for SIMPL-2018 tokens.
 * @author  W. H. K. Bester (whkbester@cs.sun.ac.za)
 * @date    2018-07-07
 */

#include <assert.h>
#include "token.h"

/* token strings */
static char *token_names[] = {
	"end-of-file", "identifier", "number", "string", "'array'", "'begin'",
	"'boolean'", "'chill'", "'define'", "'do'", "'else'", "'elsif'", "'end'",
	"'exit'", "'false'", "'if'", "'integer'", "'not'", "'program'", "'read'",
	"'then'", "'true'", "'while'", "'write'", "'='", "'>='", "'>'", "'<='",
	"'<'", "'#'", "'-'", "'or'", "'+'", "'and'", "'/'", "'*'", "'mod'", "'['",
	"']'", "','", "'.'", "'<-'", "'('", "')'", "';'", "'->'"
};

/* --- functions ------------------------------------------------------------ */

const char *get_token_string(TokenType type)
{
	assert(type >= 0 && type < (sizeof(token_names) / sizeof(char *)));
	return token_names[type];
}
