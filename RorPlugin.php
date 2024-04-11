<?php
/**
 * @file RORPlugin.php
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Dulip Withanage
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class RorPlugin
 * @brief Ror Plugin  class
 */

namespace APP\plugins\generic\ror;

use APP\core\Application;
use APP\plugins\generic\ror\classes\Ror\RorArticleView;
use APP\plugins\generic\ror\classes\Ror\RorForm;
use APP\plugins\generic\ror\classes\Ror\RorSchema;
use APP\plugins\generic\ror\classes\Ror\RorWorkflow;
use APP\template\TemplateManager;
use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;
use PKP\template\PKPTemplateManager;

class RorPlugin extends GenericPlugin
{
    /** @copydoc Plugin::register */
    public function register($category, $path, $mainContextId = null): bool
    {
        if (parent::register($category, $path, $mainContextId)) {

            if ($this->getEnabled()) {
                /* ROR */
                $rorSchema = new RorSchema();
                $rorForm = new RorForm();
                $rorWorkflow = new RorWorkflow($this);
                $rorArticleView = new RorArticleView($this);
                Hook::add('Schema::get::author', [$rorSchema, 'addToAuthor']);
                Hook::add('Form::config::before', [$rorForm, 'addFields']);
                Hook::add('TemplateManager::display', [$rorWorkflow, 'execute']);
                Hook::add('ArticleHandler::view', [$rorArticleView, 'execute']);
            }

            return true;
        }

        return false;
    }

    public function loadUrnFieldComponent(string $hookName, array $args): void
    {
        $templateMgr = $args[0];
        $template = $args[1];

        if ($template !== 'workflow/workflow.tpl') {
            return;
        }
            $templateMgr->addJavaScript(
                'field-text-lookup',
                Application::get()->getRequest()->getBaseUrl() . '/' . $this->getPluginPath() . '/assets/js/scriptRor.js',
                [
                    'contexts' => 'backend',
                    'priority' => TemplateManager::STYLE_SEQUENCE_LAST,
                ]
            );

            $templateMgr->addStyleSheet(
                'field-text-lookup',
                '
                    .pkpFormField--urn__input {
                        display: inline-block;
                    }

                    .pkpFormField--urn__button {
                        margin-left: 0.25rem;
                        height: 2.5rem; // Match input height
                    }
                ',
                [
                    'contexts' => 'backend',
                    'inline' => true,
                    'priority' => TemplateManager::STYLE_SEQUENCE_LAST,
                ]
            );
    }



    function addJavascript($request, $templateMgr)
    {
        $templateMgr->addJavaScript(
            'FieldTextLookup1234',
            Application::get()->getRequest()->getBaseUrl() . '/' . $this->getPluginPath() . '/assets/js/script.js',
            [
                'contexts' => ['backend'],
                'priority' => PKPTemplateManager::STYLE_SEQUENCE_LAST,
            ]
        );

        $templateMgr->addStyleSheet(
            'field-text-urn-component',
            '
                    .pkpFormField--urn__input {
                        display: inline-block;
                    }
                ',
            [
                'contexts' => 'backend',
                'inline' => true,
                'priority' => PKPTemplateManager::STYLE_SEQUENCE_LAST,
            ]
        );
    }

    /** @copydoc Plugin::getDisplayName() */
    function getDisplayName(): string
    {
        return __('plugins.generic.ror.displayName');
    }

    /** @copydoc Plugin::getDescription() */
    function getDescription(): string
    {
        return __('plugins.generic.ror.description');
    }
}

// For backwards compatibility -- expect this to be removed approx. OJS/OMP/OPS 3.6
if (!PKP_STRICT_MODE) {
    class_alias('\APP\plugins\generic\ror\RorPlugin', '\RorPlugin');
}
