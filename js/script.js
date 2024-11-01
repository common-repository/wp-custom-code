'use strict';
(function ($) {
    $(function () {

        if ($('#kfag_wp_custom_css').length) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
            editorSettings.codemirror = _.extend({},
                editorSettings.codemirror, {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'css',
                }
            );
            var editor = wp.codeEditor.initialize($('#kfag_wp_custom_css'), editorSettings);
        }

        if ($('#kfag_wp_custom_js').length) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
            editorSettings.codemirror = _.extend({},
                editorSettings.codemirror, {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'javascript',
                    theme: "blackboard"
                }
            );
            var editor = wp.codeEditor.initialize($('#kfag_wp_custom_js'), editorSettings);
        }

        if ($('#kfag_wp_custom_js_external').length) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
            editorSettings.codemirror = _.extend({},
                editorSettings.codemirror, {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'http',
                    theme: "blackboard"
                }
            );
            var editor = wp.codeEditor.initialize($('#kfag_wp_custom_js_external'), editorSettings);
        }
        
    });
})(jQuery);