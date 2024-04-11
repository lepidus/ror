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
use Exception;

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
     * Show tab under Publications
     *
     * @param string $hookName
     * @param array $args [string, TemplateManager]
     * @return void
     * @throws Exception
     */
    public function execute(string $hookName, array $args): void
    {
        /* @var TemplateManager $templateMgr */
        $templateMgr = $args[0];
        $template = $args[1];

        if ($template !== 'workflow/workflow.tpl') return;

        $templateMgr->addJavaScript(
            'field-text-lookup',
            Application::get()->getRequest()->getBaseUrl() . '/' . $this->plugin->getPluginPath() . '/' . RorConstants::$scriptPath,
            [
                'contexts' => 'backend',
                'priority' => TemplateManager::STYLE_SEQUENCE_LAST,
            ]
        );

        $templateMgr->addStyleSheet(
            'field-text-lookup',
            Application::get()->getRequest()->getBaseUrl() . '/' . $this->plugin->getPluginPath() . '/' . RorConstants::$stylePath,
            [
                'contexts' => 'backend',
                'priority' => TemplateManager::STYLE_SEQUENCE_LAST,
            ]
        );
    }
}
