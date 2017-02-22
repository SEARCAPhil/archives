

![SEARCA 50th Logo](https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRSdlTRWPD3W_5oirA-oPojE14dOnzEQ1tvD-MsMMrWhxfccDTO6Q)


###################
SEARCA DMS (Document Management System)
###################

A document management system (DMS) is a system (based on computer programs in the case of the management of digital documents) used to track, manage and store documents and reduce paper. Most are capable of keeping a record of the various versions created and modified by different users (history tracking).

Document management, often referred to as Document Management Systems (DMS), is the use of a computer system and software to store, manage and track electronic documents and electronic images of paper based information captured through the use of a document scanner. Document management is how your organization stores, manages and tracks its electronic documents. According to ISO 12651-2, a document is "recorded information or object which can be treated as a unit". While this sounds a little complicated, it is quite simply what you have been using to create, distribute and use for years. Now, we can define document management as the software that controls and organizes documents throughout an organization. It incorporates document and content capture, workflow, document repositories, COLD/ERM, and output systems, and information retrieval systems. Also, the processes used to track, store and control documents.


*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
PHP Configuration
************

After you download or clone it to your machine, look for the **base_url**
configuration in **application/config/config.php**

Uncomment this line

```php
$config['base_url'] = 'http://'. $_SERVER['HTTP_HOST'].'/document_management_system/';
```

and paste

```php
$config['base_url'] = 'http://'. $_SERVER['HTTP_HOST'].'/document_management_system/';
````


#####NOTE: Do not forget to change the ***/document_management_system/*** with the name of your folder#####



************
JS Configuration
************

In your **assets/javascripts/modifier.js** change the **base_url** to your folder name

```javascript
var base_url='/document_management_system/';
```

