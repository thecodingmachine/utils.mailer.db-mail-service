<?php
/*
 * Copyright (c) 2013-2014 David Negrier
 * 
 * See the file LICENSE.txt for copying permission.
 */

namespace Mouf\Utils\Mailer;

use Mouf\Installer\PackageInstallerInterface;
use Mouf\MoufManager;
use Mouf\Database\Patcher\DatabasePatchInstaller;

/**
 * The installer of the DBMailService package.
 */
class DBMailServiceInstaller implements PackageInstallerInterface {

	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Installer\PackageInstallerInterface::install()
	 */
	public static function install(MoufManager $moufManager) {
		if (!$moufManager->instanceExists("dbMailService")) {
		
			$dbMailService = $moufManager->createInstance("Mouf\\Utils\\Mailer\\DBMailService");
			// Let's set a name for this instance (otherwise, it would be anonymous)
			$dbMailService->setName("dbMailService");
			$dbMailService->getProperty("datasource")->setValue($moufManager->getInstanceDescriptor('dbConnection'));
		}
		
		DatabasePatchInstaller::registerPatch($moufManager,
			"dbMailServiceCreateTables",
			"Creates the 2 tables required to store mails sent by the DBMailService",
			"vendor/mouf/utils.mailer.db-mail-service/database/install.sql");
			
		
		// Let's rewrite the MoufComponents.php file to save the component
		$moufManager->rewriteMouf();
	}
}
