# Guestbook App

## Step 1 Prerequisites   
		-  PHP, Mysql installed on Linux server or xampp fow windows   
		-  php 8 and above   
		-  download and install git    
## Step 2   
		- Clone the Project - git clone https://github.com/sg00354558/guestbook.git
		- Go inside guestbook foldr and open .env and add database connection and name.   
		  DATABASE_URL="mysql://root:@localhost:3306/guestbook"
		- Change directory to new guestbook directory and run composer install(composer will install all the dependencies)   
		- run the command to create database php bin/console doctrine:database:create  
		- php bin/console doctrine:schema:update --force
## Step 3     
	 Create admin users and add few guestbook entries   
	   - php bin/console doctrine:fixtures:load --append
## step 4
	Run the program -- Access application on - http://127.0.0.1:8000/
	   - symfony server:start -d 
	Run PHPUnit
	 -  php bin/phpunit
   
   
   
## Application
Home Page/ Index Page - Ref UI - https://www.wysiwygwebbuilder.com/support/bootstrapguestbook/guestbook.php
![image](https://user-images.githubusercontent.com/110300713/182086961-04f73f69-667e-4509-828e-16ec37064e04.png)

Register Screen
![image](https://user-images.githubusercontent.com/110300713/182087117-dbfcdd82-fc76-4901-b569-40355d3ceb79.png)

Login Screen
![image](https://user-images.githubusercontent.com/110300713/182087160-c77f3f5d-a89a-431c-aefb-459f0ab4fed1.png)

Post admin login Admin page - Username: admin Password: admin123
![image](https://user-images.githubusercontent.com/110300713/182087374-45d359ef-1566-4aa0-be7d-2aa1f8e142c4.png)

Guestbook page post login
![image](https://user-images.githubusercontent.com/110300713/182087521-110df481-a8c3-4138-ac21-5d2d33b47d2a.png)

Approve guestbook entry
![image](https://user-images.githubusercontent.com/110300713/182088361-da8f7be7-29c5-4122-8631-8c90e2077fb8.png)

Delete guestbook entry
![image](https://user-images.githubusercontent.com/110300713/182088409-a07fa10d-cf3e-4f09-93c4-23281cb396da.png)





 
