/**
 * @file    simplc.c
 *
 * A recursive-descent compiler for the SIMPL-2018 language.
 *
 * All scanning errors are handled in the scanner.  Parser errors MUST be
 * handled by the <code>abort_c</code> function.  System and environment errors,
 * for example, running out of memory, MUST be handled in the unit in which they
 * occur.  Transient errors, for example, non-existent files, MUST be reported
 * where they occur.  There are no warnings, which is to say, all errors are
 * fatal and MUST cause compilation to terminate with an abnormal error code.
 *
 * @author  W. H. K. Bester (whkbester@cs.sun.ac.za)
 * @date    2018-07-09
 */

/* TODO: Include the appropriate system and project header files */

#include <codegen.h>
#include <symboltable>
#include <stdarg.h>
#include <errmsg.h>

/* --- debugging ------------------------------------------------------------ */

/* TODO: Your Makefile has a variable called DFLAGS.  If it is set to contain
 * -DDEBUG_PARSER, it will cause he following prototypes to be included, and the
 * functions to which they refer (given at the end of this file) to be compiled.
 * If, on the other hand, this flag is commented out, by setting DFLAGS to
 * #-DDEBUG_PARSER, these functions will be excluded.  These definitions should
 * be used at the start end end of every parse function.  For an example, the
 * provided parse_program function.
 */

#ifdef DEBUG_PARSER
	void debug_start(const char *fmt, ...);
	void debug_end(const char *fmt, ...);
	void debug_info(const char *fmt, ...);
	#define DBG_start(...) debug_start(__VA_ARGS__)
	#define DBG_end(...) debug_end(__VA_ARGS__)
	#define DBG_info(...) debug_info(__VA_ARGS__)
#else
	#define DBG_start(...)
	#define DBG_end(...)
	#define DBG_info(...)
#endif /* DEBUG_PARSER */

/* --- type definitions ----------------------------------------------------- */

/* TODO: Uncomment the following for use during type checking. */

#if 0
typedef struct variable_s Variable;
struct variable_s {
	char      *id;     /**< variable identifier                       */
	ValType    type;   /**< variable type                             */
	SourcePos  pos;    /**< variable position in the source           */
	Variable  *next;   /**< pointer to the next variable in the list  */
};
#endif

/* --- global variables ----------------------------------------------------- */

Token    token;        /**< the lookahead token.type                  */
FILE    *src_file;     /**< the source code file                      */
#if 0
ValType  return_type;  /**< the return type of the current subroutine */
#endif

/* TODO: Uncomment the previous definitionm for use during type checking. */

/* --- helper macros -------------------------------------------------------- */

#define STARTS_FACTOR(toktype) 
	(toktype == TOK_ID || toktype == TOK_NUM || 
	 toktype == TOK_LPAR || toktype == TOK_NOT || 
	 toktype == TOK_TRUE || toktype == TOK_FALSE)

#define STARTS_EXPR(toktype)

#define IS_ADDOP(toktype) 
	(toktype >= TOK_MINUS && toktype <= TOK_PLUS)

#define IS_MULOP(toktype)
	(toktype == TOK_AND || toktype == TOK_DIV || toktype == TOK_MUL || toktype == TOK_MOD)

#define IS_ORDOP(toktype)
	(toktype == TOK_GT || toktype == TOK_GE || toktype == TOK_LT || toktype == TOK_LE)

#define IS_RELOP(toktype)
	(toktype == TOK_EQ || toktype == TOK_GE || toktype == TOK_GT || toktype == TOK_LE || toktype == TOK_LT || toktype == TOK_NE)

#define IS_TYPE_TOKEN(toktype)
	(toktype == TOK_BOOLEAN || toktype == TOK_INTEGER || toktype == TOK_ARRAY)
	
