<?php
	class EntranceController extends Controller {
		
		function __construct()
		{
			parent::__construct();
			Settings::$Template = 'ajax';
			if(!$this->checklogin()) return;
		}
		
		private function checklogin()
		{
			$user = Auth::user(true);
			if(empty($user))
			{
				$this->redirect('/index/kicked');
				ErrorHelper::error('Du är utloggad!');
				return false;
			} else {
				if(!@$user['admin'] && !@$user['entrance']){
					$this->redirect('/index/kicked');
					ErrorHelper::error('Du har inte rättighet att vara här!');
					return false;
				} else {
					return true;
				}
			}
		}
		
		function index()
		{
			
		}
		
		function check()
		{
			$member = Model::getModel('member');
			if(!ctype_digit($_REQUEST['SSN'])){ // Om det inte bara är nummer, så är det ett personnummmer
				$member_want = $member->getMemberBySSN($_REQUEST['SSN']);
				if(!empty($member_want[0]))
				{
					$user = Model::getModel('user');
					$user_want =  $user->getByMemberID($member_want[0]['PersonID']);
					if(!empty($user_want[0]))
					{
						$order = Model::getModel('order');
						$order_want = $order->getOrderFromUserAndStatus($user_want[0]['id'], 'COMPLETED');
						if(!empty($order_want)){
							$orders_values = Model::getModel('ordersvalues');
							$orders_values_want = $orders_values->getOrderValuesFromOrder($order_want[0]['id']);
							$this->set('user_want', $user_want[0]);
							$this->set('member_want', $member_want[0]);
							$this->set('order_want', $order_want);
							$this->set('orders_values_want', $orders_values_want);
						}
					}
				}
			} else { // Its an order number
				$order = Model::getModel('order');
				$user = Model::getModel('user');
				$member = Model::getModel('member');
				$orders_values = Model::getModel('ordersvalues');
				
				
				// Get the order
				$order_want = $order->getOrderById($_REQUEST['SSN']);
				// Get the user
				$user_want = $user->get($order_want['user_id']);
				// Get the member
				$member_want = $member->getMemberByID($user_want[0]['member_id']);
				// Get the order values
				$orders_values_want = $orders_values->getOrderValuesFromOrder($order_want['id']);
				
				$this->set('user_want', $user_want[0]);
				$this->set('member_want', $member_want);
				$this->set('order_want', array($order_want));
				$this->set('orders_values_want', $orders_values_want);
			}
		}
		
		function checkin()
		{
			$order = Model::getModel('order');
			$order->setStatusById(@$_REQUEST['order_id'], 'COMPLETED');
			$orders_values = Model::getModel('ordersvalues');
			if(!empty($_REQUEST['value'])){
				foreach($_REQUEST['value'] as $key => $value){
					$orders_values->markGiven($key);
				}
			}
			$this->redirect('index');
		}
	}
?>