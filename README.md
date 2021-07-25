## Backend Developer Challenge, Sacoor brothers

this task has been build in PHP Laravel 5.8, a rest API to filter a JSON file by name and PVP fields, with swagger UI documentation, unit test for the main cases, and a Docker image to set up a fresh LAMP stack
### the back end code

- an endpoint to filter a json response build with MVC design pattern 
can be accessed at `Host/api/products/filter`
- the `ProductController` contains the main function that handles the request .
- the `Product` Model contains the function `filterProducts` that can filter the products array with any type of filters (one or multiple fields)
- the Helper `ArrayToXml` contains the function `array_to_xml` that can convert an array to XML format

### Consuming the API
the project also have `SWAGGER UI` witch is accessible on `Host/api/documentation` , U can test and consume the api through it.
### Tests
the Test `JsonFilteringTest` have tests functions for a multiple endpoint's use cases
### Docker
U can set up the environment to run the project using docker image , all docker details located in `docker-compose.yml` file 