/* --- function prototypes: parsing ----------------------------------------- */
void parse_program(void);
void parse_funcdef(void);
void parse_body(void);
void parse_statements(void);
void parse_type(void);
void parse_vardef(void);
void parse_statement(void);
void parse_exit(void);
void parse_if(void);
void parse_name(void);
void parse_read(void);
void parse_while(void);
void parse_write(void);
void parse_arglist(void);
void parse_index(void);
void parse_expr(void);
void parse_simple(void);
void parse_term(void);
void parse_term(void);
void parse_factor(void);

/* --- function prototypes: helpers ----------------------------------------- */

/* TODO: Uncomment the following commented-out prototypes for use during type
 * checking.
 */

#if 0
void check_types(ValType found, ValType expected, SourcePos *pos, ...);
#endif
void expect(TokenType type);
void expect_id(char **id);
#if 0
IDprop *make_idprop(ValType type, unsigned int offset, unsigned int nparams,
		ValType *params);
Variable *make_var(char *id, ValType type, SourcePos pos);
#endif

/* --- function prototypes: error reporting --------------------------------- */

void abort_c(Error err, ...);
void abort_cp(SourcePos *posp, Error err, ...);

/* --- main routine --------------------------------------------------------- */

int main(int argc, char *argv[])
{
#if 0
	char *jasmin_path;
#endif
	/* TODO: Uncomment the previous definition for code generation. */
	/* set up global variables */
	setprogname(argv[0]);
	/* check command-line arguments and environment */
	if (argc != 2) {
		eprintf("Usage: %s <filename>", getprogname());
	}
	/* open the source file, and report an error if it could not be opened. */
	if ((src_file = fopen(argv[1], "r")) == NULL) {
		eprintf("File '%s' could not be opened:", argv[1]);
	}
	setsrcname(argv[1]);
	/* initialise all compiler units */
	init_scanner(src_file);
	/* compile */
	get_token(&token);
	parse_program();
	/* produce the object code, and assemble */
	/* TODO: For final submission. */
	/* release allocated resources */
	release_symbol_table();
	fclose(src_file);
	freeprogname();
	freesrcname();

#ifdef DEBUG_PARSER
	printf("SUCCESS!\n");
#endif
	return EXIT_SUCCESS;
}

/* --- parser routines ------------------------------------------------------ */

/* <program> = "program" <id> { <funcdef> } <body> .
 */
void parse_program(void){
	char *class_name;
	DBG_start("<program>");
	expect(TOK_PROGRAM);
	expect_id(&class_name);
	set_class_name(class_name);
	while (token.type == TOK_DEFINE){
		parse_funcdef();
	}
	parse_body();
	free(class_name);
	DBG_end("</program>");
}
/* <funcdef> = "define" <id> "{"[<type> <id> {"," type <id>}]  ")" ["->" <type> ] <body .
*/
void parse_funcdef(void){
	char *class_name;
	DBG_start("<define>");
	expect(TOK_DEFINE);
	expect_id(&class_name);
	expect(TOK_LBRACK);
	expect(TOK_RBRACK);
	parse_body();
	free(class_name);
	DBG_end("<define>");	
}
/* <body> = "begin" {<vardef>} <statements> "end" . 
*/
void parse_body(void){
	expect(TOK_BEGIN);
	while (token.type == TOK_BOOLEAN || token.type == TOK_INTEGER){
		get_token(&token);
		parse_vardef();
	}
	parse_statements();
	expect(TOK_END);
}
/* <statement> = "chill" | <statement> {";" <statement>}.
*/
void parse_statements(void) {
	DBG_start("<chill>");
	expect(TOK_CHILL);
	if (token.type == TOK_CHILL) {
		parse_name();
	}else {
		parse_statement();
	}
	while (token.type == TOK_SEMICOLON) {
		get_token(&token);
		parse_statement();
	}
	DBG_end("<chill>");
}
/* <type> = ("boolean"	| "integer")["array"] .
*/
void parse_type(void){
	switch (toke.type) {
		case TOK_BOOLEAN:
			get_token(&token);
		case TOK_INTEGER:
			get_token(&token);
	}
}
/* <vardef> = <type> <id> {"," <id>} ";" 
*/
void parse_vardef(void){	
	char *class_name;
	parse_type();
	expect_id(&class_name);
	while (token.type == TOK_COMMA) {
		get_token(&token);
		expect_id(&class_name)
	}
	expect(TOK_COLON);
	free(class_name);
}
/* <statement> = <exit> | <if> | <name> | <read> | <while> | <write> .
*/
void parse_statement(void) {
	switch (token.type) {
		case TOK_EXIT:
			parse_exit();
			break;
		case TOK_IF:
			parse_if();
			break;
		case TOK_ID:
			parse_name();
			break;
		case TOK_READ:
			parse_read();
			break;
		case TOK_WHILE:
			parse_while();
			break;
		case TOK_WRITE:
			parse_write();
			break;
		default:
			abort_c(<ERR__EXPECTED>);
	}
}

