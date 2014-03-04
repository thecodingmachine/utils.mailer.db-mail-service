Mouf's DBMailService
====================

WARNING: NOT READY FOR PRODUCTION, MIGRATION IN PROGRESS
========================================================

Storing outgoing mails
----------------------

In Mouf, *emails* are sent using *MailServices*.<br/>
This package contains a mailer that does not send any mail! Instead, it stores the mail to
be sent in a `mails` table. The DB mailer can also forward the mail to a real mailer that will indeed send the mail (usually a [`SmtpMailService`](http://mouf-php.com/packages/mouf/utils.mailer.smtp-mail-service/README.md))

Mails are stored in the `outgoing_mails` table while "from", "to", "cc" and "bcc" fields are stored in the 
`outgoing_mail_addresses` table.
The stored mails can later be viewed using Mouf's user interface and can also be accessed through methods of this class.

If you pass an instance of `DBMailInterface` (instead of simply a MailInterface), you can add a category and a type
to your mail. That could be used to sort sent mails later. The `DBMail` class is the default implementation of the `DBMailInterface` interface.

Installing DBMailService
------------------------

There is an install process for this package. It will create a database patch. Once you have run the install process,
you will need to install the patch.

The patch will create 2 tables if they are not alreay there: <strong>outgoing_mails</strong> and <strong>outgoing_mail_addresses</strong>.

The install process will also create a *dbMailService* instance that will be connected to the current
*dbConnection* (if it exists) and will use the *mailService* instance to actually send the mail.

Usage sample
------------

You use this service as you would use any MailService.


For instance, to send a mail, you just need to write:

```php
$mailService = Mouf::getDBMailService();

$mail = new DBMail();
$mail->setBodyText("This is my mail!");
$mail->setBodyHtml("This is my &lt;b&gt;mail&lt;/b&gt;!");
$mail->setFrom(new MailAddress("my@server.com", "Server"));
$mail->addToRecipient(new MailAddress("david@email.com", "David"));
$mail->setTitle("My mail");
$mail->setCategory("My category");
$mail->setType("My type");

$mailService->send($mail);
```

Accessing the sent mails database
---------------------------------

You can access the sent mails database directly from the Mouf administration interface.
You just need to click on the **Utils** menu and click the **View outgoing mails** submenu.

![doc/images/screenshot_outgoing_mails.png](Mouf's DBMailService Outgoing Mails screenshot)

As you can see in the screenshot, you can view the list of sent mails. A full-text search box will search
the whole outgoing mails.

Forwarding mails
----------------

The **DBMailService** is very useful because it stores the mails in database.
Obviously, you can use it for debugging purposes. However, most of the time, you will want
to store the mail in database AND send it. For this, the DBMailService can **forward** the
mail to another mail service. You just need to edit the Mouf's instance of the service and set the
forward service:

![doc/images/screenshot_forward.png](Mouf's DBMailService instance)
