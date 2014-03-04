<?php
namespace Mouf\Utils\Mailer\Controllers;

use Mouf\Mvc\Splash\Controllers\Controller;
use Mouf\Utils\Common\MoufHelpers\MoufProxy;
use Mouf\InstanceProxy;
/**
 * The controller used by the db mail service to display mail lists and mails.
 *
 */
class DBMailServiceListController extends Controller {

	const PAGE_SIZE = 100;
	
	/**
	 * The default template to use for this controller (will be the mouf template)
	 *
	 * @Property
	 * @Compulsory 
	 * @var TemplateInterface
	 */
	public $template;
	
	/**
	 * @Property
	 * @Compulsory
	 * @var HtmlBlock
	 */
	public $content;
	
	/**
	 * The list of mails retrieved.
	 * 
	 * @var array
	 */
	protected $mailList;
	
	public $instanceName;
	public $selfedit;
	public $fullTextSearch;
	public $offset;
	
	/**
	 * Admin page used to list the latest sent mails.
	 *
	 * @Action
	 * //@Logged
	 */
	public function index($instanceName, $fullTextSearch = null, $offset = 0, $selfedit="false") {
		$this->instanceName = $instanceName;
		$this->selfedit = $selfedit;
		$this->fullTextSearch = $fullTextSearch;
		$this->offset = $offset;
		
		$dbMailServiceProxy = new InstanceProxy($instanceName, $selfedit=="true");
		/* @var $dbMailServiceProxy DBMailService */
		$this->mailList = $dbMailServiceProxy->getMailsList("sent_date", "DESC", $offset, self::PAGE_SIZE, $fullTextSearch);
		
		$this->content->addFile(dirname(__FILE__)."/../../../../views/list.php", $this);
		$this->template->toHtml();
	}
	
	/**
	 * @var DBMail
	 */
	protected $mail;
	
	/**
	 * Admin page used to view one sent mail.
	 *
	 * @Action
	 * @Logged
	 */
	public function view($id, $instanceName, $fullTextSearch = null, $offset = 0, $selfedit="false") {
		$this->instanceName = $instanceName;
		$this->selfedit = $selfedit;
		$this->fullTextSearch = $fullTextSearch;
		$this->offset = $offset;
		
		$dbMailServiceProxy = new InstanceProxy($instanceName, $selfedit=="true");
		/* @var $dbMailServiceProxy DBMailService */
		$this->mail = $dbMailServiceProxy->getMail($id);
		
		$this->content->addFile(dirname(__FILE__)."/../../../../views/view.php", $this);
		$this->template->toHtml();
	}
	
	/**
	 * Admin page used to view the HTML body text (usually in an Iframe).
	 *
	 * @Action
	 * @Logged
	 */
	public function getHtmlBody($id, $instanceName, $selfedit="false") {
		$this->instanceName = $instanceName;
		$this->selfedit = $selfedit;
	
		$dbMailServiceProxy = new InstanceProxy($instanceName, $selfedit=="true");
		/* @var $dbMailServiceProxy DBMailService */
		$this->mail = $dbMailServiceProxy->getMail($id);
	
		include(dirname(__FILE__)."/../../../../views/viewHtmlBody.php");
	}
}
