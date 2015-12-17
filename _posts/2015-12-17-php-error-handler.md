## php 错误处理函数
http://php.net/manual/zh/ref.errorfunc.php

### 0. 概述
php中出错信息、notice信息、异常都会直接输出到stderr。对于这些信息我们需要对其进行捕获和处理。

###1. 错误处理函数set_error_handler

`mixed set_error_handler(callable $error_handler[, int $error_types = E_ALL | E_STRICT])`

1. 目的：

通过设置一个用户函数error_handler来处理脚本中出现的错误。
【重要的是记住】：error_types里面指定的错误类型都会绕过PHP标准错误处理程序，除非回调函数返回false。

以下级别的错误不能由用户定义的函数来处理： E_ERROR、 E_PARSE、 E_CORE_ERROR、 E_CORE_WARNING、 E_COMPILE_ERROR、 E_COMPILE_WARNING，和在 调用 set_error_handler() 函数所在文件中产生的大多数 E_STRICT。

2. 返回值：
如果之前有定义过错误处理程序，则返回该程序名称的 string；如果是内置的错误处理程序，则返回 NULL。 如果你指定了一个无效的回调函数，同样会返回 NULL。 如果之前的错误处理程序是一个类的方法，此函数会返回一个带类和方法名的索引数组(indexed array)。


###2. 异常处理函数 set_exception_handler

1. 目的
设置一个用户定义的异常处理函数
2. 返回值
返回之前定义的异常处理程序的名称，或者在错误时返回 NULL。 如果之前没有定义一个错误处理程序，也会返回 NULL。 如果参数使用了 NULL，重置处理程序为默认状态，并且会返回一个 TRUE。


###3. error_log
http://php.net/manual/zh/function.error-log.php
`bool error_log ( string $message [, int $message_type = 0 [, string $destination [, string $extra_headers ]]] )`

1. 目的
发送错误信息到某个地方。

###4. debug_backtrace
`array debug_backtrace ([ int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT [, int $limit = 0 ]] )`

1. 目的
产生一条回溯跟踪backtrace


###5. error_get_last
`array error_get_last ( void )`

1. 目的
获取关于最后一个发生的错误的信息
2. 返回值
返回了一个关联数组，描述了最后错误的信息，以该错误的 "type"、 "message"、"file" 和 "line" 为数组的键。 如果该错误由 PHP 内置函数导致的，"message"会以该函数名开头。 如果还没有错误则返回 NULL

###6. error_reporting
`int error_reporting ([ int $level ] )`

1. 目的
设置应该报告何种PHP错误
2. error_reporting() 函数能够在运行时设置 error_reporting 指令。 PHP 有诸多错误级别，使用该函数可以设置在脚本运行时的级别。 如果没有设置可选参数 level， error_reporting() 仅会返回当前的错误报告级别。
3. 错误级别
    http://php.net/manual/zh/errorfunc.constants.php
4. 特别注意
    如果设置了set_error_handler以后，则会绕过error_reportiong




