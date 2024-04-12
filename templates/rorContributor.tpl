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

<script>
    let rorPluginTemplate = pkp.Vue.compile(`
        <div class="pkpFormField pkpFormField--text {ROR_PLUGIN_NAME}_rorId_Lookup_div" :class="classes">
            <div class="pkpFormField__heading">
                <form-field-label
                    :controlId="controlId"
                    :label="label"
                    :localeLabel="localeLabel"
                    :isRequired="isRequired"
                    :requiredLabel="__('common.required')"
                    :multilingualLabel="multilingualLabel"
                />
                <tooltip
                    v-if="isPrimaryLocale && tooltip"
                    aria-hidden="true"
                    :tooltip="tooltip"
                    label=""
                />
                <!-- <span
                    v-if="isPrimaryLocale && tooltip"
                    class="-screenReader"
                    :id="describedByTooltipId"
                    v-strip-unsafe-html="tooltip"
                /> -->
                <!-- <help-button
                    v-if="isPrimaryLocale && helpTopic"
                    :id="describedByHelpId"
                    :topic="helpTopic"
                    :section="helpSection"
                    :label="__('help.help')"
                /> -->
            </div>
            <!-- <div
                v-if="isPrimaryLocale && description"
                class="pkpFormField__description"
                v-strip-unsafe-html="description"
                :id="describedByDescriptionId"
            /> -->
            <div class="pkpFormField__control" :class="controlClasses">
                <div class="pkpFormField__control_top">
                    <label>
                        <span class='pkpSearch__icons'>
                            <icon icon='search' class='pkpSearch__icons--search' />
                        </span>
                        <input
                            class="pkpFormField__input pkpFormField--text__input"
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
                        <!-- <ul style="display: block;">
                            <li v-for="(organization, i) in organizations">organization.id | organization.name</li>
                        <ul> -->
                    </label>
                    <button
                        class="pkpSearch__clear"
                        v-if="searchPhrase"
                        @click.prevent="clearSearchPhrase"
                    >
                        <icon icon="times" />
                    </button>
                </div>
                <!-- <field-error
                    v-if="errors && errors.length"
                    :id="describedByErrorId"
                    :messages="errors"
                /> -->
            </div>
            {{ testVal }}
        </div>
    `);


    pkp.Vue.component("ror-field-text-lookup", {
        name: "RorFieldTextLookup",
        extends: pkp.Vue.component("field-text"),
        data: {
            organizations: [], // [ { id: id1, name: name1 }, ... ]
            searchPhrase: "",
            affiliation: "",
            rorId: "",
            testVal: "testVal"
        },
        props: {
            organizations: {
                type: Array, required: false
            },
            searchPhrase: {
                type: String, required: false
            },
            affiliation: {
                type: String, required: false
            },
            rorId: {
                type: String, required: false
            },
            testVal: {
                type: String, required: true
            }
        },
        methods: {
            clearSearchPhrase() {
                this.searchPhrase = "";
                this.$parent._props.fields[10].value.en = 'affiliation works';
                this.$parent._props.fields[11].value = 'rorId works';
            },
            apiLookup(searchPhrase) {
                $.ajax({
                    url: 'https://api.ror.org/organizations',
                    dataType: 'json',
                    cache: true,
                    data: {
                        affiliation: searchPhrase + '*'
                    },
                    success:
                        function (data) {
                            let result = [];
                            $.map(data.items, function (item) {
                                result.push({
                                    id: item.organization.id,
                                    name: item.organization.name
                                });
                            });
                            this.organizations = result;
                        }
                });
            }
        },
        watch: {
            searchPhrase() {
                // if(this.searchPhrase !== undefined && this.searchPhrase.length >= 3){
                //     console.log(this.searchPhrase);
                    // this.apiLookup(this.searchPhrase);
                // }

            }
        },
        computed: {
            // affiliation() {
            //     return this.$parent._props.fields[10].value.en;
            // },
            // rorId() {
            //     return this.$parent._props.fields[11].value;
            // }
        },
        render: function (h) {
            return rorPluginTemplate.render.call(this, h);
        },
        created() {
            console.log('component ror-field-text-lookup created');
            this.affiliation = this.$parent._props.fields[10].value.en;
            this.rorId = this.$parent._props.fields[11].value;
            // lookupRor();
            // console.log(this.$parent);
            // console.log('affiliation: ' + this.affiliation);
            // console.log('rorId: ' + this.rorId);
        }
    });

    function lookupRor() {
        var primaryLocale = $.pkp.app.primaryLocale; // "{$primaryLocale}";
        var results = null;
        const tagitInput = '.tagit-new > input';
        const rorPlaceHolder = "Search ror.org";

        // var mainAffiliation = 'input[id^="contributor-affiliation-control-' + primaryLocale + '"]';
        // if ( !$( mainAffiliation ).length ) {
        //     mainAffiliation = 'input[id^="affiliation-"]';
        // }

        let mainAffiliation = '#contributor-affiliation-control-' + primaryLocale;

        console.log(primaryLocale);
        console.log(mainAffiliation);

        $(mainAffiliation).tagit({
            fieldName: 'affiliation-ROR[]',
            allowSpaces: true,
            tagLimit: 1,
            tagSource: function (search, r) {
                $.ajax({
                    url: 'https://api.ror.org/organizations',
                    dataType: 'json',
                    cache: true,
                    data: {
                        affiliation: search.term + '*'
                        },
                    success:
                        function (data) {
                            results = data.items;

                            r($.map(data.items, function (item) {
                                return {
                                    label: item.organization.name,
                                    value: item.organization.name + ' [' + item.organization.id + ']'
                                    }
                                }));

                            }
                    });
                },
            beforeTagAdded: function (event, ui) {
                },
            afterTagAdded: function (event, ui) {
                if (ui.duringInitialization === true) {
                    $(mainAffiliation).after('<div id = "rorIdField" style="float:right; background:#eaedee;"><a href="{$rorId}" target="_blank">{$rorId}</a></div>');

                } else {
                    const regex = /https:\/\/ror\.org\/(\d|\w)+/g;
                    const found = ui.tagLabel.match(regex);
                    if (found !== null) {
                        const rorId = found[0];
                        $.each(results, function (key, value) {
                            if (value.organization.id == rorId) {
                                var supportedLocales = {$supportedLocales|json_encode};
                                console.log(supportedLocales);

                                $.each(supportedLocales, function (k, val) {
                                    console.log(k, val);
                                    var locale = val.slice(0, 2);
                                    if (locale.length == 2) {
                                        value.organization.labels.forEach(function (v) {
                                            if (locale == v["iso639"]) {
                                                if (locale !== primaryLocale.slice(0, 2)) {
                                                    $('input[id^="affiliation-' + locale + '"]').val(v.label);
                                                    $('input[id^="affiliation-' + locale + '"]').parent().css("display", "block");
                                                    $('input[id^="affiliation-' + locale + '"]').parent().css("width", "576px");
                                                }
                                            }
                                        });

                                    }
                                });

                            }
                        });

                    }


                }
                console.log("afterTagAdded");
                },
            afterTagRemoved: function (event, ui) {
                $('#rorIdField').remove("");
                $('input[id^="affiliation-').val("");
                $('.localization_popover').css("display", "hidden");
                $(tagitInput).attr("placeholder", rorPlaceHolder);
                },
            onTagClicked: function (event, ui) {
                $(tagitInput).attr("placeholder", rorPlaceHolder);
                },
            onTagRemoved: function (event, ui) {
                $('#rorIdField').remove("");
                $('input[id^="affiliation-').val("");
                $('.localization_popover').css("display", "hidden");
                $(tagitInput).attr("placeholder", rorPlaceHolder);
                }
            });
        if ($('.tagit-label').val() || $('.tagit-label').length == 0) {
            $(tagitInput).attr("placeholder", rorPlaceHolder);
        }
        }

</script>
