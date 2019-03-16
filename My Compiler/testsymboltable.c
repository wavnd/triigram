/**
 * @file    testsymboltable.c
 * @brief   A driver program to test the symbol table implementation.
 * @author  W. H. K. Bester (whkbester@cs.sun.ac.za)
 * @date    2018-07-10
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "symboltable.h"

#define BUFFER_SIZE 1024

int main()
{
	char buffer[BUFFER_SIZE];
	IDprop propts, *propts_ptr;

	init_symbol_table();

	printf("type \"search <Enter>\" to stop inserting and start searching.\n");
	printf("Actions\n=======\n");
	printf("insert <id> -- insert <id> into current table\n");
	printf("find <id>   -- find <id> in current table\n");
	printf("open <id>   -- open function <id> tablen\n");
	printf("close       -- close current function table\n");
	printf("print       -- print symbol table\n");
	printf("quit        -- quit program\n");

	printf(">> ");
	scanf("%s", buffer);
	while (strcmp(buffer, "quit") != 0) {
		if (strcmp(buffer, "open") == 0) {

			scanf("%s", buffer);
			propts.type    = TYPE_INTEGER;
			propts.offset  = rand() % 7 + 1;
			propts.nparams = 0;
			if (!open_function(buffer, &propts)) {
				printf("Function already exists ... not added.\n");
			}

		} else if (strcmp(buffer, "close") == 0) {

			close_function();

		} else if (strcmp(buffer, "print") == 0) {

			print_symbol_table();

		} else if (strcmp(buffer, "insert") == 0) {

			scanf("%s", buffer);
			propts.type    = TYPE_INTEGER;
			propts.offset  = rand() % 7 + 1;
			propts.nparams = 0;
			if (!insert_name(buffer, &propts)) {
				printf("Identifier already exists ... not added.\n");
			}

		} else if (strcmp(buffer, "find") == 0) {

			scanf("%s", buffer);
			if (find_name(buffer, &propts_ptr)) {
				printf("\"%s\" at offset %i.\n", buffer,
						propts_ptr->offset);
			} else {
				printf("Identifier not found.\n");
			}

		} else {
			printf("Unknown command.\n");
		}

		printf(">> ");
		scanf("%s", buffer);
	}

	printf("Goodbye!\n");
	release_symbol_table();

	return EXIT_SUCCESS;
}
