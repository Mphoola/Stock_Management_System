
# Stock Management System

A cool application to manage stocks in a small shop. Get to know which products are sold the most, which are the most profitable, and which are the least profitable.
Manage expenses and incomes, and get to know the balance of your shop. 



## Features

- CRUD for products, Sales, Expenses, Users.
- Notifications to manager when stock of a product is below the set minimum value.
- Charts for all sales, expenses per given time
- Many more to come


## Tech Stack

Laravel, API, Vue 3, Axios, Vuex, Vue Router, Bootstrap, HTML and CSS

## Run Locally

This project requires PHP version ^8.0.2 .
Downloading and extract a zip file of this project or directly clone it to any of your server
folder.

Run below command to install dependancies

```bash
  composer install
  cd Stock_Management_System
  
```

Since we are also using Vue JS, we need to install npm dependancies

```bash
  npm install
```

copy .env.examples to .env and and update your DB credentials
    
```bash
    php artisan key:generate
    php artisan serve
```

Run the code below to generate the database tables and seeder the DB with some dummy data

```bash
    php artisan migrate --seed
```

On another ternimal run below command to start vue js

```bash
    npm run dev
```

## Screenshots

![App Login]('https://github.com/Mphoola/Stock_Management_System/blob/main/public/assets/screenshots/login.png')

## Contributing

Contributions are always welcome!



## 🚀 About Me
I'm a full stack developer from Malawi. I work more effeciently with Laravel, Vue, Python
and many more backend end languages. Am a fast learner and a result oriented person with a 
degree in Computer Systems and Security from Malawi University of Science and Technology (MUST).


## Author

- [@Mphoola](https://www.github.com/Mphoola)


## Security Vulnerabilities
If you discover a security vulnerability within Muzic, please send an e-mail to 
Promise Mphoola via promisemphoola2@gmail.com. All security vulnerabilities will be promptly addressed.
## License
The Stock Management System is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)

