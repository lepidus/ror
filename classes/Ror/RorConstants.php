<?php
/**
 * @file classes/Ror/RorConstants.php
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class RorConstants
 * @brief Ror Constants
 */

namespace APP\plugins\generic\ror\classes\Ror;

class RorConstants
{
    /**
     * Name of ROR id used in database, forms
     *
     * @var string
     */
    public static string $idName = 'rorId';

    /**
     * Key used in article_details.tpl template file.
     *
     * @var string
     */
    public static string $iconNameInTemplate = 'rorIdIcon';

    /**
     * Path to the Ror logo.
     *
     * @var string
     */
    public static string $iconPath = 'assets/images/ror-logo-icon.svg';

    /**
     * Path to the Ror stylesheet
     * @var string
     */
    public static string $stylePath = 'assets/css/ror.css';

    /**
     * Path to the Ror javascript script
     * @var string
     */
    public static string $scriptPath = 'assets/js/ror.js';
}
