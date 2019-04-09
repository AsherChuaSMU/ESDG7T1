# ESDG7T1
ALANEXPRESS

TIBCO
1) Download AlanExpress.zip and pace it in a d iectory that you can easily locate
2) Launch the Tibco Designer
3) Once Tibco starts, head over to File > Import > Existing Studio Projects into Workspace > Select archive file > Browse and look for the AlanExpress.zip and press Finish.
4) Tibco will import the microservices from the zip file selected.
5) In order to use the microservices, head to Run > Run Configurations...
6) The microservices would have started running by now


For sending email on gmail to work
1) download openssl that is in the given file and extract all and save it in c drive
2) use openssl to download certificate (openssl.exe is in the bin folder)
Steps to take: 
 - open command prompt
 - direct to openssl.exe (C:\openssl-1.0.2j-fips-x86_64\OpenSSL\bin)
 - type openssl and enter then copy paste the following:
s_client -connect smtp.gmail.com:587 -starttls smtp
3) copy certificate from begin certificate to end certificate and save it as google587.cer in this directory -> tibco\tibcojre64\1.8.0\bin
4) In this directory -> C:\tibco\tibcojre64\1.8.0\bin
there will be a keytool.exe to import the certificate as a keystore provider
Steps to take:
 - Open another command prompt and direct to this directory -> C:\tibco\tibcojre64\1.8.0\bin
 - dir to double check keytool.exe is in this directory.
 - copy paste the following:
keytool.exe -importcert -alias gmail -file google587.cer -keystore MyKeyStore
 - when being prompt to create password, use this password: esdg7t1esd
 - re-type the same password to confirm and type y when being prompt whether you trust this certificate
 - when cmd says certificate was added to keystore
 - copypaste this MyKeyStore from tibcojre64\1.8.0\bin to your workspace
5) After MyKeyStore is added into your workspace, open tibco, NotificationService module under process.bwp, click on the send mail palette/activity.
Go to properties -> general -> edit default Resource 
Under Security, click SSL Client
Under Basic SSL Client Configuration, click Keystore Provider as Trust Store.
Under Keystore URL, change 'alanexpress' to your workspace name and change password to -> esdg7t1esd
Lastly, save changes and you will be able to see the sent mail to the admin email when restaurant owners adds a new food item and price.

To check that email is sent after restaurant owners adds a new food item and price, you can go to the following gmail account: esd.g7t1@gmail.com and password: esdg7t1esd



Facebook Login API
1. Please use this account to use the Facebook login API:
gmail account: esd.g7t1@gmail.com 
password: esdg7t1esd
2. For the API to work in the application. In line 87 of 'facebookscript' in 'js' folder, please change the domain of the post url with the domain of your request URL.
3. In line 107, please change the domain of the URL to your localhost domain 


Session['url']
1. For the application to work, please change the $_SESSION['url'] in the 'include' folder with the domain of your Request URL. 


Stripe API

User Visa Details:
Card Number:4242 4242 4242 4242
Expiry Date: 12/34
Password: <Auto filled>

Stripe Admin Account details: 
Username: ylfoo.2017@sis.smu.edu.sg 
Password: dazab33! 
Publishable key:pk_test_UsHiN8jvCBu0IcS7Xwfe29N200ZPgVcKbT 
Secret key:sk_test_5H6z88lc6DRjpkEElh2uUtal00VGG60gzp 
