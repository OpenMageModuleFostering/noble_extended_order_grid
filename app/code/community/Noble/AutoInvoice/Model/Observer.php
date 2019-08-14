<?php
 /**
 * @category     Noble
 * @package      Noble_AutoInvoice
 * @author       Gilles Lesire
 *
 * Class Noble_AutoInvoice_Model_Observer
 * Observer class which will execute the implementOrderStatus function when a new order is created
 * In case of an order being payed with a gift certificate or being free, it will be automitically invoiced and set to processing
 */
	class Noble_AutoInvoice_Model_Observer {
		public function implementOrderStatus($event)
		{
			$order = $event->getOrder();
	 
			if ($this->_getPaymentMethod($order) == 'free' || $this->_getPaymentMethod($order) == 'ugiftcert') {
				if ($order->canInvoice())
					$this->_processOrderStatus($order);
			}
			return $this;
		}
	 
		private function _getPaymentMethod($order)
		{
			return $order->getPayment()->getMethodInstance()->getCode();
		}
	 
		private function _processOrderStatus($order)
		{
			$invoice = $order->prepareInvoice();
	 
			$invoice->register();
			Mage::getModel('core/resource_transaction')
			   ->addObject($invoice)
			   ->addObject($invoice->getOrder())
			   ->save();
	 
			$invoice->sendEmail(true, '');
			$this->_changeOrderStatus($order);
			return true;
		}
	 
		private function _changeOrderStatus($order)
		{
			$statusMessage = '';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);        
			$order->save();
		}
	}
	
	
	
	/**
	 * change order status to 'Completed'
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_COMPLETE, true)->save();
	Similarly, you can change the order status to pending, processing, canceled, closed, held, etc.
	 
	/**
	 * change order status to "Pending"
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_NEW, true)->save();
	 
	/**
	 * change order status to "Pending Paypal"
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_PENDING_PAYMENT, true)->save();
	 
	/**
	 * change order status to "Processing"
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
	 
	/**
	 * change order status to "Completed"
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_COMPLETE, true)->save();
	 
	/**
	 * change order status to "Closed"
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_CLOSED, true)->save();
	 
	/**
	 * change order status to "Canceled"
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_CANCELED, true)->save();
	 
	/**
	 * change order status to "Held"
	 *
	$order->setState(Mage_Sales_Model_Order::STATE_HOLDED, true)->save();
	*/
?>