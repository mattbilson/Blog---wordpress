=== CodeHighlighter ===
Contributors: iwongu
Tags: post, formatting, syntax highlight
Requires at least: 2.0
Tested up to: 2.5
Stable tag: 1.8

This plugin is a syntax highlighter for source code using GeSHi.

== Description ==

This plugin is a syntax highlighter for source code. It uses *GeSHi* as fontifier engine.

= Usage =

1. Put the code snippet to pre tag.
1. Add the lang attribute to the pre tag like the following. `<pre lang="cpp">` 
1. Add the lineno attribute to the pre tag after the lang tag like the following if you want to display line numbers. The number in the lineno tag becomes a start line number. There is no default value for the start line number. So you must supply the value to the lineno tag. `<pre lang="cpp" lineno="1">`
1. If you do not add lang attribute, the pre tag is handled normally.
1. If you want to have border, add the style like the following to your .css file. `pre { border: 1px dotted #ccc; padding: 0.2em 0.5em; }`
1. You can use following languages in lang. `abap, actionscript, ada, apache, applescript, asm, asp, autoit, bash, blitzbasic, bnf, c, c_mac, caddcl, cadlisp, cfdg, cfm, cpp-qt, cpp, csharp, css-gen, css, d, delphi, diff, div, dos, dot, eiffel, fortran, freebasic, genero, gml, groovy, haskell, html4strict, idl, ini, inno, io, java, java5, javascript, latex, lisp, lua, m68k, matlab, mirc, mpasm, mysql, nsis, objc, ocaml-brief, ocaml, oobas, oracle8, pascal, per, perl, php-brief, php, plsql, python, qbasic, rails, reg, robots, ruby, sas, scheme, sdlbasic, smalltalk, smarty, sql, tcl, text, thinbasic, tsql, vb, vbnet, vhdl, visualfoxpro, winbatch, xml, xpp, z80` 

= Preview =

* [CodeHighlighter plugin test page](http://ideathinking.com/blog-v2/?p=13)

== Installation ==

1. Unzip the plugin archive.
1. Upload the directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Known issues ==

1.  Because this plugin uses regular expression to match string range from `<pre lang="some">` to `</pre>`, you can't use `</pre>` in your code snippet. If you must put the `</pre>` tag, you can put a space between `<` and `/pre>` like `< /pre>`. The `< /pre>` is converted to `</pre>` automatically by plugin.
1. If you want to change the style, you should modify the plugin source file. :-P

