Contributing to LibreSignage
----------------------------

1 Programming styleguide
++++++++++++++++++++++++

First of all, keep your coding style sane. If you write some code and
take a look at it afterwards and it looks messy, fix it. This style
guide has some general directions for writing readable code, but you'll
still have to use your own brain too.

1.1 JavaScript
##############

1.1.1 General
*************

* Line width is 80 characters **at the most**, but try to keep it a
  bit shorter than that. 70ish characters is a good limit to use.
* A semicolon (;) is placed after most statements.

1.1.2 Indentation
*****************

* Indentations **ONLY** contain tabs and **NEVER EVER** contain **ANY**
  spaces. If your editor adds spaces to your indentations, fix it.
  The indentation width should be 4 characters. (Note that in this
  document all code is indented with spaces for formatting reasons,
  but you should still only use tabs.)
* No trailing whitespace at the end of lines.
* Spaces are only used to separate keywords and *space* code to eg.
  align variable declarations to make them more readable.

.. code-block::

  // Acceptable use of spaces for *spacing*.
  var foo     = 'bar';
  var bar     = 'foo';
  var foo_bar = 'bar_foo';

  // Bad, indentation must be 4 characters wide.
  function multiply(a, b) {
    return a*b;
  }

  // Good
  function multiply(a, b) {
      return a*b;
  }

1.1.3 Functions
***************

* No spaces between function names and parentheses.
* No spaces separating parentheses from arguments
* Add one space after each comma separating function arguments.
  This applies in function declarations and when calling functions.
* The opening curly bracket is always on the same line as the
  statement it belongs to. The closing bracket can be on the
  same line or on another one.

.. code-block::

  // Bad
  function make_coffee ( type,temperature )
  {
  	...
  }

  // Good
  function make_coffee(type, temperature) {
  	...
  }

* If a function requires many arguments, the different arguments
  can be separated on different lines when declaring or calling
  the function.
* It's often beneficial to use named arguments when calling a
  function if the function requires many arguments.

.. code-block::

   function do_stuff(
       arg1,
       arg2,
       arg3
   ) {
       // Do stuff
   }
  
   do_stuff(
       'Value 1',
       true,
       'Value 3'
   );
  
   do_stuff(
       arg1 = 'Value 1',
       arg2 = true,
       arg3 = 'Value 3'
   );

1.1.4 Conditionals
******************

* Always separate conditional keywords, the conditional and the
  brackets after the conditional with a space.
* Refer to `1.1.3 Functions`_ for bracket usage.

.. code-block::

  // Bad
  if(type == 'espresso'){ ... }

  // Good
  if (type == 'espresso') { ... }

1.1.5 Operators
***************

* Add spaces on either side of the operators =, +, -, >, <, / including
  combinations of these.
* Don't add spaces around the multiplication operator (*).
* Don't add spaces between variables and the postfix/prefix increment
  and decrement operators (--, ++).

.. code-block::

  let a = 10 + 4*10;
  a++;
  --a;

1.1.6 Variables, objects and arrays
***********************************

* Prefer *let* and *const* over *var* to make code easier to debug.
* Always separate curly/square brackets from array/object values with
  spaces when the opening and closing curly/square brackets are on the
  same line.
* Add one space after each comma in object and array declarations when
  the array or object values are on the same line. **Never** add trailing
  commas at the end of lines.

.. code-block::

  // Bad
  let array = [1,2,3,4];
  let obj = {a: 'a', b: 'b'};
  
  // Good
  let array = [ 1, 2, 3, 4 ];
  let obj = { a: 'a', b: 'b' };

* Separate array and object values on multiple lines in long array/object
  declarations.

.. code-block::

  // Bad
  let array = ['val1', 'val2', 'val3',
               'val4', 'val5', 'val6'];

  // Good
  let array = [
      'val1',
      'val2',
      'val3',
      'val4',
      'val5',
      'val6'
  ];

1.1.7 Naming
************

* All names (function, variable etc.) should be descriptive enough but
  not too descriptive. For example, local names don't need to be too
  descriptive and acronyms or single letters are often enough. Global
  names, however, need to be quite descriptive. Using global variables
  is discouraged, of course, but they are still needed from time to time.
* All names use the **underscore notation**. *camelCase* or *hungarian
  notation* isn't accepted.

.. code-block::

  var flag_coffee_ready = false; // Global variable with descriptive name.
  
  function make_coffee() {
      let c = new coffee.Coffee(); // Short local variable name.
      c.temperature = coffee.Coffee.TEMP.HOT;
      return c;
  }

1.1.8 Comments
**************

* Every source file should start with a *brief* comment block describing
  the functionality that's implemented in that file.
* As a general guideline, comment your code but don't fill it with
  comments.
* If a function does a complicated task and you think the function
  name is not a good enough description of what the function does, add
  a short comment block at the start of the function describing what it
  does. *Do not* describe how the function does it. That should be clear
  from the function code. If it isn't, you should probably rewrite the
  function so that it is. Describing how a function does something is
  not normally needed.
* Short functions with self-explanatory names and code don't need any
  comments.
* Only add comments to the function body when there's a really good
  reason to do that, eg. some non-obvious way to accomplish a specific
  thing. That said, you should always avoid any non-obvious code.
* **No** comment blocks separating different sections in a file. These
  have no use whatsoever. If your source file is so large you think it
  requires sectioning with comments, you should most probably split it
  into multiple files instead.
* **No** automatic editor generated comments. These add nothing to the
  code and just clutter it.
* **No** editor modelines. People have different editor configurations
  and source files shouldn't override them.
