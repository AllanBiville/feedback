BADGES 

CodeFactor : [![CodeFactor](https://www.codefactor.io/repository/github/allanbiville/feedback/badge)](https://www.codefactor.io/repository/github/allanbiville/feedback)

Codacy : [![Codacy Badge](https://app.codacy.com/project/badge/Grade/dae3579f529b457a8e46efe304fb48cb)](https://www.codacy.com/gh/AllanBiville/feedback/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=AllanBiville/feedback&amp;utm_campaign=Badge_Grade)

### SYMFONY     VERSION 5.4.2 ###
### COMPOSER    VERSION 2.1.8 ###
### PHP         VERSION 7.4.9 ###

![FeedBack](https://raw.githubusercontent.com/AllanBiville/feedback/master/public/images/feedback.png)

## Description
Self-feedback is an online website software, a PHP web application developed using the Symfony framework (version 5.4.2).
He has for objectif to send opinion to a meal with a commentary and a specifics opinions to different criteria. 
It also aims to be able to retrieve its opinions in various form to analyze them.

To do this, we made a site in 2 distinct parts:
- A part for users who will only give a review in a form
- A second part, a panel for administrators who can retrieve the reviews in the form of a table and graph that can be consulted on the site or downloaded in PDF format. We have made this part limited to access with a login form with username and password securized.

Thanks to [Symfony](https://symfony.com/)

## Installation

### 1) Get all source files

- git clone https://github.com/AllanBiville/feedback.git
- composer install


### 2) Create database

Copy **.env** file to **.env.local**

Edit line **DATABASE_URL="mysql://user:password@127.0.0.1:5432/feedback"**

Execute command : 
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load
- php bin/console server:start


### 3) With your web browser open url where server is listening on

For example, with your browser open this page :  http://localhost:8000 and GO !

Here is initial credentials of the admin user.
 - Username : admin
 - Password : admin

Here is initial credentials of the super-admin user.
 - Username : superadmin
 - Password : superadmin
 
 Here is initial credentials of the pin code to access QRcode.
 - Pin code : 12345