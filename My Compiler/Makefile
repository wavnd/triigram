#
# Makefile for SIMPL-2018
#

# compiler flags
DEBUG    = -ggdb
OPTIMISE = -O0
WARNINGS = -Wall -Wextra -Wno-variadic-macros -Wno-overlength-strings -pedantic
CFLAGS   = $(DEBUG) $(OPTIMISE) $(WARNINGS)
DFLAGS   = #-DDEBUG_PARSER -DDEBUG_SYMBOL_TABLE -DDEBUG_HASH_TABLE

# commands
# Note: "cc" should default to the main local C compiler; if it does not, on
# Linux, use "gcc", and on macOS, use "clang"
CC       = cc
RM       = rm -f
COMPILE  = $(CC) $(CFLAGS) $(DFLAGS)
INSTALL  = install

# files
EXES     = simplc testhashtable testscanner testsymboltable

# directories
BINDIR   = ../bin
LOCALBIN = ~/.local/bin

# Setting LOCALBIN to ~/bin used to be accepted practice.  Nowadays, many
# systems (and people) prefer placing user-specific executables in ~/.local/bin
# instead.  (In the olden days it was de rigueur to show off of arcane knowledge
# of Unices by having one's user binaries in plain sight, whereas nowadays
# everything must appear to work automagically.) Also refer to the note below on
# setting up your PATH variable.

### RULES ######################################################################

# executables

simplc: simplc.c codegen.o error.o hashtable.o scanner.o symboltable.o token.o \
       valtypes.o | $(BINDIR)
	$(COMPILE) -o $(BINDIR)/$@ $^

testhashtable: testhashtable.c error.o hashtable.o | $(BINDIR)
	$(COMPILE) -o $(BINDIR)/$@ $^

testparser: simplc.c error.o scanner.o token.o | $(BINDIR)
	$(COMPILE) -o $(BINDIR)/$(basename $<) $^

testscanner: testscanner.c error.o scanner.o token.o | $(BINDIR)
	$(COMPILE) -o $(BINDIR)/$@ $^

testsymboltable: testsymboltable.c error.o hashtable.o symboltable.o token.o \
                 valtypes.o | $(BINDIR)
	$(COMPILE) -o $(BINDIR)/$@ $^

testtypechecking: simplc.c error.o hashtable.o scanner.o symboltable.o token.o \
                  valtypes.o | $(BINDIR)
	$(COMPILE) -o $(BINDIR)/$(basename $<) $^

# units

codegen.o: codegen.c boolean.h codegen.h error.h jvm.h symboltable.h token.h \
           valtypes.h
	$(COMPILE) -c $<

error.o: error.c error.h
	$(COMPILE) -c $<

hashtable.o: hashtable.c hashtable.h
	$(COMPILE) -c $<

scanner.o: scanner.c scanner.h
	$(COMPILE) -c $<

symboltable.o: symboltable.c boolean.h error.h hashtable.h symboltable.h \
               token.h valtypes.h
	$(COMPILE) -c $<

token.o: token.c token.h
	$(COMPILE) -c $<

valtypes.o: valtypes.c valtypes.h
	$(COMPILE) -c $<

# BINDIR

$(BINDIR):
	mkdir $(BINDIR)

### PHONY TARGETS ##############################################################

.PHONY: all clean install uninstall types

all: simplc

clean:
	$(RM) $(foreach EXEFILE, $(EXES), $(BINDIR)/$(EXEFILE))
	$(RM) *.o
	$(RM) -rf $(BINDIR)/*.dSYM

# For your program to be in your PATH, ensure that the following is somewhere
# near the end of your ~/.profile (for macOS, this might actually be
# ~/.bash_profile) file:
#
# if [ -d "$HOME/bin" ] ; then
#     PATH="$HOME/bin:$PATH"
# fi
#
# If this is not set, the install rule will copy the executable to ~/bin, but
# it will not be resolved automatically by the shell.  If you update the
# profile, either close and reopen the terminal, or use the "source" command to
# reload the profile.
#
# Also, to enable bash completion (of filenames with .simpl extensions), add
# the following at the end of ~/.bashrc:
#
# # bash completion for SIMPL
# complete -f -X '!*.simpl' simplc

# Install all compiler-related binaries in the local bin.
install:
	mkdir -p $(LOCALBIN)
	$(INSTALL) $(foreach EXEFILE, $(EXES), $(wildcard $(BINDIR)/$(EXEFILE))) \
		$(LOCALBIN)

# Remove all compiler-related binaries from the local bin.
uninstall:
	$(RM) $(foreach EXEFILE, $(EXES), $(LOCALBIN)/$(EXEFILE))

# Make a highlight file for user-defined types.  This requires Exuberant ctags
# and AWK.  To use this in Vim, add the following four lines to your .vimrc:
# au BufRead,BufNewFile *.[ch] let fname = expand('<afile>:p:h') . '/types.vim'
# au BufRead,BufNewFile *.[ch] if filereadable(fname)
# au BufRead,BufNewFile *.[ch]   exe 'so ' . fname
# au BufRead,BufNewFile *.[ch] endif
types: types.vim
types.vim: *.[ch]
	ctags --c-kinds=t -o- *.[ch] |\
		awk 'BEGIN{printf("syntax keyword cType\t")}\
		{printf("%s ", $$1)}\
		END{if(!NR){print "XXX_placeholder"}else{print ""}}' > $@
	ctags --c-kinds=gsu -o- *.[ch] |\
		awk 'BEGIN{printf("syntax keyword cStorageClass\t")}\
		{printf("%s ", $$1)}\
		END{if(!NR){print "XXX_placeholder"}else{print ""}}' >> $@
	ctags --c-kinds=e -o- *.[ch] |\
		awk 'BEGIN{printf("syntax keyword cConstant\t")}\
		{printf("%s ", $$1)}\
		END{if(!NR){print "XXX_placeholder"}else{print ""}}' >> $@
	ctags --c-kinds=d -o- *.[ch] |\
		awk 'BEGIN{printf("syntax keyword cDefine\t")}\
		{printf("%s ", $$1)}\
		END{if(!NR){print "XXX_placeholder"}else{print ""}}' >> $@
