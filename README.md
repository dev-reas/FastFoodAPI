# FastFoodAPI

# Please note its not uploaded in the android studio or in IOS because of the lack of space in my asset.
Please use the web application for now.

# How to run
1. Setup your MySQL database like this (I am using TablePlus)

![image](https://github.com/dev-reas/FastFoodAPI/assets/70940934/a6463c16-d6ef-441c-a05f-51cea1bd5be5)

2. Change the user and password based on your local. Also change the DB_USERNAME and DB_PASSWORD too in your local.
3. After that, run the php artisan migrate:fresh --seed in your command line to insert the data in the database.
4. Then run php artisan serve --host=your_ip_address --port=8000

