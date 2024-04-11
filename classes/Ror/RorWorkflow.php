<?php
/**
 * @file classes/Workflow/WorkflowTab.php
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class WorkflowTab
 * @brief Workflow Publication Tab
 */

namespace APP\plugins\generic\ror\classes\Ror;

use APP\core\Application;
use APP\plugins\generic\ror\RorPlugin;
use APP\template\TemplateManager;

class RorWorkflow
{
    /** @var RorPlugin */
    public RorPlugin $plugin;

    /** @param RorPlugin $plugin */
    public function __construct(RorPlugin &$plugin)
    {
        $this->plugin = &$plugin;
    }

    /**
     * Lookup functionality on Contributor > Edit
     *
     * @param string $hookName
     * @param array $args [string, TemplateManager]
     * @return void
     */
    public function execute(string $hookName, array &$args): void
    {
        /* @var TemplateManager $templateMgr */
        $templateMgr = &$args[1];
        $request = Application::get()->getRequest();

        $templateParameters = [
            'assetsUrl' => $request->getBaseUrl() . '/' . $this->plugin->getPluginPath() . '/assets'
        ];
        $templateMgr->assign($templateParameters);

        $templateMgr->display($this->plugin->getTemplateResource("ror.tpl"));
    }
}
