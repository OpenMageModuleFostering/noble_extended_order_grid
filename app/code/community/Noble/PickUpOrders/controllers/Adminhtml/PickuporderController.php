<?php
/**
 * @category     Noble
 * @package      Noble_PickUpOrders
 * @author       Gilles Lesire
 *
 * Class Noble_PickUpOrders_Adminhtml_PickuporderController
 * Controller for the designated order grid
 */
class Noble_PickUpOrders_Adminhtml_PickuporderController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Sales'))->_title($this->__('Afhaalorders'));
        $this->loadLayout();
        $this->_setActiveMenu('sales/sales');
        $this->_addContent($this->getLayout()->createBlock('noble_pickuporders/adminhtml_sales_order'));
        $this->renderLayout();
    }
 
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('noble_pickuporders/adminhtml_sales_order_grid')->toHtml()
        );
    }
 
    public function exportNobleCsvAction()
    {
        $fileName = 'noble_pickuporders.csv';
        $grid = $this->getLayout()->createBlock('noble_pickuporders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }
 
    public function exportNobleExcelAction()
    {
        $fileName = 'noble_pickuporders.xml';
        $grid = $this->getLayout()->createBlock('noble_pickuporders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
}