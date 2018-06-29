# BigBridge Product Import

Hi! My name is Patrick van Bergen. I created this library because I needed product import to be fast.

This library imports product data into Magento 2 via direct database queries. It has these main features

* A programming library to import products
* An XML-file import tool for products
* A tool to update url_rewrites

## Disclaimer

The aim of this library is speed. If you find that Magento 2's product importer is too slow, consider using this library.

However, the library bypasses all of Magento's API's to insert data directly into the database. Possible problems with this approach are:

* The library creator is not perfectly knowledgeable of all Magento's ins and outs (even though he tries hard to be). It is possible that the data is not entered in exactly the same way that Magento 2 does it.
* The library is still new and brings with it its own set of bugs and problems.
* Magento may change its data structure in the future. The library may not follow.

Experiment with the library in a safe webshop. Make sure to create a database backup before you start.

## Assumptions

* For Magento 2.1+ Opensource Edition
* Requires >= PHP 7.0
* Input in UTF-8 (Magento standard)
* MySQL max_packet_size on both MySQL client and MySQL server must be at least 1 MB (Which will be the case if the value wasn't deliberately lowered from the default)
* Unix system (not tested on Windows)

## Features of the Import Library

* insert, update and delete products
* product identification based on product sku or id
* all product types (simple, configurable, grouped, bundle, downloadable, and virtual)
* automatic category generation
* automatic select and multiselect attribute option creation
* import of images from file or url
* image caching (local and HTTP cache)
* custom options
* unique url_key generation
* url_rewrite creation
* whitespace trimming (spaces, tabs, newlines) from all fields, except free field texts
* attribute deletion
* input validation (data type, requiredness,  and length restrictions)
* product type changes
* importing links to products have not been imported yet
* dry run (no products are written to the database)

Continue to read about [all importer features](doc/importer.md)

## XML file import tool

The XML import tool allows you to import product data with an XML file. It is fast and has a fixed, low memory footprint.

~~~
    bin/magento bigbridge:product:import --help
~~~

Continue to read about  [XML file import](doc/xml-import.md)

## The url_rewrite tool

Since Magento's url_rewrite table can get corrupted in many ways, it is necessary to have a tool to fix it.

This tool has the following features:

* Fast, it writes queries directly.
* It imposes no downtime for the webshop
* It updates the url_rewrite and catalog_url_rewrite_product_category per product
* It respects Magento's configuration setting "Create Permanent Redirect for URLs if URL Key Changed"
* It does not delete existing 301 url_rewrite redirects
* It does not overwrite existing non-product rewrites
* Updating single store views is possible
* Products with a visibility of "not-visible-individually" get no url_rewrite (since they would have no use; this is Magento 2 policy)

~~~
    bin/magento bigbridge:product:urlrewrite --help
~~~

## Changes to Magento

The extension adds an index CATALOG_PRODUCT_ENTITY_VARCHAR_ATTRIBUTE_ID_VALUE to catalog_product_entity_varchar because it drastically speeds up checking for duplicate url_keys.

## Thanks to

Thanks to Marco de Vries for telling me about the intricacies of product import.

This project owes a great deal of ideas and inspiration from Magmi / Magento 1 [Magmi](https://github.com/dweeves/magmi-git)
