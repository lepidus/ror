<?php
/**
 * @file classes/FieldTextLookup.php
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class FieldTextLookup
 * @brief The basic text field in a form extended with lookup / search functionality
 */

namespace APP\plugins\generic\ror\classes;

use PKP\components\forms\FieldText;

class FieldTextLookup extends FieldText
{
    /** @copydoc Field::$component */
    public $component = 'ror-field-text-lookup';
}
