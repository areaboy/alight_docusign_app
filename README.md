# Alight Docusign


An Interactive Web Applications that Connects  Refugees with  Nonprofit Alight Refugees Supports Organisations
Powered by Docusign Signature API, Google Map, Google Chart Statictics, Email Services and Twilio SMS.


# How to Install the Application

1.)Once you download this application. First you will need to Unzip **mail_vendor.zip folder** and **twilio_sms.zip** folder inside the application main folder.

We zipped those 2 folders becuase Github only allow uploades of maximum of 100 files through web interface. Because those two folders contains numerous files so we have to zip it before uploading it to Github

2.) This application was written in PHP and thus ensure that something like xampp server is install. Ensure that **PHP and Mysql** is running.

3) The Alight Refugee Teams/Admin will need to Edit **Settings.php** file to update all Requirements like **Docusign Credentials, Google Map API Key, Twilio SMS API, Email Server Configurations** etc.

4) Edit both **data6rst.php and db_connect_map.php**  file to update database Credentials respectively.

5.) Export **docusign_db.SQL** which contains database Table.

 6.) make sure to **configure Token Generation Redirect URL** to point to Eg. **http://localhost/alight_plus/docusign_token_generate.php** for your App Settings at your **Docusign Developers Account**.

7.) Call up the application at browser and it will be running at **http://localhost/alight_plus/index.php**
