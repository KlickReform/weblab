##RESTful Webservice with PHP and the Slim-Framework
This application shows you how you can implement a RESTful API with PHP and the [Slim Micro-Framework](http://www.slimframework.com/).

The API is documented in this [Blog-Post](http://klickreform.de/blog/restful-webservices-mit-php-und-dem-slim-framework/). You can find more examples of how to use modern Framworks and libraries [here](https://github.com/KlickReform/weblab)

####Installation
1. Create a new MySQL database and name it planeeto (note: _you can also use the script planeeto.sql to do this_)
2. Execute the script contained in planeeto.sql to create the contents of the database.
3. Deploy the contents of this repository into a directiry on your webserver (i.e. */planeeto*)
4. Open the file index.php and enter your database credentials (close to the end of the script)
5. You can now access the API via cURL or any other HTTP Client Library (i.e. *http://localhost/planeeto/planets*)

####Credits
This application has been created by [KlickReform](http://www.klickreform.de). Please feel free to copy and use this code as you like.

The data contained in the database has been taken with kind regards from [Jedipedia](http://www.jedipedia.de/).