/* <exit> = "exit" [<expr>] .
*/
void parse_exit(void) {
	DBG_start("<exit>");
	expect(TOK_EXIT);
	DBG_end("<exit>");
}
/* <if> = "if" <expr> "then" <statements> {"elsif" <expr> "then" <statements> } ["else" <statements> ] "end" .
*/
void parse_if(void) {
	expect(TOK_IF);
	parse_expr();
	expect(TOK_THEN);
	parse_statements();
	while (token.type == TOK_ELSIF) {
		get_token(&token);
		parse_expr();
		epxect(TOK_THEN);
		parse_statements();
		expect(TOK_END);
	}
}
/* <name> = <id> (<arglist> | [<index>] "<-" (<expr>) | "array" <simple>)) .
*/
void parse_name(void) {
	char *class_name;
	expect_id(&class_name);
	parse_arglist();
	expect_id(TOK_GETS);
	parse_expr();
	free(class_name);
}
/* <read> = "read" <id> [<index>] .
*/
void parse_read(void) {
	char *class_name;
	expect(TOK_READ);
	expect_id(&class_name);
	free(class_name);
}
/* <while> = "while" <expr> "do" <statements> "end" . 
*/
void parse_while(void) {
	expect(TOK_WHILE);
	parse_expr();
	expect(TOK_DO);
	parse_statements();
	expect(TOK_END);
}
/* <writer> = "write" (<string> | <expr>) {"." (<string> | <expr>)} .
*/
void parse_write(void) {
	expect(TOK_WRITE);
	parse_expr();
	while (token.type == TOK_DOT) {
		get_token(&token);
		parse_expr();
	}
}
/* <arglist> = "(" [<expr> {"," <expr>}] ")" .
*/
void parse_arglist(void) {
	expect(TOK_LBRACK);
	parse_expr();
	while (token.type == TOK_COMMA) {
		get_token(&token);
		parse_expr();
	}
	expect(TOK_RBRACK);
}
/* <index> = "[" <simple> "]" .
*/
void parse_index(void) {
	expect(TOK_RPAR);
	parse_simple();
	expect(TOK_LPAR);
}
/* <expr> = <simple> [<relop> <simple>] .
*/
void parse_expr(void) {
	parse_simple();
}
/* <simple> = ["-"] <term> {<addop> <term>}
*/
void parse_simple(void) {
	parse_term();
	while (IS_ADDOP(get_token(&token))) {
		get_token(&token);
		parse_term();
	}
}
/* <term> = <factor> {<mulop> <factor>} .
*/
void parse_term(void) {
	parse_factor();
	while (IS_MULOP(get_token(&token))) {
		parse_factor();
	}
}
/* <factor> = <id> [<index> | <arglist> | <num> | "not" <factor> | "true" | "false" | "(" <expr> ")" .
*/
void parse_factor(void) {
	switch (token.type) {
		char *class_name;
		case TOK_ID:
			expect_id(&class_name);
			free(class_name);
		case TOK_NOT:
			get_token(&token);
			parse_factor();
		case TOK_TRUE:
			get_token(&token);
		case TOK_FALSE:
			get_token(&token);
		case TOK_LBRACK:
			get_token(&token);
			parse_expr();
			expect(TOK_RBRACK);
		default:
			parse_num();
	}
}

