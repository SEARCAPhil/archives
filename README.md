

![SEARCA 50th Logo](https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRSdlTRWPD3W_5oirA-oPojE14dOnzEQ1tvD-MsMMrWhxfccDTO6Q)


### SEARCA DMS (Document Management System)
************

[![Build Status](https://travis-ci.org/SEARCAPhil/document_management_system.svg?branch=master)](https://travis-ci.org/SEARCAPhil/document_management_system)


A [Document Management System (DMS)](https://en.wikipedia.org/wiki/Document_management_system) is a system (based on computer programs in the case of the management of digital documents) used to track, manage and store documents and reduce paper. Most are capable of keeping a record of the various versions created and modified by different users (history tracking).

Document management, often referred to as Document Management Systems (DMS), is the use of a computer system and software to store, manage and track electronic documents and electronic images of paper based information captured through the use of a document scanner. Document management is how your organization stores, manages and tracks its electronic documents. According to ISO 12651-2, a document is "recorded information or object which can be treated as a unit". While this sounds a little complicated, it is quite simply what you have been using to create, distribute and use for years. Now, we can define document management as the software that controls and organizes documents throughout an organization. It incorporates document and content capture, workflow, document repositories, COLD/ERM, and output systems, and information retrieval systems. Also, the processes used to track, store and control documents.



*******************
##### Server Requirements #####

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.  You will also need to install the following :  

- NodeJS
- Yarn

************
##### Dependency #####
Save all the dependency using composer. For all commands available please visit their [website](https://getcomposer.org/)
```php
$ composer install
```

Insta `JavaScript` dependency using yarn
```javascript
$ yarn install
```



************
##### PHP Configuration #####
After you download or clone it to your machine, look for the **base_url**
configuration in **application/config/config.php** and set it to


```php
$config['base_url'] = 'http://'. $_SERVER['HTTP_HOST'].'/archives/';
````


>  Do not forget to change the `/archives` with the name of your folder 


************
##### Database Configuration #####


Upload the `dms.sql` files inside the `database_files` folder to your `MySQL/MariaDB` server then configure 
the database connection in `application/config/database.php`.

Look for the lines below and change it with your server's configuration
```php
$db['pdo_local'] = array(
	'dsn'	=> 'mysql:host=localhost;dbname=dms; charset=utf8;',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => '',
	'dbdriver' => 'pdo',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```
> **BREAKING CHANGES (v1.2.x)**
`login_db_instance.sql` is no longer needed for user authentication.


************
##### JS Configuration #####
In your `assets/javascripts/modifier.js` change the `base_url` with your folder name

```javascript
var base_url='/archives/';
```

##### OAuth #####
> **BREAKING CHANGES (v1.2.x)**
User authentication relies solely on `office365` using [adal.js](https://github.com/AzureAD/azure-activedirectory-library-for-js) library. Please read their [documentation](https://github.com/AzureAD/azure-activedirectory-library-for-js/wiki) on using this library

```javascript
// default site settings
const site_url='/archives/'
const site_host='http://localhost'

// adal configuration
window.config  = {
    instance: 'https://login.microsoftonline.com/', 
    tenant: 'xxxx', //COMMON OR YOUR TENANT ID
    clientId: 'xxxxxxxx-xxxxxxxx-xxxx-xxxx-xxxxxxxxxxxx', //This is your client ID
}
```

