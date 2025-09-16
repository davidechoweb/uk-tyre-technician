(function() {
    tinymce.create('tinymce.plugins.my_button_dropdown', {
        init: function(editor, url) {
            editor.addButton('my_button_dropdown', {
                type: 'menubutton',
                text: 'Buttons',
                icon: false,
                menu: [
                    {
                        text: 'Primary Button',
                        onclick: function() {
                            var selected = editor.selection.getContent({format: 'html'});
                            if (selected) {
                                editor.selection.setContent('<a href="#" class="btn btn-primary">' + selected + '</a>');
                            } else {
                                editor.insertContent('<a href="#" class="btn btn-primary">Primary Button</a>');
                            }
                        }
                    },
                    {
                        text: 'Secondary Button',
                        onclick: function() {
                            var selected = editor.selection.getContent({format: 'html'});
                            if (selected) {
                                editor.selection.setContent('<a href="#" class="btn btn-secondary">' + selected + '</a>');
                            } else {
                                editor.insertContent('<a href="#" class="btn btn-secondary">Secondary Button</a>');
                            }
                        }
                    },
                    {
                        text: 'Danger Button',
                        onclick: function() {
                            var selected = editor.selection.getContent({format: 'html'});
                            if (selected) {
                                editor.selection.setContent('<a href="#" class="btn btn-danger">' + selected + '</a>');
                            } else {
                                editor.insertContent('<a href="#" class="btn btn-danger">Danger Button</a>');
                            }
                        }
                    }
                ]
            });
        },
        createControl: function() { return null; },
        getInfo: function() {
            return {
                longname: 'My Button Dropdown',
                author: 'You',
                version: '1.0'
            };
        }
    });

    tinymce.PluginManager.add('my_button_dropdown', tinymce.plugins.my_button_dropdown);
})();