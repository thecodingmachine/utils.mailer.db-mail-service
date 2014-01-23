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

TODO: install patch.

There is an install process for this package. It will require to provide a valid <strong>DB_MySqlConnection</strong>. The install
process will create 2 tables if they are not alreay there: <strong>outgoing_mails</strong> and <strong>outgoing_mail_addresses</strong>.

<h2>Usage sample</h2>

You use this service as you would use any MailService.


For instance, to send a mail, you just need to write:

<pre class="brush:php">
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
</pre>
The code above assumes that you configured an instance in Mouf called "dbMailService".

<h2>Accessing the sent mails database</h2>

You can access the sent mails database directly from the Mouf administration interface.
You just need to click on the <b>Utils</b> menu and click the <b>View outgoing mails</b> submenu.

<img src="outgoing_mails.png" alt="Mouf's DBMailService Outgoing Mails screenshot" />

As you can see in the screenshot, you can view the list of sent mails. A full-text search box will search
the whole outgoing mails.

<h2>Forwarding mails</h2>

The DBMailService is very useful because it stores the mails in database.
Obviously, you can use it for debugging purposes. However, most of the time, you will want
to store the mail in database AND send it. For this, the DBMailService can <strong>forward</strong> the
mail to another mail service. You just need to edit the Mouf's instance of the service and set the
forward service:

<img src="dbmailservice_instance_forward.png" alt="Mouf's DBMailService instance" />
