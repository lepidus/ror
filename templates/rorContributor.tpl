{**
 * templates/ror/rorContributor.tpl
 *
 * @copyright (c) 2021+ TIB Hannover
 * @copyright (c) 2021+ Gazi Yücel
 * @license Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Ror contributor lookup
 *}

<link rel="stylesheet" href="{$stylePath}" type="text/css"/>

{assign var="templateOpen" value='<script>let rorPluginTemplate = `'}
{assign var="templateClose" value='`;</script>'}

{$templateOpen}
<div class="pkpFormField pkpFormField--text {ROR_PLUGIN_NAME}_rorId_Lookup_div" :class="classes">
    <div class="pkpFormField__heading">
        <form-field-label :controlId="controlId"
                          :label="label"
                          :localeLabel="localeLabel"
                          :isRequired="isRequired"
                          :requiredLabel="__('common.required')"
                          :multilingualLabel="multilingualLabel"
        ></form-field-label>
        <tooltip v-if="isPrimaryLocale && tooltip"
                 aria-hidden="true"
                 :tooltip="tooltip"
                 label=""
        ></tooltip>
    </div>
    <div class="pkpFormField__control" :class="controlClasses">
        <div class="pkpFormField__control_top">
            <label>
                <span class='pkpSearch__icons'>
                    <icon icon='search' class='pkpSearch__icons--search'/>
                </span>
                <input class="pkpFormField__input pkpFormField--text__input"
                       ref="input"
                       v-model="searchPhrase"
                       :type="inputType"
                       :id="controlId"
                       :name="localizedName"
                       :aria-describedby="describedByIds"
                       :aria-invalid="errors && errors.length"
                       :disabled="isDisabled"
                       :required="isRequired"
                       :style="inputStyles"
                />
            </label>
            <button class="pkpSearch__clear"
                    v-if="searchPhrase"
                    @click.prevent="clearSearchPhrase">
                <icon icon="times"/>
            </button>
        </div>
    </div>
    <div v-if="searchPhrase" class="searchPhraseOrganizations">
        <ul>
            <li v-for="(organization, index) in organizations">
                <a @click.prevent="selectOrganization(index)">{{ organization.name }} [{{ organization.id }}]</a>
            </li>
        </ul>
    </div>
</div>
{$templateClose}

<script>
    let rorPluginTemplateCompiled = pkp.Vue.compile(rorPluginTemplate);

    pkp.Vue.component("ror-field-text-lookup", {
        name: "RorFieldTextLookup",
        extends: pkp.Vue.component("field-text"),
        data() {
            return {
                organizations: [], // [ { id: id1, name: name1 }, ... ]
                searchPhrase: "",
                minimumSearchPhraseLength: 3,
            }
        },
        methods: {
            selectOrganization(index) {
                this.$parent._props.fields[this.getIndex('affiliation')].value.en = this.organizations[index].name;
                this.$parent._props.fields[this.getIndex('rorId')].value = this.organizations[index].id;
            },
            clearSearchPhrase() {
                this.organizations = [];
                this.searchPhrase = "";
            },
            getIndex(fieldName) {
                let fields = this.$parent._props.fields;
                for (let i = 0; i < fields.length; i++) {
                    if (fields[i].name === fieldName) {
                        return i;
                    }
                }
            },
            apiLookup() {
                let self = this;
                $.ajax({
                    url: 'https://api.ror.org/organizations',
                    dataType: 'json',
                    cache: true,
                    data: {
                        affiliation: self.searchPhrase + '*'
                    },
                    success(response) {
                        self.organizations = [];
                        $.map(response.items, function (item) {
                            let row = {
                                id: item.organization.id,
                                name: item.organization.name
                            };
                            self.organizations.push(row);
                        });
                    }
                });
            },
        },
        watch: {
            searchPhrase() {
                if (this.searchPhrase.length >= this.minimumSearchPhraseLength) {
                    this.apiLookup();
                }
            }
        },
        render: function (h) {
            return rorPluginTemplateCompiled.render.call(this, h);
        },
        created() {
            // console.log('component ror-field-text-lookup created');
        }
    });
</script>
