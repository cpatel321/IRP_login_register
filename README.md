# IRP_login_register
Task given for IBP project


Walkthrough for Cloning:\
Open Terminal: 
```
cd  <www folder of you php localhost generally it is C:\xampp\www >
git clone https://github.com/cpatel321/IRP_login_register.git
```
---
Open [localhost/IRP_login_register](127.0.0.1/IRP_login_register) also don't forget to start apache and mysql server in xampp(or any other ) control panel.

---

Description of Files:  
Landing page: [index.php](index.php) contains php script to check if php session is set or not.\
if no php session found then redirected to Login.html
if php session found then user profile is shown with logout button.

[login.html](login.html): Contains form to enter credentials to login and sends form data to [authenticate.php](./authenticate.php) via POST method, which is validated and if valid credentials are entered then php session is created and user is redirected to [index.php](index.php) else error message is shown.\
-login can be done using username or email.
-form is SQL injection proof.
-page usage url to show invalid credentials error message. for this regex is used to check if url contains error message or not. if it contains then error message is shown else not.




[authenticate.php](authenticate.php): contains php script to validate form data and create php session if valid credentials are entered and redirects to [index.php](index.php) else error message is alerted.
-form is SQL injection proof.

[register.html](register.html): contains form to enter credentials to register and sends form data to [register.php](./register.php) via POST method, which is stored in mySQL database and  php session is created and user is redirected to [index.php](index.php) 
-validates if password and repeat password are same or not. using JS


[register.php](register.php): contains php script to store form data in mySQL database and create php session and redirects to [index.php](index.php)
-form is SQL injection proof.
-asks general data to show on profile 
-validates if password is strong or not


[logout.php](logout.php): contains php script to destroy php session and redirects to [login.html](login.html)

[style.css](style.css): contains css styling for all html files. Dark theme is used.  Design is pretty basic so it bacame responsive automatically.




