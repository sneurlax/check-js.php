# check-js.php

Simple php tool for checking if javascript is enabled.  [Original code](https://gist.github.com/erm3nda/4af114b520c7208f8f3f) by erm3nda

## Explanation

Tries to use an AJAX call to set ?

## Usage

Include check-js.php in the ``<body>`` of your HTML document.  ``if(isset($_SESSION['js']))`` will return ``true`` if javascript is enabled.

Set ``?debug`` to echo the test results