/* TODO: Turn the EBNF into a program by writing one parse function for each
 * production as instructed in the specification.  I suggest you use the
 * production as comment to the function.  Also, you may only report errors
 * through the abort_c and abort_cp functions.  You must figure out what
 * arguments you should pass for each particular error.  Keep to the EXACT error
 * messages given in the spec.
 */

/* --- helper routines ------------------------------------------------------ */
#define MAX_MESSAGE_LENGTH 256
/* TODO: Uncomment the following function for use during type checking. */
#if 0
void check_types(ValType found, ValType expected, SourcePos *pos, ...){
	char buf[MAX_MESSAGE_LENGTH], *s;
	va_list ap;
	if (found != expected) {
		buf[0] = '\0';
		va_start(ap, pos);
		s = va_arg(ap, char *);
		vsnprintf(buf, MAX_MESSAGE_LENGTH, s, ap);
		va_end(ap);
		if (pos != NULL) {
			position = *pos;
		}
		leprintf("Incompatible types (%s and %s) %s",
			get_valtype_string(found), get_valtype_string(expected), buf);
	}
}
#endif

void expect(TokenType type){
	if (token.type == type){
		get_token(&token);
	} else {
		abort_c(ERR_EXPECT, type);
	}
}

void expect_id(char **id){
	if (token.type == TOK_ID) {
		*id = strdup(token.lexeme);
		get_token(&token);
	} else {
		abort_c(ERR_EXPECT, TOK_ID);
	}
}

/* TODO: Uncomment the following two functions for use during type checking. */

#if 0
IDprop *make_idprop(ValType type, unsigned int offset, unsigned int nparams,
		ValType *params){
	IDprop *ip;
	ip = emalloc(sizeof(IDprop));
	ip->type = type;
	ip->offset = offset;
	ip->nparams = nparams;
	ip->params = params;
	return ip;
}

Variable *make_var(char *id, ValType type, SourcePos pos){
	Variable *vp;
	vp = emalloc(sizeof(Variable));
	vp->id = id;
	vp->type = type;
	vp->pos = pos;
	vp->next = NULL;
	return vp;
}
#endif

/* --- error reporting routines --------------------------------------------- */

void _abort_compile(SourcePos *posp, Error err, va_list args);

void abort_c(Error err, ...){
	va_list args;
	va_start(args, err);
	_abort_compile(NULL, err, args);
	va_end(args);
}

void abort_cp(SourcePos *posp, Error err, ...){
	va_list args;
	va_start(args, err);
	_abort_compile(posp, err, args);
	va_end(args);
}

