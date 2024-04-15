<?php
/**
 * @file classes/Constants.php
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Constants
 * @brief Constants
 */

namespace APP\plugins\generic\ror\classes;

class Constants
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
    public static string $iconPath = 'assets/images/ror-org-logo-icon.svg';

    /**
     * Path to the Ror stylesheet
     * @var string
     */
    public static string $stylePath = 'assets/css/style.css';

    /**
     * Path to the Ror javascript script
     * @var string
     */
    public static string $templateContributor = 'contributor.tpl';
}
