<?php

/**
 * @category     Noble
 * @package      Noble_UPSOrders
 * @author       Gilles Lesire
 *
 * Class Noble_UPSOrders_Block_Adminhtml_Sales_Order
 * This class overrides the default orders grid in the Admin panel
 */
class Noble_UPSOrders_Block_Adminhtml_Sales_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'noble_upsorders';
        $this->_controller = 'adminhtml_sales_order';
        $this->_headerText = Mage::helper('noble_upsorders')->__('UPS Orders');
 
        parent::__construct();
        $this->_removeButton('add');
    }
}