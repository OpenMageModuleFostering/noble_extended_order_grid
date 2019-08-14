<?php
/**
 * @category     Noble
 * @package      Noble_UPSOrders
 * @author       Gilles Lesire
 *
 * Class Noble_UPSOrders_Adminhtml_UPS_OrderController
 * Controller for the designated order grid
 */
class Noble_UPSOrders_Adminhtml_UpsorderController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Sales'))->_title($this->__('UPS Orders'));
        $this->loadLayout();
        $this->_setActiveMenu('sales/sales');
        $this->_addContent($this->getLayout()->createBlock('noble_upsorders/adminhtml_sales_order'));
        $this->renderLayout();
    }
 
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('noble_upsorders/adminhtml_sales_order_grid')->toHtml()
        );
    }
 
    public function exportNobleCsvAction()
    {
        $fileName = 'noble_upsorders.csv';
        $grid = $this->getLayout()->createBlock('noble_upsorders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }
 
    public function exportNobleExcelAction()
    {
        $fileName = 'noble_upsorders.xml';
        $grid = $this->getLayout()->createBlock('noble_upsorders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
}