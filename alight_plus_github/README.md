Alight Docusign


An Interactive Web Applications that Connects  Refugees with  Nonprofit Alight Refugees Supports Organisations
Powered by Docusign Signature API, Google Map, Google Chart Statictics, Email Services and Twilio SMS.


How to Install the Application

1.) This application was written in PHP and thus ensure that something like xampp server is install. Ensure that PHP and Mysql is running.

2) The Alight Refugee Teams/Admin will need to Edit Settings.php file to update all Requirements like Docusign Credentials, Google Map API Key, Twilio SMS API, Email Server Configurations etc.

3) Edit both data6rst.php and db_connect_map.php  file to update database Credentials respectively.

4.) Export docusign_db.SQL which contains database Table.

 5.) make sure to configure Token Generation Redirect URL to point to Eg. http://localhost/alight_plus/docusign_token_generate.php for your App Settings at your Docusign Developers Account.

6.) Call up the application at browser and it will be running at http://localhost/alight_plus/index.php