# 3380 Casino

## Team Members
* Kyle Deppe
* Kyle Moore
* Brent Schultz
* Ethan Schutzenhofer
* David Huangal

# Description of application
Our project is an online casino. We created a web application where you can create a gambling profile and gamble your "Kyle Koins."
You can create your own gambling account and play the card game of blackjack. 
# Schema
## table users
id int primary key auto_increment not null,  
username varchar(255) not null unique,  
password text not null,  
koins int  


## table emails 
id int primary key auto_increment not null,  
email varchar(255) not null unique  


# Elements of CRUD
## Create
A new row is inserted into a table when the user creates an account. This can be seen on lines 116 and 118 of "login.php".

## Read
Information is read from a table when the user logs in to an existing account, or, when the program fetches the user's "Kyle Koin" balance. The code for the latter scenario can be seen on line 24 of "getkoins.php".

## Update
Information is updated in a table when the user finishes a round of Blackjack, or, when the user clikcs "Refill Koins" on their profile page. The code for the latter scenario can be seen on line 24 of "refillkoins.php".

## Delete
Information is deleted from a table when the user clicks "DELETE ACCOUNT" on their profile page. This can be seen on line 27 of "delete.php".


# Other necessary parts....
