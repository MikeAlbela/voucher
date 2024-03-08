To Start: create a database "shakewell" also update the .env file for the database username and password


To Register submit post request on this url http://localhost:8000/api/register with the following parameters:
name
email
password
c_password

To Login submit post request on this url http://localhost:8000/api/login with the following parameters:
email
password

To generate vouchers submit get request on this url http://localhost:8000/api/generate (copy the return token from login request to bearer token)

To list all vouchers of the logged in user, submit get request on this url http://localhost:8000/api/list (copy the return token from login request to bearer token)


To Login submit post request on this url http://localhost:8000/api/login (copy the return token from login request to bearer token) with the following parameter:
voucher