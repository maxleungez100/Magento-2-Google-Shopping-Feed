<?php

namespace RunAsRoot\GoogleShoppingFeed\Controller\Adminhtml\Custom;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use RunAsRoot\GoogleShoppingFeed\Service\GenerateFeedService;

class FormSubmit extends Action
{
    private GenerateFeedService $generateFeedService;

    public function __construct(Context $context, GenerateFeedService $generateFeedService)
    {
        parent::__construct($context);
        $this->generateFeedService = $generateFeedService;
    }

    public function execute()
    {
        // 你的自定义逻辑
        $currentDateTime = date('Y-m-d H:i:s');
        $this->generateFeedService->execute();
        $this->messageManager->addSuccessMessage(__('Action executed successfully.' . $currentDateTime));
        return $this->_redirect('run_as_root/google/feeds'); // 重定向到自定义页面或列表页面
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vendor_Module::custom_action');
    }
}
