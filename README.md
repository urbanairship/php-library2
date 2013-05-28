Urban Airship PHP Library (Beta)
================================
*This is an in progress document*

**Requirements**

**Configuration**

The project expects a enviroment variable denoting the root path of the project.::
  UA_HANGER=/path/to/root/
  
Depenedencies are managed with Composer. Composer can be found here: http://getcomposer.org/
Workflow aims to be
  - download repo
  - composer install
  - start working

I'm going for a single API class (UrbanAirshipAPI) and a bunch of data model classes. The API class is 
simply a bunch of static methods that wrap HTTP calls to the API and return results. 

Testing is done with PHPUnit. 
Documentation is built with PHPDocumentor.
