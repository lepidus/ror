<?php
/**
 * @file classes/Form.php
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Form
 * @brief Form
 */

namespace APP\plugins\generic\ror\classes;

use PKP\components\forms\FieldText;
use PKP\components\forms\publication\ContributorForm;
use PKP\plugins\Hook;

class Form
{
    /**
     * Add extra form fields to Contributor form.
     *
     * @param string $hookName
     * @param object $form
     * @return bool
     */
    public function addFields(string $hookName, object $form): bool
    {
        if (!$form instanceof ContributorForm)
            return Hook::CONTINUE;

        $form->addField(new FieldText(Constants::$idName, [
            'label' => __('plugins.generic.ror.input.label'),
            'tooltip' => __('plugins.generic.ror.input.tooltip'),
        ]), [FIELD_POSITION_AFTER, 'affiliation']);

        $form->addField(new FieldTextLookup(Constants::$idName . '_Lookup', [
            'label' => __('plugins.generic.ror.input.lookup.label'),
            'tooltip' => __('plugins.generic.ror.input.lookup.tooltip'),
        ]), [FIELD_POSITION_BEFORE, 'affiliation']);

        return Hook::CONTINUE;
    }
}
