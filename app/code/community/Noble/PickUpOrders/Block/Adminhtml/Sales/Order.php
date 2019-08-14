<?php

/**
 * @category     Noble
 * @package      Noble_PickUpOrders
 * @author       Gilles Lesire
 *
 * Class Noble_PickUpOrders_Block_Adminhtml_Sales_Order
 * This class overrides the default orders grid in the Admin panel
 */
class Noble_PickUpOrders_Block_Adminhtml_Sales_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'noble_pickuporders';
        $this->_controller = 'adminhtml_sales_order';
        $this->_headerText = Mage::helper('noble_pickuporders')->__('Afhaalorders');
 
        parent::__construct();
        $this->_removeButton('add');
    }
}