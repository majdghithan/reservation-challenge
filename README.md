![ERD Diagram](/public/graph.png)

## Assumptions

- No need for an authenticated user to make reservation
-  Each room feature has different price in rooms
- No restriction or any rules on cascading delete
- One static currency: USD, for multiple currencies I would prefer to use https://github.com/moneyphp/money
- Two roles: super-admin and employee for each building.
- Super admin created users and no need for sign up.
- Assuming 1 language for the app
- no need to document the api
- no need to Infolist feature
- same price for all persons count
- without unit testing
- minimal simple reservation system is required without much validation on years.


## Getting Started

- Clone the repository
- cp .env.example to .env by running `cp .env.example .env`
- Update the database credentials in .env
- Adjust the APP_URL in .env
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- To seed the database run `php artisan db:seed`
- Run `php artisan storage:link`
- Run `npm install`
- Run `npm run dev` or `npm run build`
- Run `php artisan serve` to start the server


## Enhancements
- Using polymorphic relationship for features
- Change relation between users and buildings to many-to-many
- enhance view policy
- add unit testing
- adding a service to get available days for rooms and disable unavailable days from frontend
- use Infolist to view records
- use Database indexes

