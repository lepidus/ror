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

use APP\plugins\generic\ror\classes\Ror\RorArticleView;
use APP\plugins\generic\ror\classes\Ror\RorForm;
use APP\plugins\generic\ror\classes\Ror\RorSchema;
use APP\plugins\generic\ror\classes\Ror\RorWorkflow;
use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;

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
                Hook::add('Template::Workflow::Publication', [$rorWorkflow, 'execute']);
                Hook::add('ArticleHandler::view', [$rorArticleView, 'execute']);
            }

            return true;
        }

        return false;
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
