# Virtual Savings Pots

## About
This is a basic self-hosed web-based application to separate virtual savings pots. Instead of creating multiple savings account at your bank, open one saving account and separate into virtual pots with this application.

## You will need:
 - MySQL server
 - Web server running PHP


## Installation
 - Copy content to web server directory
 - Import database new.sql (SQL template file)
 - Change php/cnx.php with your MySQL database name and its username and password

## Quick Start

 - Use button 'Create account' to create a virtual pot, e.g. emergency fund, holiday, bills, etc.
 - Click the account at the bottom of the transaction list add a description and amount to post the transaction
 - If the transaction increases the account value, check 'Increase' otherwise leave unchecked to decrease the transaction.