void _abort_compile(SourcePos *posp, Error err, va_list args){
	char expstr[MAX_MESSAGE_LENGTH], *s, *t;
	int tok;
	if (posp) {
		position = *posp;
	}
	snprintf(expstr, MAX_MESSAGE_LENGTH, "Expected %%s, but found %s",
		get_token_string(token.type));

	switch (err) {
		case ERR_ARGUMENT_LIST_OR_VARIABLE_ASSIGNMENT_EXPECTED:
		case ERR_ARRAY_ALLOCATION_OR_EXPRESSION_EXPECTED:
		case ERR_EXIT_EXPRESSION_NOT_ALLOWED_FOR_PROCEDURE:
		case ERR_EXPECT:
		case ERR_EXPRESSION_OR_STRING_EXPECTED:
		case ERR_FACTOR_EXPECTED:
		case ERR_MISSING_EXIT_EXPRESSION_FOR_FUNCTION:
		case ERR_STATEMENT_EXPECTED:
		case ERR_TYPE_EXPECTED:
			break;
		default:
			s = va_arg(args, char *);
			break;
	}
	switch (err) {
		/* a list of all possible parser errors */
		case ERR_EXPECT:
			tok = va_arg(args, int);
			leprintf(expstr, get_token_string(tok));
			break;
		case ERR_FACTOR_EXPECTED:
			leprintf(expstr, "factor");
			break;
		case ERR_UNREACHABLE:
			leprintf("Unreachable: %s", s);
			break;
		case ERR_ARGUMENT_LIST_OR_VARIABLE_ASSIGNMENT_EXPECTED:
			tok = va_arg(args, int);
			leprintf("Expected argument list or variable assignment, but found %s", get_token_string(tok));
			break;
		case ERR_ARRAY_ALLOCATION_OR_EXPRESSION_EXPECTED:
			tok = va_arg(args, int);
			leprintf("Array allocation or expression expected: %s", get_token_string(tok));
			break;
		case ERR_EXIT_EXPRESSION_NOT_ALLOWED_FOR_PROCEDURE:
			leprintf("Expression not allowed for procudure");
			break;
		case ERR_EXPRESSION_OR_STRING_EXPECTED:
			tok = va_arg(args, int);
			leprintf("Expected expression or string, but found %s", get_token_string(tok));
			break;
		case ERR_MISSING_EXIT_EXPRESSION_FOR_FUNCTION:
			leprintf("Missing exit expression for function");
			break;
		case ERR_STATEMENT_EXPECTED:
			tok = va_arg(args, int);
			leprintf("Expected statement, but found %s", get_token_string(tok));
			break;
		case ERR_TYPE_EXPECTED:
			tok = va_arg(args, int);
			leprintf("Expected type, but found: %s", get_token_string(tok));
			break;
		case ERR_ILLEGAL_ARRAY_OPERATION:
			leprintf("Illegal array operation");
			break;
		case ERR_MISSING_FUNCTION_ARGUMENT_LIST:
			leprintf("Missing function argument list");
			break;
		case ERR_MULTIPLE_DEFINITION:
			break;
		case ERR_NOT_A_FUNCTION:
			leprintf("Not a function");
			break;
		case ERR_NOT_A_PROCEDURE:
			leprintf("Not a procedure");
			break;
		case ERR_NOT_A_VARIABLE:
			leprintf("Not a variable");
			break;
		case ERR_NOT_AN_ARRAY:
			leprintf("Not an array");
			break;
		case ERR_SCALAR_VARIABLE_EXPECTED:
			leprintf("Scalar variable expected");
			break;
		case ERR_TAKES_NO_ARGUMENTS:
			leprintf("Takes no arguments");
			break;
		case ERR_TOO_FEW_ARGUMENTS:
			leprintf("Too few arguments");
			break;
		case ERR_TOO_MANY_ARGUMENTS:
			leprintf("Too many arguments");
			break;
		case ERR_UNKNOWN_IDENTIFIER:
			leprintf("Unknown identifier: %s", s);
			break;
		case ERR_UNREACHABLE:
			break;
	}
}

/* --- debugging output routines -------------------------------------------- */

#ifdef DEBUG_PARSER

static int indent = 0;
void debug_start(const char *fmt, ...){
	va_list ap;
	va_start(ap, fmt);
	debug_info(fmt, ap);
	va_end(ap);
	indent += 2;
}

void debug_end(const char *fmt, ...){
	va_list ap;
	indent -= 2;
	va_start(ap, fmt);
	debug_info(fmt, ap);
	va_end(ap);
}

void debug_info(const char *fmt, ...){
	int i;
	char buf[MAX_MESSAGE_LENGTH], *buf_ptr;
	va_list ap;
	buf_ptr = buf;
	va_start(ap, fmt);
	for (i = 0; i < indent; i++) {
		*buf_ptr++ = ' ';
	}
	vsprintf(buf_ptr, fmt, ap);
	buf_ptr += strlen(buf_ptr);
	snprintf(buf_ptr, MAX_MESSAGE_LENGTH, " in line %d.\n", position.line);
	fflush(stdout);
	fputs(buf, stdout);
	fflush(NULL);
	va_end(ap);
}
#endif /* DEBUG_PARSER */
