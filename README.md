# registrosymfony

# Pre-evaluación práctica Symfony 02/10/2022

### Instancia Ubuntu 22.04 - DigitalOcean

> IP : 137.184.57.62
> Credenciales de acceso son de conocimiento del instructor (no es adecuado escribirlas aquí por ser un repositorio prueba)

### Endpoints

##### POST

* 137.184.57.62/user/ ---> Create users with fullName, user, password, address, email, phone and authorization properties.

###### Example Input:

> {
    "fullName" : "Pepito Diaz",
    "user" : "PEPITODIAZ",
    "password" : "1234",
    "address" : "Calle 6 # 13-11",
    "phone" : "3001231147",
    "email" : "pepitodiaz@correo.com",
    "authorization" : true
   }
   
###### Response: 204 or 400 if Bad Request

* 137.184.57.62/user/login ---> Allow login user with user and password properties.

###### Example Input:

> {
    "user" : "CAHM",
    "password": "1234"
  }
  
###### Response: 200 or 400 if Bad Request with message: "User or Password incorrect"

* 137.184.57.62/products/ ---> Create products with name, quantityProduct and price properties.

###### Example Input:

> {
    "name": "Submarinos",
    "quantityProduct": 30,
    "price": 1200
  }
  
###### Response: 204 or 400 if Bad Request

* 137.184.57.62/order/ ---> Create order with sendAddress property and token validation argument.

###### Example Input:

> {
    "sendAddress": "Calle 6 # 23-60",
    "orderDetails": [
        {
            "product": "633c474676bad2ce9504fcf6",
            "quantity": 2
        }
    ]
  }
  
###### Response: 200, 400 if Bad Request or 401 if you token is not valid

##### GET

* 137.184.57.62/products/list ---> List all registered products, optional (limit and name)

###### Example Output:

> [
    {
        "id": "633c4560e5102e1f66097fa6",
        "name": "Chocorramo",
        "quantityProduct": 20,
        "price": 2000
    },
    {
        "id": "633c471dedfa8b8bc00b6b33",
        "name": "Papas fritas",
        "quantityProduct": 20,
        "price": 2500
    },
    {
        "id": "633c472ce5102e1f66097fa7",
        "name": "Mermelada",
        "quantityProduct": 20,
        "price": 1500
    },
    {
        "id": "633c474676bad2ce9504fcf6",
        "name": "Submarinos",
        "quantityProduct": 30,
        "price": 1200
    }
 ]
 
 * 137.184.57.62/products/list?limit={value}
 
 ###### Example Output:
 
 > [
    {
        "id": "633c4560e5102e1f66097fa6",
        "name": "Chocorramo",
        "quantityProduct": 20,
        "price": 2000
    },
    {
        "id": "633c471dedfa8b8bc00b6b33",
        "name": "Papas fritas",
        "quantityProduct": 20,
        "price": 2500
    }
  ]
  
  * 137.184.57.62/products/list?name={value}
  
  ###### Example Output:
  
  > [
     {
        "id": "633c474676bad2ce9504fcf6",
        "name": "Submarinos",
        "quantityProduct": 30,
        "price": 1200
     },
     {
        "id": "633de12eedfa8b8bc00b6b71",
        "name": "Submarino Fresa",
        "quantityProduct": 30,
        "price": 1800
     }
   ]
  
  * 137.184.57.62/products/list?limit={value}&name={value}
  
  ###### Example Output:
  
  > [
     {
        "id": "633c474676bad2ce9504fcf6",
        "name": "Submarinos",
        "quantityProduct": 30,
        "price": 1200
     },
     {
        "id": "633de12eedfa8b8bc00b6b71",
        "name": "Submarino Fresa",
        "quantityProduct": 30,
        "price": 1800
     }
   ]
