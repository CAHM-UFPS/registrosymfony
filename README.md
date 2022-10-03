# registrosymfony

# Pre-evaluación práctica Symfony 02/10/2022

### Instancia Ubuntu 22.04 - DigitalOcean

> IP : 137.184.57.62
> Credenciales de acceso son de conocimiento del instructor (no es adecuado escribirlas aquí por ser un repositorio p)

### Endpoints

##### POST

> 137.184.57.62/user/create  ---> Create users with fullName, user, password, address, email, phone and authorization properties.

> 137.184.57.62/user/login ---> Allow login user with user and password properties.

> 137.184.57.62/products/create ---> Create products with name, quantityProduct and price properties.

##### GET

> 137.184.57.62/user/list ---> List all registered users.

> 137.184.57.62/products/list ---> List all registered products.

> 137.184.57.62/products/list/{limit} ---> List registered products with a limit (int number)

> 137.184.57.62/products/list/name/{name} ---> List registered products search by name property (string)
