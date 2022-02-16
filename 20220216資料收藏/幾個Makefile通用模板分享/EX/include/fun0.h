/*头文件*/
#ifndef _FUN0_H_
#define _FUN0_H_
#endif

extern void fun0_printf(void);
extern void fun1_printf(void);

/*源文件*/
#include <stdio.h>
#include "fun0.h"

void fun0_printf(void)
{
    printf("Call \'fun0\'. \r\n");
}