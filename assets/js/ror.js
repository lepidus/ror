var rorPluginTemplate = pkp.Vue.compile(
    "<div class='pkpSearch'>" +
    "  <label>" +
    "    <input type='search' class='pkpSearch__input' id='rorIdSearch' v-model='searchPhrase' placeholder='currentSearchLabel'/>" +
    "    <span class='pkpSearch__icons'><icon icon='search' class='pkpSearch__icons--search' /></span>" +
    "  </label>" +
    "  <button class='pkpSearch__clear' v-if='searchPhrase' @click.prevent='clearSearchPhrase'>" +
    "      <icon icon='times' />" +
    "  </button>" +
    "</div>"
);

pkp.Vue.component("field-text-lookup", {
    name: "FieldTextLookup",
    extends: pkp.Vue.component("field-text"),
    data: {
        searchPhrase: ""
    },
    props: {
        searchPhrase: {
            type: String,
            required: false
        }
    },
    watch: {
        searchPhrase() {
            console.log(this.searchPhrase);
        }
    },
    methods: {},
    render: function (h) {
        return rorPluginTemplate.render.call(this, h);
    },
    created() {
        console.log('hello-gazi-created');
    }
});
