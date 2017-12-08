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


# Other necessary parts....
