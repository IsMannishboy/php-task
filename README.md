in this project there are 3 services and 3 images for everyone.Nginx service takes all request and resend it to back and vue containers.Back service runs only with symfony without apachie.Vue service also runs in dev mode.
    In backend service clear principles are followed.Here i used symfony di for maintain an open/closed principle.Here if some new carrier must to be added i can make new inheritance and define it in service.yml so symfony can add this class as previos ones.There domain driven approach is used.In domain directory there is a  CarrierInterface and his inheritances.In Service folder there is a hashtable class where i store all carriers by value.
    ApiController has two methods:getCarriers which returns all carriers name in array and calculateShipping this method gets body  check carriers name and weight.If validation is passed here inheritances method calculateShipping is called
    In vue.js app there is one page for calculating price.In main component the getCarriers request calls after component is created and before it is rendered.This method fetchs an array of carriers names so i can use it in the list
    I nginx i defined all needed routes for communication with vite in dev mode.
Every image has a few stages so all of them can be cashed.It speed up image building
In docker compose.yml file i defined new local network : php-task-net so all containers are in the same network
Also there are unit test for all inheritances and functional test for ApiController
