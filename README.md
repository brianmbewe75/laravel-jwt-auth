# laravel-RESTFUL-API-JWT-auth
 Laravel API using JWT token for authentication(Login, Register and Logout)

To Run start by creating a database called laravel-jwt-auth in mysql or maria db 

3. Open the ".env" file and ensure your database user credentials are correct 

4. In the terminal run "php artisan migrate"

5 you can then run "php artisan serve"

6. Your api should be running on http://localhost:8000

#To utilize the API install postman https://www.postman.com/downloads/

7. POST: http://127.0.0.1:8000/api/auth/register   to add new user
8. POST: http://127.0.0.1:8000/api/auth/login   to login (take note of the bearer token generated)  (the token only has a time to live of up to 60 minutes)
9. GET: http://127.0.0.1:8000/api/auth/profile   supply the bearer token under the authorization headers
10. http://127.0.0.1:8000/api/auth/logout        to terminate the session


"Happy Hacking !"
