<?php
use Mouf\MoufManager;
use Mouf\MoufUtils;

MoufUtils::registerMainMenu('utilsMainMenu', 'Utils', null, 'mainMenu', 200);
MoufUtils::registerMenuItem('utilsDbMailServiceInterfaceMenu', 'DB Mail Service', null, 'utilsMainMenu', 30);
MoufUtils::registerMenuItem('utilsDbMailServiceInterfaceViewOutgoingMailsMenuItem', 'View outgoing mails', 'javascript:chooseInstancePopup("DBMailService", "'.ROOT_URL.'mouf/dbmailservice/?instanceName=", "'.ROOT_URL.'")', 'utilsDbMailServiceInterfaceMenu', 10);


// Controller declaration
MoufManager::getMoufManager()->declareComponent('dbmailserviceinstall', 'Mouf\\Utils\\Mailer\\Controllers\\DBMailServiceInstallController', true);
MoufManager::getMoufManager()->bindComponents('dbmailserviceinstall', 'template', 'moufInstallTemplate');
MoufManager::getMoufManager()->bindComponents('dbmailserviceinstall', 'content', 'block.content');

MoufManager::getMoufManager()->declareComponent('dbmailservice', 'Mouf\\Utils\\Mailer\\Controllers\\DBMailServiceListController', true);
MoufManager::getMoufManager()->bindComponents('dbmailservice', 'template', 'moufTemplate');
MoufManager::getMoufManager()->bindComponents('dbmailservice', 'content', 'block.content');
