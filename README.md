# Table of Contents

## Research Organization Registry (ROR) Plugin

OJS 3 Plugin for adding Organization names for author affiliations provided by [ROR.org](https://ror.org/)
Organizations maintained by ROR.org are automatically fetched using an auto suggesting function.
For multilingual journals, additionally supported languages will be pre-filled given, [ROR.org](https://ror.org/) has the corresponding names in the OJS supported languages.
If organization names are not present, the default name will be used.

ROR ID is integrated in the OJS reader interface up from OJS 3.3.
ROR Plugin is shipped with the OJS Plugin gallery up from OJS 3.2. For Installation of OJS 3.2 reader interface support see [installation](#Installation).

Licensed under GPLv3. See [LICENSE](LICENSE) for details.

## User Documentation

* Adding the ROR organization name into your author affiliation. :movie_camera: [GIF Image](docs/ror-lookup-ojs-3-4-0.gif)

## Installation

* Login as admin or Journal manager
* Select _Settings -> Website -> Plugins_
* Click On _Plugin Gallery_
* Select and click on _ROR Plugin_
* Click _Install_ in the opened modal and wait for the _installation_ to finish.
* Click on _Enable_ button . ROR Plugin is installed under generic plugins.

**This step is _`only`_ required, if your OJS 3.2 is prior to `30.11.2020` or your are _`not`_ using `default theme`**

 * Select _templates/frontend/objects/article_details.tpl_
 * Find the following code in the template.
 ```xml
<span class="affiliation">
    {$author->getLocalizedData('affiliation')|escape}
</span>
```
* Add the ROR Icon template variable
```xml
<span class="affiliation">
    {$author->getLocalizedData('affiliation')|escape}
    {if $author->getData('rorId')}
        <a href="{$author->getData('rorId')|escape}">{$rorIdIcon}</a>
    {/if}
</span>
```

## Features

### Release 1.0

* Allows auto-suggesting organization names
* Pre-fills affiliations in multilingual context
* Subsequent alteration of the ROR-suggested organization name is also possible by maintaining the ROR Plugin, wich can be helpful in special cases e.g. adding a institute name for a research organization.
* OJS 3.3 compatibility

### Release 2.0

* OpenAire / Datacite / Crossref Support
* Support for user affiliations
* Usability requests specially for dissemination plugins

### Release 3.0

* Multilingual organization support

### Release 4.0

* OJS 3.4 compatibility

## Development

* [Dulip Withanage](https://www.github.com/withanage)
* [Gazi Yucel](https://www.github.com/GaziYucel)
