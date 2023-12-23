- composer install
- php artisan migrate
- php artisan db:seed
- php artisan passport: install
- php artisan serve

create new .env file from [.env.example](.env.example)

After installation, login to http://localhost:8000/admin/login.

- Email: admin@gmail.com
- Password: password

In the Banknotes section, you can create a new banknote, in users create new users, and in the logs, you can see the history of money withdrawn from the ATM.

Log in at http://127.0.0.1:8000/api/login api http://127.0.0.1:8000/api/user/withdraw and enter the amount to be withdrawn by post request
