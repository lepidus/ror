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
    /** @var string Name of ROR id used in database, forms */
    public const idName = 'rorId';

    /** @var string Key used in article_details.tpl template file. */
    public const iconNameInTemplate = 'rorIdIcon';

    /** @var string Path to the Ror logo. */
    public const iconPath = 'assets/images/ror-org-logo-icon.svg';

    /** @var string Path to the Ror stylesheet. */
    public const stylePath = 'assets/css/style.css';

    /** @var string Path to the Ror javascript script. */
    public const templateContributor = 'contributor.tpl';
}
