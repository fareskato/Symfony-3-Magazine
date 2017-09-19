Symfony 3 Ecommerce with Admin panel
======

### Create Service
01- create the service class

02- declare the service in services.yml
    
    sevice_name:
        class: Path_to_the_service_class(AppBundle\Foo\Service)

03- if U want to use the service in template : define it under 

    twig:
        globals:
            service_name: "@service_name"

