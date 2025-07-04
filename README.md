# product-prices
A symfony based sample project to get the product prices through REST API which is stored from multiple, but locally stored sources.

---

## Features:
A symfony based PHP App to :
- Get the product prices from multiple mock sources
- Aggregate and find the cheapest prices per product
- Save product prices to the database
- Retrieve product prices via API
- API key authentication
---

## Requirements
- PHP >= 8.3.9
- MySql Server = 8*
- GIT
- Composer
- Symfony CLI
- Apache or Nginx (for this project simple symfony server is good to go)
- Postman client (optional but better to have)
- MySQL client (optional but highly recommended)

---

## Installation:
### 1. Clone the project into your server folder through

```shell
git clone https://github.com/adeel-sohail/product-prices.git
cd yourrepo
```
> **Hint:**
> - if GIT is not installed. Install it according to your OS from here. https://github.com/git-guides/install-git

### 2. Local Configuration
- Create a `.env.local` file and setup your local environment.
- Setup `DATABASE_URL` as provided in .env file.
- `APP_API_KEY`is must to have without it your API calls will not work. Set this up with secure key.
- Hint: You can also create the secure key with 
- ```shell
  openssl rand -hex 32
  ```


### 3. Install symfony

To install the `symfony` command, run the following command:

```shell
curl -sS https://get.symfony.com/cli/installer | bash
```

You can start a symfony development server using:

```shell
# start a dev server on http://localhost:8000/ or http://127.0.0.1:8000
cd ../symfony
symfony composer install
symfony server:start --no-tls
```
> **Hint:**
> - You might get the error that symfony not found. The easiest way is to run this command :

- ```shell
  export PATH="$HOME/.symfony/bin:$PATH"
  ```
> **Hint:**
> - Instead of `symfony composer install` you can also run simple `composer install`

### 4. Setup Database

Run these commands into your project folder. 

```shell
#It will setup the database with the name you have provided in DATABASE_URL in .env.local
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate
```
- If successful you will see table product in your database.

- At this point your project should be up and running.

### 5. Updating Code:

Master branch is locked and directly pushing to master branch is not permissible. Please create the branch and merge it through pull request if you want to update code.

---

## API

There are two essential API requests working. You can test these either with curl or in Postman. 

> **Note:**
> - You have to provide the X-AUTH-TOKEN in authorisation tab in Postman.

- ##### /api/prices
    This will return all the products from the database with their lowest price and vendor name.
    ```shell
  curl --location 'http://127.0.0.1:8000/api/prices' \
    --header 'X-AUTH-TOKEN: YOUR_API_KEY_HERE'
    ```
  

- ##### /api/prices/{id}

    This will return a single product based on Id from database. In case no product found it will return an empty array.
    ```shell
    curl --location 'http://127.0.0.1:8000/api/prices/123' \
    --header 'X-AUTH-TOKEN: YOUR_API_KEY_HERE'
    ```
    
### Additional API routes

- ##### /api/product-prices/raw
    
    Will return all the data from mock data json files in raw form. 

- ##### /api/product-prices/agg

    Will return all the data from mock data json files but in aggregated form and grouped in ids.

- ##### /api/product-prices/cheapest
    
    Will return the data from json files but with cheapest price and their vendor name each seperated by id.

- ##### /api/product-prices/save

    Will write the data to database, getting it from mock json files.
--- 

## Code Structure

This project uses a layered architecture in symfony. Below is a summary of the main directories and files:

- **`src/Controller/`**  
  Handles incoming API requests and delegates processing to services.
    - **`MockApiController.php`**  
      Exposes endpoints for fetching raw, aggregated, and cheapest product prices from mock data, and for saving product prices.
    - **`ProductController.php`**  
      Provides endpoints for retrieving product prices from the database.

- **`src/Service/`**  
  Contains business logic, data aggregation, and application processes.
    - **`MockApiService.php`**  
      Reads mock product data from local JSON files, aggregates it, finds cheapest prices, and saves data via the repository.
    - **`ProductService.php`**  
      Retrieves stored product prices using the repository.

- **`src/Repository/`**  
  Handles data access logic, interacting with the database through Doctrine ORM.
    - **`ProductRepository.php`**  
      Custom repository with methods to save and fetch product price data.

- **`src/Entity/`**  
  Defines database models/entities.
    - **`Product.php`**  
      Represents a product’s price record, including product ID, vendor name, price, and timestamp.

**Typical flow:**  
`Controller` → `Service` → `Repository` → `Entity (Database)`

- **Controllers** accept and route HTTP requests.
- **Services** contain the business/data logic.
- **Repositories** interact with the database.
- **Entities** map to database tables.

---

> **Note:**
> - All endpoints require an API key via the `X-AUTH-TOKEN` header.
> - Mock data is loaded from JSON files for development and testing.

---
# License

MIT License

Copyright (c) 2025 Adeel Sohail.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
