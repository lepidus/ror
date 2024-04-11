<?php
/**
 * @file classes/Ror/FieldTextLookup.php
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class FieldTextLookup
 * @brief A basic text field in a form.
 */

namespace APP\plugins\generic\ror\classes\Ror;

use PKP\components\forms\FieldText;

class FieldTextLookup extends FieldText
{
    /** @copydoc Field::$component */
    public $component = 'field-text-lookup';
}
