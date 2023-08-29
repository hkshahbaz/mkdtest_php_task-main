# php_task

1. Clone repo into your github
2. Use https://flightphp.com/
3. Use this library to connect to mysql https://redbeanphp.com/index.php
4. Use this library https://github.com/stripe/stripe-php
5. Use bootstrap 4 for ui
6. Make the following page by end of day, no exceptions:
- / => show products from db table products (id, title, description, image, price)
- /product/:id => show product detail with image of product and title and description. 
Have a button buy now that open a modal for stripe checkout.
Once checkout done, write into order table(id, product_id, total, stripe_id, status(paid, failed)).
Show thank you page of purchase showing a table of product title, price, payment method
