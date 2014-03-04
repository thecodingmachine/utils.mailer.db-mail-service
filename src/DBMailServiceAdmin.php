<?php
use Mouf\MoufManager;
use Mouf\MoufUtils;

MoufUtils::registerMainMenu('utilsMainMenu', 'Utils', null, 'mainMenu', 200);
MoufUtils::registerMenuItem('utilsDbMailServiceInterfaceMenu', 'DB Mail Service', null, 'utilsMainMenu', 30);
MoufUtils::registerMenuItem('utilsDbMailServiceInterfaceViewOutgoingMailsMenuItem', 'View outgoing mails', 'javascript:chooseInstancePopup("Mouf\\\\Utils\\\\Mailer\\\\DBMailService", "'.ROOT_URL.'dbmailservice/?instanceName=", "'.ROOT_URL.'")', 'utilsDbMailServiceInterfaceMenu', 10);


// Controller declaration
$moufManager = MoufManager::getMoufManager();
$moufManager->declareComponent('dbmailservice', 'Mouf\\Utils\\Mailer\\Controllers\\DBMailServiceListController', true);
$moufManager->bindComponents('dbmailservice', 'template', 'moufTemplate');
$moufManager->bindComponents('dbmailservice', 'content', 'block.content');
