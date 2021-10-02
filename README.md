## Resource Manager

This is a simple resource manager where "administrator" can add resources and "visitor" can browse them.
As you can see there are two types of user for the application. So there routes are separated with a prefix.

For **'Administrator'** the routes are:

``/administrator/attachments (which let him to add/edit/delete pdf resources)``

``/administrator/snippets (which let him to add/edit/delete html snippets)``

``/administrator/links (which let him to add/edit/delete link resources)``

For **'Visitor'** the routes are:

``/attachments (which let him to browse and download pdf resources)``

``/snippets (which let him to browse and copy html snippets)``

``/links (which let him to follow link resources)``

## Project Setup

#### setup composer
Go to the project directory and open the terminal and hit

``composer install``

Then add an .env file in the root of the project directory and copy the .env.example contents, or you may copy the .env.copy file and rename it to .env

Next you should fill up the **APP_KEY** in the .env file with a long random string, or you hit the command below

``php artisan key:generate``

#### setup database
You need to fill up the database credentials in the .env file. Create a database according to you connection. The following fields need to filled up in the .env file


``DB_CONNECTION=`` default is mysql

``DB_HOST=  `` default is 127.0.0.1

``DB_PORT=  `` default is 3306

``DB_DATABASE=  ``

``DB_USERNAME=  ``

``DB_PASSWORD=``


After setting up the credentials you need to hit the following command

`php artisan migrate`

The default file storage settings is set to `'public'`. So set 

`FILESYSTEM_DRIVER=public` in you .env file and hit the following command

`php artisan storage:link`

#### Running the application
Before running the application you need to install the node modules in your project. Hit the following commands to install them

`npm install && npm run dev`

You're ready to go. Serve the application and visit it at the url provided in the terminal.

`php artisan serve`
