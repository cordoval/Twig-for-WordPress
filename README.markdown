# Intro

Twig for WordPress is an implementation of the [Twig Template Engine](http://www.twig-project.org/) for [WordPress](http://www.wordpress.org). It allows WordPress themes to be developed much quicker and using much simpler template files.

# Basis

This is not a WordPress plugin. It's a sample theme (a copy of the default TwentyTen theme) that uses hooks to process template files through Twig instead of WordPress's normal raw PHP files.

# Progress

The current release is a very early alpha version. A lot of the functionality is not working at the moment and it is definitely not ready for production use. Think of it as a proof of concept and a starting place for development.

To get around the big differences between how WordPress and Twig handle templating, we've started to come up with an object-orientated middle-layer for WordPress themes. This makes it easy to access properties in Twig templates e.g. {{ post.title }} or {{ author.name }}

# Next Steps

* Standardise and simplify objects (e.g. post, page, comment, author)
* Document all classes and properties
* Find a solution to the sidebar functions
* Reduce the number of WordPress template functions we pass through
* Remove a lot of the "twentyten_" functions from functions.php

# Requirements

We've taken some legacy code out of the TwentyTen theme that catered for older versions of WordPress, so make sure you're running [3.1 "Reinhardt"](http://wordpress.org/news/2011/02/threeone/). The Twig Template engine requires PHP 5.3.

# Caveats

There are a couple of bits of the default TwentyTen theme that have been removed during early development to simplify things. These are currently:

* Internationalization
* Password-protected posts
* Pagination of comments

# Contributing

Please get in touch if you'd like to contribute at all. We'll be firming up the object interface as soon as possible, which will give a better platform for development.

We're especially keen to speak to designers who want to create WordPress themes about what they find difficult / frustrating about current WordPress development.

# Links

* [Twig Template Engine](http://www.twig-project.org)