<h2>Setup Requirements (Windows)</h2>
install php 7.3 and composer [check this tutorial](https://devanswers.co/install-composer-php-windows-10/)
<p>install node and npm
<p>install XAMPP nad activate Apache and Mysql</p>
<p>create .env and copy the contents of .env.example</p>
<p>create database named "blog" if you are no using the mysql dump</p>

<h2>Run Following Terminal Commands</h2>
<code>php artisan key:generate</code>
<br>
<code>composer install</code>
<br>
<code>npm install</code>
<br>
<code> run php artisan serve</code>
<br>
<code>php artisan migrate --seed</code> (NO NEED TO DO THIS IF DB IS MADE THROUGH THE SQL DUMP)
