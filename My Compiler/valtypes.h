/**
 * @file    valtypes.h
 * @brief   Value types for SIMPL-2018 type checking.
 * @author  W. H. K. Bester (whkbester@cs.sun.ac.za)
 * @date    2018-07-10
 */

#ifndef VALTYPES_H
#define VALTYPES_H

typedef enum {
	TYPE_NONE     = 0,
	TYPE_ARRAY    = 1,
	TYPE_BOOLEAN  = 2,
	TYPE_INTEGER  = 4,
	TYPE_CALLABLE = 8
} ValType;

#define IS_ARRAY(type)			(IS_ARRAY_TYPE(type) && !IS_CALLABLE_TYPE(type))
#define IS_ARRAY_TYPE(type)		/* TODO */
#define IS_BOOLEAN_TYPE(type)	/* TODO */
#define IS_CALLABLE_TYPE(type)	/* TODO */
#define IS_FUNCTION(type)		(IS_CALLABLE_TYPE(type) && !IS_PROCEDURE(type))
#define IS_INTEGER_TYPE(type)	/* TODO */
#define IS_PROCEDURE(type)		/* TODO */
#define IS_VARIABLE(type)		/* TODO */

#define SET_AS_ARRAY(type)		/* TODO */
#define SET_AS_CALLABLE(type)	((type) |= TYPE_CALLABLE)
#define SET_BASE_TYPE(type)		/* TODO */
#define SET_RETURN_TYPE(type)	((type) &= ~TYPE_CALLABLE)

/**
 * Returns a string representation of the specified value type.
 *
 * @param[int]   type
 *     the type for which to return a string representation
 * @return       a string representation of the specified value type
 */
const char *get_valtype_string(ValType type);

#endif /* VALTYPES_H */
